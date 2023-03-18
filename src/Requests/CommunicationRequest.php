<?php
namespace D3cr33\Communication\Requests;

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
     */
    public function __construct(array $request)
    {
        $this->initialize($request);
    }

    private function initialize(array $request)
    {
        $this->serviceType = $this->setServiceType($request['service_type']);
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
            throw new CommunicationRequest(trans('communication::messages.service_type_not_found'));
        }
        return $serviceType;
    }
}