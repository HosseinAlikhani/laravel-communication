<?php
namespace D3cr33\Communication\Ports;

use D3cr33\Communication\Models\Communication;
use D3cr33\Communication\Requests\CommunicationRequest;

final class CommunicationService
{
    /**
     * execute communication
     * @param array $communicationData
     */
    public function execute(array $communicationData)
    {
        $request = new CommunicationRequest($communicationData);

        $communication = Communication::createCommunication($request);

        return $communication->makePort();
    }
}
