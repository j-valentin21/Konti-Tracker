<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PtoPointsHasBeenUpdatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * ID and number of days requested.
     *
     * @var User
     */
    public $userId;
    public $points;
    public $pto;

    /**
     * Create a new event instance.
     *
     * @param int $userId
     * @param int $points
     * @param float $pto
     */
    public function __construct(int $userId, int $points, float $pto)
    {
        $this->userId = $userId;
        $this->points = $points;
        $this->pto = $pto;
    }

}
