<?php
namespace D3cr33\Communication\Services;

use D3cr33\Communication\HttpClient\HttpService;
use Exception;
use Illuminate\Support\Facades\Http;

class SlackService extends Service
{
    public const PORT = [
        1   =>  'send',
    ];

    protected function send()
    {
        try{
            (new HttpService)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                ->post($this->config->HOOK_URL, [
                    'text' => $this->communication->message->message
                ]);
        }catch(Exception $e){
            $this->responseTranslate([
                'status'    =>  false,
                'message'   =>  $e->getMessage()
            ]);
            $this->log();
            throw new Exception($e->getMessage());
        }
        $this->responseTranslate([
            'status'    =>  true,
            'message'   =>  trans('communication::messages.response_success')
        ]);
        return true;
    }

    /**
     * translate response
     * @var array $response
     * @return
     */
    protected function responseTranslate(array $response)
    {
        $this->setResponse([
            'status'    =>  $response['status'],
            'statusCode' => $response['status'] ? 200 : 500,
            'message'   =>  $response['message']
        ]);
    }
}
