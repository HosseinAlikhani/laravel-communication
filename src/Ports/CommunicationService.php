<?php
namespace D3cr33\Communication\Ports;

use D3cr33\Communication\Models\Communication;
use D3cr33\Communication\Requests\CommunicationRequest;

final class CommunicationService
{
    /**
     * execute communication
     * @param array $communicationData
     * @param int $$communicationData[service]
     * @param int $$communicationData[port]
     * @param string $$communicationData[model_type]
     * @param int $$communicationData[model_id]
     * @param string|null $$communicationData[template]
     * @param int|null $$communicationData[template_id]
     * @param array $$communicationData[template_data]
     * @param array $$communicationData[receiver_data]
     * @param string|null $$communicationData[send_at]
     * @param string $$communicationData[thread]
     * @param string|null $$communicationData[callback]
     * @param array|null $$communicationData[callback_data]
     */
    public function execute(array $communicationData)
    {
        $request = new CommunicationRequest($communicationData);

        $communication = Communication::createCommunication($request);

        return $communication->makePort();
    }
}
