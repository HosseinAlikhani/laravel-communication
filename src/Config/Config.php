<?php
namespace D3cr33\Communication\Config;

use D3cr33\Communication\Exceptions\ConfigException;
use D3cr33\Communication\Exceptions\PortException;
use D3cr33\Communication\Services\Service;

final class Config
{
    /**
     * constructor of service config
     * @param int $service
     */
    public function __construct(int $service)
    {
        $this->initialize(
            $this->getService($service)
        );
    }

    /**
     * get service
     * @param int $service
     */
    private function getService(int $service)
    {
        return Service::SERVICE_TYPE[$service];
    }

    /**
     * initialize and get service config
     * @param string $service
     * @return void
     */
    public function initialize(string $service):void
    {
        // get config
        $config = config('communication.'.strtoupper($service));

        if(! $config || ! count($config) ){
            throw new ConfigException(
                trans('communication::messages.config_not_found',[
                    'service'  =>  $service
                ])
            );
        }

        // set config to properties
        foreach($config as $key => $value){
            $this->{$key} = $value;
        }
    }
}
