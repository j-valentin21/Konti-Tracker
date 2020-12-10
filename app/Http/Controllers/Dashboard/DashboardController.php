<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Profile;
use App\PTORequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class DashboardController extends Controller
{
    /**
     * Show the dashboard view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $redis = Redis::connection();
        $profile = Profile::find(auth()->user()->id);
        $profile->resetMonths();
        $message = $redis->get('message_' .  auth()->id());
        $redis->expire('message_' . auth()->id(),5);
        return view('dashboard.index', ['message'=>$message, 'profile'=> $profile]);
    }
    /**
     * Update PTO or points on the dashboard view.
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
        $profile = Profile::find(auth()->user()->id);

        if($profile->pto > $request->pto_value) {
            $pto_used = $profile->pto - $request->pto_value;
            $month =  $profile->getChartMonth();
            $months = $profile->pto_usage;
            $months[$month] = $pto_used + $months[$month];
            $profile->pto_usage = $months;
        }
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
    }
    /**
     * Get data to update charts in dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPTOChartData()
    {
        $profile = Profile::find(auth()->user()->id);
        $data = $profile->pto_usage;
        return response()->json($data);
    }
    /**
     * Get data to update points chart in dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPointsChartData()
    {
        $profile = Profile::find(auth()->user()->id);
        $data = $profile->points_usage;
        return response()->json($data);
    }

    /**
     * Create Request for PTO day.
     *
     * @param Request $request
     */
    public function create(request $request)
    {
        $request_pto = new PTORequest();
        $request_pto->user_id = auth()->user()->id;
        $request_pto->pto_days = $request->ptoDays;
        $request_pto->reason_for_request = $request->reason;
        $request_pto->dates = $request->datesArray;
        $request_pto->start_times = $request->startTime["time"];
        $request_pto->end_times = $request->endTime["time"];
        $request_pto->save();
    }
}
