<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

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
        $profile = $request->session()->get('profile');
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
        $profile = $request->session()->get('profile');
        $profile->user_id = auth()->id();
        $profile->user->firstTimeUser = 0;
        $profile->user->save();
        $profile->save();
        return redirect('/dashboard');
    }
}
