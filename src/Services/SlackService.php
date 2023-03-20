<?php
namespace D3cr33\Communication\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class SlackService extends Service
{
    public const PORT = [
        1   =>  'send',
    ];

    protected function send()
    {
        Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($this->config->HOOK_URL,[
            'text' => $this->communication->template
        ]);
    }

    /**
     * translate response
     * @var array $response
     * @return
     */
    protected function responseTranslate(array $response)
    {
        $this->setResponse([
            'status'    =>  $response['IsSuccessful'],
            'statusCode' => $response['IsSuccessful'] ? 200 : 500,
            'message'   =>  $response['Message']
        ]);
    }
}
