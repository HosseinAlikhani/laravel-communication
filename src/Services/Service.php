<?php
namespace D3cr33\Communication\Services;

use D3cr33\Communication\Config\Config;
use D3cr33\Communication\Models\Communication;

class Service
{
    /**
     * service type
     * @var array
     */
    public const SERVICE_TYPE = [
        1   =>  'smsir',
        2   =>  'kavehnegar'
    ];

    /**
     * thread
     * @var array
     */
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

    /**
     * store communication
     * @var Communication
     */
    protected Communication $communication;

    public function __construct(Communication $communication)
    {
        $this->communication = $communication;
        $this->initialize();
    }

    /**
     * initialize port service
     * @return void
     */
    private function initialize(): void
    {
        $this->config = new Config($this->communication->service_type);
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

    /**
     * check is service port valid
     * @param int $service
     * @param int|null $port
     * @return bool|string
     */
    public static function isServicePortValid(int $service, int|null $port): string|bool
    {
        $service = self::makeService($service);

        if(! $port || ! key_exists($port, $service::PORT) ) {
            return false;
        }

        return $service::PORT[$port];
    }
}
