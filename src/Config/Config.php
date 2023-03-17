<?php
namespace D3cr33\Communication\Config;

use D3cr33\Communication\Exceptions\ConfigException;
use D3cr33\Communication\Exceptions\PortException;

final class Config
{
    /**
     * store ports
     */
    public const PORTS = [
        1   =>  'SMSIR',
    ];

    /**
     * constructor of port class
     * @param int $port
     */
    public function __construct(int $port)
    {
        $this->initialize(
            $this->getPort($port)
        );
    }

    /**
     * get port
     * @param int $port
     */
    private function getPort(int $port)
    {
        if(key_exists($port, self::PORTS)){
            return self::PORTS[$port];
        }
        throw new PortException(trans('communication::messages.port_not_found'));
    }

    /**
     * initialize and get port config
     * @param string $port
     * @return void
     */
    public function initialize(string $port):void 
    {
        // get config
        $config = config('communication.'.$port);

        if(! $config || ! count($config) ){
            throw new ConfigException(
                trans('communication::messages.config_not_found',[
                    'port'  =>  $port
                ])
            );
        }

        // set config to properties
        foreach($config as $key => $value){
            $this->{$key} = $value;
        }
    }
}