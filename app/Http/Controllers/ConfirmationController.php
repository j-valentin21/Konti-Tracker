<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ConfirmationController extends Controller
{
    public function __construct()
    {
        $this->middleware('firstTimeUser');
        $this->middleware('verified');
    }

    /**
     * Show confirmation view
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        try {
            $redis = Redis::connection();
            $profile = unserialize($redis->get('profile_' . auth()->id()));
            return view('auth.profile.confirmation', compact('profile', $profile));
        } catch(\Exception $e) {
            return view('errors.404');
        }
    }

    /**
     * Store profile
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
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
