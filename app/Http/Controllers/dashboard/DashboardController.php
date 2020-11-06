<?php

namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;

use App\Profile;
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
        $message = $redis->get('message_' .  auth()->id());
        $redis->expire('message_' . auth()->id(),5);
        return view('dashboard.index', ['message'=>$message]);
    }

    /**
     * Update PTO or points on the dashboard view.
     *
     * @param Request $request
     */
    public function update(Request $request):void
    {
        $profile = Profile::find(auth()->user()->id);

        if($profile->pto > $request->pto_value) {
            $pto_used = $profile->pto - $request->pto_value;
            $month =  $profile->getBarChartMonth();
            $months = $profile->pto_usage;
            $months[$month] = $pto_used + $months[$month];
            $profile->pto_usage = $months;
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
    public function getBarChartData()
    {
        $profile = Profile::find(auth()->user()->id);
        $data = $profile->pto_usage;
        return response()->json($data);
    }
}
