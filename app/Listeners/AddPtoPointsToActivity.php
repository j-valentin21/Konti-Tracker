<?php

namespace App\Listeners;

use App\Activity;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;


class AddPtoPointsToActivity
{

    /**
     * Handle the event.
     *
     * @param  $event
     * @return void
     */
    public function handle($event)
    {
        $dateTime = Carbon::now();
        Activity::create([
            'user_id' => $event->userId,
            'date' => $dateTime->format("y-m-d"),
            'time' => $dateTime->toTimeString(),
            'pto_used' => $event->pto,
            'points' => $event->points,
            'pending' => 0,
            'reason_for_request' => "N/A",
            'supervisor_name' => "Admin",
            'status' => "ACCEPTED",
        ]);
    }
}
