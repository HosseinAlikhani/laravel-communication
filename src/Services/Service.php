<?php
namespace D3cr33\Communication\Services;

use D3cr33\Communication\Config\Config;
use D3cr33\Communication\Models\Communication;

class Service
{
    public const SERVICE_TYPE = [
        1   =>  'smsir',
        2   =>  'kavehnegar'
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

    /**
     * make service from serviceType
     * @param int $serviceType
     * @return string
     */
    public static function makeService(int $serviceType): string
    {
        $serviceType = Service::SERVICE_TYPE[$serviceType];
        return 'D3cr33\Communication\Services\\'.ucfirst($serviceType).'Service';
    }
}
