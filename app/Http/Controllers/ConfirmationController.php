<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ConfirmationController extends Controller
{
    /**
     * Show confirmation view
     *
     * @param Request $request
     * @return Renderable
     */
    public function create(Request $request)
    {
        $redis = Redis::connection();
        $profile = unserialize($redis->get('profile_' . auth()->id()));
        return view('auth.profile.confirmation',compact('profile',$profile));
    }

    /**
     * Store profile
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $redis = Redis::connection();
        $profile = unserialize($redis->get('profile_' . auth()->id()));
        $profile->user_id = auth()->id();
        $profile->user->firstTimeUser = 0;
        $profile->user->save();
        $profile->save();
        $redis->unlink('profile_' . auth()->id());
        return redirect('/dashboard');
    }
}
