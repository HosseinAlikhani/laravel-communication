<?php
namespace D3cr33\Communication\Ports;

use D3cr33\Communication\Models\Communication;
use D3cr33\Communication\Requests\CommunicationRequest;

final class CommunicationService
{
    /**
     * execute communication
     * @param array $communicationData
     * @param string $$communicationData[service]
     * @param string $$communicationData[port]
     * @param string $$communicationData[model_type]
     * @param string $$communicationData[model_id]
     * @param string $$communicationData[template]
     * @param string $$communicationData[template_id]
     * @param string $$communicationData[template_data]
     * @param string $$communicationData[receiver_data]
     * @param string $$communicationData[send_at]
     * @param string $$communicationData[thread]
     * @param string $$communicationData[callback]
     * @param string $$communicationData[callback_data]
     */
    public function execute(array $communicationData)
    {
        $request = new CommunicationRequest($communicationData);

        $communication = Communication::createCommunication($request);

        return $communication->makePort();
    }
}
