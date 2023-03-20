<?php
namespace D3cr33\Communication\Services;

use Illuminate\Support\Facades\Http;

class SmsirService extends Service
{
    public const PORT = [
        1   =>  'send',
        2   =>  'array',
        3   =>  'verification',
    ];

    /**
     * store api token
     * @var string
     */
    private string $token;

    public function generateToken()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept'    =>  'text/plain'
        ])->post('https://RestfulSms.com/api/Token',[
            'UserApiKey'    =>  '',
            'SecretKey' =>  ''
        ]);

        if( $response->failed() ){
            return;
        }

        $this->token = $response->json('TokenKey');
    }
}