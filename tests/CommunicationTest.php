<?php
namespace D3cr33\Communication\Test;

class CommunicationTest extends TestCase
{
    public function test_communicaton_execute_method_success()
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
    }
}