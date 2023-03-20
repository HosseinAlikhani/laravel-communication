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

    public const THREAD = [
        self::THREAD_SYNC   =>  'sync',
        self::THREAD_ASYNC   =>  'async'
    ];

    public const THREAD_SYNC = 1;
    public const THREAD_ASYNC = 2;

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
