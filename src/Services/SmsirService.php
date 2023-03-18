<?php
namespace D3cr33\Communication\Services;

use Illuminate\Support\Facades\Http;

class SmsirService extends Service
{
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