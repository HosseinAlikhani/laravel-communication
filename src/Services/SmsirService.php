<?php
namespace D3cr33\Communication\Services;

use Exception;
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

    private function generateToken()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept'    =>  'text/plain'
        ])->post('https://RestfulSms.com/api/Token',[
            'UserApiKey'    =>  $this->config->USER_API_KEY,
            'SecretKey' =>  $this->config->SECRET_KEY
        ]);

        if(! $response->json('IsSuccessful') ){
            $this->responseTranslate($response->json());
            $this->log();
            return false;
        }

        $this->token = $response->json('TokenKey');
        return true;
    }

    /**
     * verification code
     */
    protected function verification()
    {
        if(! $this->generateToken() ){
            return false;
        }

        $receiverData = $this->communication->receiver_data;
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'text/plain',
            'X-API-KEY' => $this->token
        ])->post('https://api.sms.ir/v1/send/verify', [
            'parameters'  =>  [
                [
                    "name"  =>  "verificationCode",
                    "value" =>  $receiverData['verification_code']
                ]
            ],
            'templateId'    =>  (int) $this->communication->template_id,
            'mobile'  =>  $receiverData['mobile']
        ]);

        dd( 'response', $response->json() );
    }

    protected function send()
    {
        if(! $this->generateToken() ){
            return false;
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'text/plain',
            'X-API-KEY' => $this->token
        ])->post('https://api.sms.ir/v1/send/likeToLike', [
            'messageTexts'  =>  [
                'its test',
            ],
            'mobiles'   =>  [
                '09361374744'
            ]
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
