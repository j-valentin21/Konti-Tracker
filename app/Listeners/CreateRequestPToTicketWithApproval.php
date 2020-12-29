<?php

namespace App\Listeners;

use App\Activity;
use App\Events\RequestPtoTickedHasBeenApproved;
use App\PTORequest;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateRequestPToTicketWithApproval
{

    /**
     * Handle the event.
     *
     * @param  RequestPtoTickedHasBeenApproved  $event
     * @return void
     */
    public function handle(RequestPtoTickedHasBeenApproved $event)
    {
        $ptoRequest = PTORequest::oldest()->where('user_id', $event->userId)->get()->first();
        $dateTime = Carbon::now();
        Activity::create([
            'user_id' => $event->userId,
            'date' => $dateTime->format("y-m-d"),
            'time' => $dateTime->toTimeString(),
            'pto_used' => $ptoRequest->pto_days,
            'points' => 0,
            'pending' => $ptoRequest->pto_days,
            'dates_requested' => $ptoRequest->dates,
            'reason_for_request' => $ptoRequest->reason_for_request,
            'supervisor_name' => "Admin",
            'status' => "APPROVED",
        ]);
        PTORequest::find($ptoRequest->id)->delete();
    }
}
