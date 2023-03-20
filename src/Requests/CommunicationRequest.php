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
        $this->setServiceType($request['service_type']);
        $this->setPortType($request['port_type'] ?? null);
        $this->modelType = $request['model_type'];
        $this->modelId = $request['model_id'];
        $this->setTemplate($request);
    }

    /**
     * set service type on serviceType property
     * @param int $serviceType
     * @return void
     */
    private function setServiceType(int $serviceType): void
    {
        if(! key_exists($serviceType, Service::SERVICE_TYPE) )
        {
            throw new CommunicationRequestException(trans('communication::messages.service_type_not_found',[
                'serviceType'  =>  $serviceType
            ]));
        }
        $this->serviceType = $serviceType;
    }

    /**
     * set & check port type
     * @param int|null $portType
     * @return void
     */
    private function setPortType(int|null $portType)
    {
        if(! key_exists($portType, Service::PORT_TYPE) )
        {
            throw new CommunicationRequestException(trans('communication::messages.port_type_not_found',[
                'portType'  =>  $portType
            ]));
        }
        $this->portType = $portType;
    }

    /**
     * set template & templateId
     * @param array $request
     * @return void
     */
    private function setTemplate(array $request): void
    {
        if( isset($request['template']) ){
            $this->template = $request['template'];
        }elseif( isset($request['template_id']) ){
            $this->templateId = $request['template_id'];
        }else{
            throw new CommunicationRequestException(trans('communication::messages.template_not_found'));
        }
    }
}
