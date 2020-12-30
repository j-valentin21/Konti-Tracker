<?php

namespace App\Listeners;

use App\Activity;
use App\Events\RequestPtoTickedHasBeenSubmittedEvent;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateRequestPToTicket
{
    /**
     * Handle the event.
     *
     * @param  RequestPtoTickedHasBeenSubmittedEvent  $event
     * @return void
     */
    public function handle(RequestPtoTickedHasBeenSubmittedEvent $event)
    {
        $dateTime = Carbon::now();
        Activity::create([
            'user_id' => $event->pto_request->user_id,
            'date' => $dateTime->format("y-m-d"),
            'time' => $dateTime->toTimeString(),
            'pto_used' =>"-" . $event->pto_request->pto_days,
            'points' => 0,
            'pending' => $event->pto_request->pto_days,
            'dates_requested' => $event->pto_request->dates,
            'reason_for_request' => $event->pto_request->reason_for_request,
            'supervisor_name' => "Admin",
            'status' => "PENDING",
        ]);
    }
}
