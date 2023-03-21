<?php

namespace D3cr33\Communication\Events;

use D3cr33\Communication\Models\Communication;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommunicationAsync
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * store service namespace
     * @var string
     */
    public string $service;

    /**
     * store communication instance
     * @var Communication
     */
    public Communication $communication;

    /**
     * Create a new event instance.
     */
    public function __construct($service, Communication $communication)
    {
        $this->service = $service;
        $this->communication = $communication;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
