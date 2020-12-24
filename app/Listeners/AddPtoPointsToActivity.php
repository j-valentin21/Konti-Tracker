<?php

namespace App\Listeners;

use App\Activity;
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

        $activity = new Activity();
        $activity->user_id = $event->userId;
        $activity->date = "2020-08-05";
        $activity->time= "12:54:22";
        $activity->pto_used = $event->pto;
        $activity->points = $event->points;
        $activity->pending = 0;
        $activity->reason_for_request = "N/A";
        $activity->supervisor_name = "Admin";
        $activity->status = "ACCEPTED";
        $activity->save();

    }
}
