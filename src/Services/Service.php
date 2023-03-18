<?php
namespace D3cr33\Communication\Services;

use D3cr33\Communication\Config\Config;
use D3cr33\Communication\Models\Communication;

class Service
{
    public const SERVICE_TYPE = [
        0   =>  'sms',
        1   =>  'push-notification',
        2   =>  'email'
    ];

    public const PORT_TYPE = [
        0   =>  'smsir',
        1   =>  'kavehnegar'
    ];

    /**
     * store config
     * @var Config
     */
    protected Config $config;

    public function __construct(Communication $communication)
    {
        $this->initialize($communication);
    }

    /**
     * initialize port service
     * @param Communication $communication
     */
    private function initialize(Communication $communication)
    {
        $this->config = new Config($communication->port_type);
    }
}