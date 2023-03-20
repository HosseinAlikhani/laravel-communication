<?php
namespace D3cr33\Communication\Requests;

use D3cr33\Communication\Exceptions\CommunicationRequestException;
use D3cr33\Communication\Services\Service;

final class CommunicationRequest
{
    public int $service;
    public int $port;
    public string $modelType;
    public int $modelId;
    public string|null $template;
    public int|null $templateId;
    public array $templateData;
    public array $receiverData;
    public string|null $sendAt;
    public string $thread;
    public string|null $callback;
    public array|null $callbackData;

    /**
     * constructor of communication request
     * @param array $request
     * @param int $request[service]
     * @param int|null $request[port]
     */
    public function __construct(array $request)
    {
        $this->initialize($request);
    }

    private function initialize(array $request)
    {
        $this->setServiceType($request['service']);
        $this->setPortType($request['port'] ?? null);
        $this->modelType = $request['model_type'];
        $this->modelId = $request['model_id'];
        $this->setTemplate($request);
        $this->templateData = $request['template_data'];
        $this->receiverData = $request['receiver_data'];
        $this->sendAt = $request['send_at'] ?? null;
        $this->setThread($request['thread'] ?? null);
        $this->setCallback($request);
    }

    /**
     * set service type on service property
     * @param int $service
     * @return void
     */
    private function setServiceType(int $service): void
    {
        if(! key_exists($service, Service::SERVICE_TYPE) )
        {
            throw new CommunicationRequestException(trans('communication::messages.service_type_not_found',[
                'service'  =>  $service
            ]));
        }
        $this->service = $service;
    }

    /**
     * set & check port type
     * @param int|null $port
     * @return void
     */
    private function setPortType(int|null $port)
    {
        if(! Service::isServicePortValid($this->service, $port) )
        {
            throw new CommunicationRequestException(trans('communication::messages.port_type_not_found',[
                'port'  =>  $port
            ]));
        }
        $this->port = $port;
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
     * set callback & callback data
     * @param array $request
     * @return void
     */
    private function setCallback(array $request)
    {
        if ( isset($request['callback']) ){
            $this->callback = $request['callback'];
            if(! isset($request['callback_data'])){
                throw new CommunicationRequestException(trans('communication::messages.callback_data_not_found',[
                    'callback'  =>  $this->callback
                ]));
            }
            $this->callbackData = $request['callback_data'];
        } else {
            $this->callback = null;
            $this->callbackData = null;
        }
    }

    /**
     * check request has callback or not
     * @return bool
     */
    public function hasCallback(): bool
    {
        return $this->callback ? true : false;
    }

    /**
     * to array communication request
     * @return array
     */
    public function toArray(): array
    {
        return [
            'service'  =>  $this->service,
            'port' =>  $this->port,
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
