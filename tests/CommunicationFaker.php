<?php
namespace D3cr33\Communication\Test;

use D3cr33\Communication\Services\Service;

final class CommunicationFaker
{
    /**
     * generate fake service
     * @return int
     */
    public function service(): int
    {
        $service = Service::SERVICE_TYPE;
        return $service[mt_rand(1, count($service))];
    }

    /**
     * generate fake model type
     * @return string
     */
    public function modelType(): string
    {
        return fake()->word();
    }

    /**
     * generate fake model id
     * @return int
     */
    public function modelId(): int
    {
        return fake()->randomNumber();
    }

    /**
     * generate fake template
     * @return string
     */
    public function template(): string
    {
        return fake()->word();
    }

    /**
     * generate fake template id
     * @return int
     */
    public function templateId(): int
    {
        return fake()->randomNumber();
    }
}