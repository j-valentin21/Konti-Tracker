<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Profile;
use App\Http\Requests\FirstTimeRegistrationRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redis;

class ProfileController extends Controller
{
    /**
     * Show build-your-profile page.
     *
     * @param Request $request
     * @return Renderable
     */
    public function create(Request $request)
    {
        $redis = Redis::connection();
        $profile = unserialize($redis->get('profile_' . auth()->id()));
        return view('auth.profile.build-your-profile',compact('profile', $profile));
    }

    /**
     * Post Request to store build-your-profile info in redis session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Redirector
     */
    public function post(FirstTimeRegistrationRequest $request)
    {
        $redis = Redis::connection();

        $validated = $request->validated();

        if (empty($redis->get('profile_' . auth()->id()))) {
            $profile = new Profile();
            $profile->fill($validated);
            $redis->set('profile_'. auth()->id(), serialize($profile));
        } else {
            $profile = unserialize($redis->get('profile_' . auth()->id()));
            $profile->fill($validated);
            $redis->set('profile_'. auth()->id(), serialize($profile));
        }

        return redirect('/register/avatar');
    }
}
