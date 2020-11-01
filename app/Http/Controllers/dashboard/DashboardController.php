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
     * @return void
     */
    public function update(Request $request)
    {
        $profile = Profile::find(auth()->user()->id);

        if($profile->pto > $request->pto_value) {
            $pto_used = $profile->pto - $request->pto_value;
            if ($profile->pto_usage === null) {
                $months = array('Jan' => 0, 'Feb' => 0, 'Mar' => 0, 'Apr' => 0, 'May' => 0, 'June' => 0,
                    'July' => 0, 'Aug' => 0, 'Sept' => 0, 'Oct' => 0, 'Nov' => 0, 'Dec' => 0);
                $graph_date = $profile->updated_at;
                $graph_month = $graph_date->shortEnglishMonth;
                $months[$graph_month] = $pto_used;
                $profile->pto_usage = $months;
            } else {
                $months = $profile->pto_usage;
                $graph_date = $profile->updated_at;
                $graph_month = $graph_date->shortEnglishMonth;
                $months[$graph_month] = $months[$graph_month] + $pto_used;
                $profile->pto_usage = $months;
            }
        }
        if ($profile->pto !== $request->pto_value) {
            $profile->pto = $request->pto_value;
        }
        if($profile->points !== $request->points_value) {
            $profile->points = $request->points_value;
        }

        $profile->save();
    }
}
