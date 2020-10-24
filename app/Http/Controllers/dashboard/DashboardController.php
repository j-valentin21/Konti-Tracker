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
     * Show the dashboard view.
     *
     * @param Request $request
     * @return void
     */
    public function updatePTO(Request $request)
    {
        $redis = Redis::connection();
        $profile = Profile::find(auth()->user()->id);
        $pto = $request->pto;
        $profile->pto = $pto;
        $profile->save();
    }
}
