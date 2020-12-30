<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RequestPtoTickedHasBeenSubmittedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * ID and number of days requested.
     *
     * @var $pto_request
     */
    public $pto_request;

    /**
     * Create a new event instance.
     *
     * @param object $pto_request
     */
    public function __construct(object $pto_request)
    {
        $this->pto_request = $pto_request;
    }
}
