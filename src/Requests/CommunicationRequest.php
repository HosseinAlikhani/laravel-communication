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
    public string|null $template;
    public int|null $templateId;
    public array $templateData;
    public array $receiverData;
    public string|null $sendAt;
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
        $this->templateData = $request['template_data'];
        $this->receiverData = $request['receiver_data'];
        $this->sendAt = $request['send_at'] ?? null;
        $this->setThread($request['thread'] ?? null);
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
            $this->templateId = null;
        }elseif( isset($request['template_id']) ){
            $this->templateId = $request['template_id'];
            $this->template = null;
        }else{
            throw new CommunicationRequestException(trans('communication::messages.template_not_found'));
        }
    }

    /**
     * set thread
     * @param int|null $thread
     * @return void
     */
    private function setThread(int|null $thread): void
    {
        if(! key_exists($thread, Service::THREAD) )
        {
            $thread = Service::THREAD_ASYNC; // set default thread
        }
        $this->thread = $thread;
    }

    /**
     * to array communication request
     * @return array
     */
    public function toArray(): array
    {
        return [
            'service_type'  =>  $this->serviceType,
            'port_type' =>  $this->portType,
            'model_type'    =>  $this->modelType,
            'model_id'  =>  $this->modelId,
            'template'  =>  $this->template,
            'template_id'   =>  $this->templateId,
            'template_data' =>  $this->templateData,
            'receiver_data' =>  $this->receiverData,
            'send_at'   =>  $this->sendAt,
            'thread'    =>  $this->thread
        ];
    }
}
