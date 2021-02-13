<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use App\Profile;
use App\Http\Requests\FirstTimeRegistrationRequest;
use Illuminate\Support\Facades\Redis;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('firstTimeUser');
        $this->middleware('verified');
    }

    /**
     * View build-your-profile page.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        try {
            $redis = Redis::connection();
            $profile = unserialize($redis->get('profile_' . auth()->id()));
            return view('auth.profile.build-your-profile',compact('profile', $profile));
        } catch(\Exception $e ) {
            return view('errors.404');
        }
    }

    /**
     * Create profile and store in redis session
     *
     * @param FirstTimeRegistrationRequest $request
     * @return RedirectResponse
     */
    public function create(FirstTimeRegistrationRequest $request): RedirectResponse
    {
        $redis = Redis::connection();
        $validated = $request->validated();

        if (empty($redis->get('profile_' . auth()->id()))) {
            $profile = new Profile();
            $profile->fill($validated);
            $redis->set('profile_'. auth()->id(), serialize($profile));
            $redis->expire('profile_' . auth()->id(), $profile->expireDate());
        } else {
            $profile = unserialize($redis->get('profile_' . auth()->id()));
            $profile->fill($validated);
            $redis->set('profile_'. auth()->id(), serialize($profile));
            $redis->expire('profile_' . auth()->id(), $profile->expireDate());
        }
        return redirect('/register/avatar');
    }
}
