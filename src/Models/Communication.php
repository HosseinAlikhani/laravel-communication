<?php
namespace D3cr33\Communication\Models;

use D3cr33\Communication\Events\CommunicationAsync;
use D3cr33\Communication\Requests\CommunicationRequest;
use D3cr33\Communication\Services\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Communication extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'template_data' =>  'array',
        'receiver_data' =>  'array',
    ];

    /**
     * create communication record
     * @param CommunicationRequest $request
     * @return Communication
     */
    public static function createCommunication(CommunicationRequest $request): Communication
    {
        $communication = Communication::create($request->toArray());

        if( $request->hasCallback() ){
            $communication->callback()->create([
                'callback'  =>  $request->callback,
                'callback_data' =>  $request->callbackData,
            ]);
        }

        // make template
        self::makeTemplateReplacement($communication);
        return $communication->load(['callback', 'message']);
    }

    /**
     * make communication template
     * @param Communication $communication
     * @return string|null
     */
    public static function makeTemplateReplacement(Communication $communication): string|null
    {
        if(! $communication->template ){
            return null;
        }

        $shouldReplace = [];
        foreach ($communication->template_data as $key => $value) {
            $shouldReplace[':'.Str::ucfirst($key ?? '')] = Str::ucfirst($value ?? '');
            $shouldReplace[':'.Str::upper($key ?? '')] = Str::upper($value ?? '');
            $shouldReplace[':'.$key] = $value;
        }

        $line = strtr($communication->template, $shouldReplace);
        $communication->message()->create([
            'message'   =>  $line
        ]);
        return $line;
    }

    /**
     * make communication port
     * @return object
     */
    public function makePort()
    {
        $service = Service::makeService($this->service);
        if ( $this->thread == Service::THREAD_ASYNC ) {
            CommunicationAsync::dispatch($service, $this);
            return [
                'status'    =>  200,
                'message'   =>  trans('communication::messages.request_submited')
            ];
        }
        return (new $service($this))->getResponse()->toArray();
    }

    /**
     * message log relation
     */
    public function message()
    {
        return $this->hasOne(CommunicationMessageLog::class);
    }

    /**
     * communication callback relation
     */
    public function callback()
    {
        return $this->hasOne(CommunicationCallback::class);
    }

    /**
     * communication logs relation
     */
    public function logs()
    {
        return $this->hasOne(CommunicationLog::class);
    }
}
