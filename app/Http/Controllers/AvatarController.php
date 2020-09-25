<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    /**
     * Show pto_points view.
     *
     * @param Request $request
     * @return Renderable
     */
    public function create(Request $request)
    {
        $profile = $request->session()->get('profile');

        return view('auth.profile.avatar',compact('profile', $profile));
    }

    public function post(Request $request)
    {
        $path = $request->file('img')->store('images','s3');
    }
}
