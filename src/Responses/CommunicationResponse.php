<?php
namespace D3cr33\Communication\Responses;

final class CommunicationResponse
{
    /**
     * store response status
     * @var bool
     */
    public bool $status;

    /**
     * store response status code
     * @var int
     */
    public int $statusCode;

    /**
     * store response message
     * @var string
     */
    public string $message;

    public function __construct(bool $status, int $statusCode, string $message)
    {
        $this->status = $status;
        $this->statusCode = $statusCode;
        $this->message = $message;
    }

    /**
     * to array response
     * @return array
     */
    public function toArray(): array
    {
        return [
            'status'    =>  $this->status,
            'status_code'   =>  $this->statusCode,
            'message'   =>  $this->message
        ];
    }
}
