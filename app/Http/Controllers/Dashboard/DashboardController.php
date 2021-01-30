<?php

namespace App\Http\Controllers\Dashboard;

use App\Activity;
use App\Events\PtoPointsHasBeenUpdatedEvent;
use App\Events\RequestPtoTickedHasBeenSubmittedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\PTOFormRequest;
use App\Jobs\ApprovePTORequestJob;
use App\Profile;
use App\PTORequest;
use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redis;

class DashboardController extends Controller
{
    /**
     * View the dashboard route.
     *
     */
    public function index()
    {
        try {
            $redis = Redis::connection();
            $profile = Profile::find(auth()->user()->id);
            $notifications = (new NotificationService())->userNotifications(auth()->user()->id);
            $profile->resetMonths();
            $message = $redis->get('message_' .  auth()->id());
            $redis->expire('message_' . auth()->id(),5);

            return view('dashboard.index', [
                'message'=> $message,
                'profile'=> $profile,
                'notifications' => $notifications['notifications'],
                'count' => $notifications['count']
            ]);
        } catch(\Exception $e ) {
            return view('errors.404');
        }
    }

    /**
     * Create request for PTO day/days.
     *
     * @param PTOFormRequest $request
     * @return RedirectResponse
     */
    public function create(PTOFormRequest $request): RedirectResponse
    {
        $redis = Redis::connection();
        $profile = Profile::find(auth()->user()->id);
        //Add user input to request form
        $request_pto = (new PTORequest())->fill($request->validated());
        $request_pto->user_id = auth()->user()->id;
        $request_pto->start_times = $request->start_times;
        $request_pto->end_times = $request->end_times;
        //Remove days requested from pto dashboard.
        $pto_used = $profile->pto - $request->pto_days;
        $profile->pto = $pto_used;
        $profile->pending = $profile->pending + $request->pto_days;
        //Set redis message if everything works correctly
        $redis->set('message_' . auth()->id(), 'Your PTO request has been successfully created! Awaiting approval for your request');
        $redis->expire('message_' . auth()->id(), 5);
        //Send job to queue to mimic supervisor/employee interaction for request
        ApprovePTORequestJob::dispatch(auth()->user()->id, $request->pto_days)
            ->delay(now()->addMinutes(10));
        //Save to database
        $request_pto->save();
        $profile->save();
        //Create entry for activity log
        event(new RequestPtoTickedHasBeenSubmittedEvent($request_pto));
    }

    /**
     * Update PTO or points on the dashboard view.
     *
     * @param Request $request
     *
     */
    public function update(Request $request)
    {
        $profile = Profile::find(auth()->user()->id);
        //Add PTO data to graph if days are subtracted
        if($profile->pto > $request->pto_value) {
            $pto_used = $profile->pto - $request->pto_value;
            $month =  $profile->getChartMonth();
            $months = $profile->pto_usage;
            $months[$month] = $pto_used + $months[$month];
            $profile->pto_usage = $months;
        }
        //Add points to graph if days are added.
        if($profile->points < $request->points_value) {
            $points_used = $request->points_value - $profile->points;
            $month =  $profile->getChartMonth();
            $months = $profile->points_usage;
            $months[$month] = $points_used + $months[$month];
            $profile->points_usage = $months;
        }
        if ($profile->pto !== $request->pto_value) {
            $profile->pto = $request->pto_value;
        }
        if($profile->points !== $request->points_value) {
            $profile->points = $request->points_value;
        }
        $profile->save();
        event(new PtoPointsHasBeenUpdatedEvent(auth()->user()->id, $request->points_count,$request->pto_count));
    }

    /**
     * Get data to update charts in dashboard.
     *
     * @return JsonResponse
     */
    public function getPTOChartData(): JsonResponse
    {
        $profile = Profile::find(auth()->user()->id);
        $data = $profile->pto_usage;
        $pto = $profile->pto;
        return response()->json([$data,$pto]);
    }

    /**
     * Get data to update points chart in dashboard.
     *
     * @return JsonResponse
     */
    public function getPointsChartData(): JsonResponse
    {
        $profile = Profile::find(auth()->user()->id);
        $data = $profile->points_usage;
        return response()->json($data);
    }

    /**
     * Get data to render all notifications in view.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getNotificationsData(request $request): JsonResponse
    {
        $notifications = auth()->user()->notifications()->paginate(10);
        $data = $notifications;
        return response()->json($data);
    }
}
