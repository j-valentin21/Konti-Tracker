<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class PtoPointsController extends Controller
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
        return view('auth.profile.pto_points',compact('profile', $profile));

    }
}
