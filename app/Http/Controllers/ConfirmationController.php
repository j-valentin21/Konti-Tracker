<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ConfirmationController extends Controller
{
    /**
     * Show the Product Review page
     *
     * @param Request $request
     * @return Renderable
     */
    public function create(Request $request)
    {
        $profile = $request->session()->get('profile');
        return view('auth.profile.confirmation',compact('profile',$profile));
    }
}
