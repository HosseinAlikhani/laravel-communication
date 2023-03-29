<?php
namespace D3cr33\Communication\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class GoogleCloudService extends Service
{
    public const PORT = [
        1   =>  'pushNotification',
    ];

    public function pushNotification()
    {
        $receiverData = $this->communication->receiver_data;
        //TODO must check key in receiver data

        try{
            $response = Http::timeout(3)
            ->retry(2)
            ->withHeaders([
                'Content-Type'  =>  'application/json',
                'Authorization' =>  'key='.$this->config->AUTHORIZATION
            ])->post($this->config->FCM_SEND_URL,[
                "registration_ids"  =>  [$receiverData['registrationId']],
                "notification"  =>  [
                    "title" => $receiverData['title'] ?? 'for test',
                    "body"  =>  $this->communication->template
                ]
            ]);

            if($response->json('success')){
                $this->responseTranslate([
                    'status'    =>  true,
                    'message'   =>  trans('communication::messages.response_success')
                ]);
                $this->communicationDelivered();
                return true;
            }

            $this->responseTranslate([
                'status'    =>  false,
                'message'   =>  trans('communication::messages.response_failed')
            ]);
            $this->log();
            return false;
        }catch(Exception $e){
            $this->responseTranslate([
                'status'    =>  false,
                'message'   =>  $e->getMessage()
            ]);
            throw new Exception($e->getMessage());
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
            'status'    =>  $response['status'],
            'statusCode' => $response['status'] ? 200 : 500,
            'message'   =>  $response['message']
        ]);
    }
}
