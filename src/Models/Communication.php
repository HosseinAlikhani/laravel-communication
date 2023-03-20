<?php
namespace D3cr33\Communication\Models;

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

    public static function makeTemplateReplacement(Communication $communication)
    {
        if(! $communication->template ){
            return null;
        }

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

    public function message()
    {
        return $this->hasOne(CommunicationMessageLog::class);
    }
}
