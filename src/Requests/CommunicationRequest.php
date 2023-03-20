<?php
namespace D3cr33\Communication\Requests;

use D3cr33\Communication\Exceptions\CommunicationRequestException;
use D3cr33\Communication\Services\Service;

final class CommunicationRequest
{
    public int $serviceType;
    public int $portType;
    public string $modelType;
    public int $modelId;
    public string $template;
    public int $templateId;
    public array $templateData;
    public array $receiverData;
    public string $sendAt;
    public string $thread;
    /**
     * constructor of communication request
     * @param array $request
     * @param int $request[service_type]
     * @param int|null $request[port_type]
     */
    public function __construct(array $request)
    {
        $this->initialize($request);
    }

    private function initialize(array $request)
    {
        $this->serviceType = $this->setServiceType($request['service_type']);
        $this->portType = $this->setPortType($request['port_type'] ?? null);
    }

    /**
     * set service type on serviceType property
     * @param int $serviceType
     * @return int
     */
    private function setServiceType(int $serviceType): int
    {
        if(! key_exists($serviceType, Service::SERVICE_TYPE) )
        {
            throw new CommunicationRequestException(trans('communication::messages.service_type_not_found',[
                'serviceType'  =>  $serviceType
            ]));
        }
        return $serviceType;
    }

    /**
     * set & check port type
     * @param int|null $portType
     * @return int
     */
    private function setPortType(int|null $portType): int
    {

    }
}