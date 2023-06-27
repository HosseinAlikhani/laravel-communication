<?php
namespace D3cr33\Communication\Test;

use D3cr33\Communication\Ports\CommunicationService;
use Illuminate\Support\Facades\Http;

class CommunicationTest extends TestCase
{
    public function test_communicaton_execute_method_for_slack_success()
    {
        $data = [
            'service'   =>  2,
            'port'  =>  1,
            'model_type'    =>  $this->faker->modelType(),
            'model_id'  =>  $this->faker->modelId(),
            'template'  =>  $this->faker->template(),
            'template_id'   =>  $this->faker->templateId(),
            'template_data' =>  $this->faker->templateData(),
            'receiver_data' =>  $this->faker->receiverData(),
            'send_at'   =>  $this->faker->sendAt(),
            'thread'    =>  $this->faker->thread(),
            'callback'  =>  $this->faker->callback(),
            'callback_data' =>  $this->faker->callbackData()
        ];

        Http::fake([
            '*'    =>  Http::response([
                'status'    =>  true,
                'message'   =>  'mock response'
            ], 422)
        ]);

        $result = (new CommunicationService)->execute($data);
        $this->assertEquals(true, $result['status']);
        $this->assertEquals(trans('communication::messages.response_success'), $result['message']);
    }
}
