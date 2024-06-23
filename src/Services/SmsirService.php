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
        try{
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept'    =>  'text/plain'
            ])->post('https://RestfulSms.com/api/Token',[
                'UserApiKey'    =>  $this->config->USER_API_KEY,
                'SecretKey' =>  $this->config->SECRET_KEY
            ]);

            $this->responseTranslate($response->json());

            if( $this->response->isSuccessful() ){
                $this->token = $response->json('TokenKey');
                return true;
            }else{
                // $this->log();
                throw new Exception($this->response->message);
            }
        }catch(Exception $e){
            $this->responseTranslate([
                'IsSuccessful'    =>  false,
                'Message'   =>  $e
            ]);
            $this->log();
            throw new Exception($e);
        }
    }

    /**
     * verification code
     */
    protected function verification()
    {
        $receiverData = $this->communication->receiver_data;
        try{
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'text/plain',
                'X-API-KEY' => $this->config->API_KEY
            ])->post('https://api.sms.ir/v1/send/verify', [
                'parameters'  =>  [
                    [
                        "name"  =>  "verificationCode",
                        "value" =>  (string) $receiverData['verification_code']
                    ]
                ],
                'templateId'    =>  (int) $this->communication->template_id,
                'mobile'  =>  $receiverData['mobile']
            ]);

            $this->responseTranslate($response->json());

            if( $this->response->isSuccessful() ){
                $this->communicationDelivered();
            }else{
                // $this->log();
                throw new Exception($this->response->message);
            }
            return $this->response->toArray();
        }catch(Exception $e){
            $this->responseTranslate([
                'success'    =>  false,
                'message'   =>  $e
            ]);
            $this->log();
            throw new Exception($e);
            // return $this->response->toArray();
        }
    }

    protected function send()
    {
        try{
            $receiverData = $this->communication->receiver_data;
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'text/plain',
                'X-API-KEY' => $this->config->API_KEY
            ])->post('https://api.sms.ir/v1/send/likeToLike', [
                'MessageText'  =>  [$this->communication->template],
                'Mobiles'   =>  [$receiverData['mobile']],
                'lineNumber'    =>  $this->config->LINE_NUMBER
            ]);
            $this->responseTranslate($response->json());

            if( $this->response->isSuccessful() ){
                $this->communicationDelivered();
            }else{
                // $this->log();
                throw new Exception($this->response->message);
            }
            return $this->response->toArray();
        }catch(Exception $e){
            $this->responseTranslate([
                'success'    =>  false,
                'message'   =>  $e
            ]);
            throw new Exception($e);
            // return $this->response->toArray();
        }
    }

    /**
     * translate response
     * @var array $response
     * @return
     */
    protected function responseTranslate(array $response)
    {
        $this->setResponse([
            'status'    =>  isset($response['success']) ? $response['success'] : 500,
            'statusCode' => isset($response['success']) && $response['success'] == 1 ? 200 : 500,
            'message'   =>  $response['message']
        ]);
    }
}
