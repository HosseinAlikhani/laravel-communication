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
}