<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Profile;
use App\Http\Requests\FirstTimeRegistrationValidation;

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
        $profile = $request->session()->get('profile');
        return view('auth.profile.build-your-profile',compact('profile', $profile));

    }

    /**
     * Post Request to store step 1 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(FirstTimeRegistrationValidation $request)
    {
        $validated = $request->validated();

        if (empty($request->session()->get('profile'))) {
            $profile = new Profile();
            $profile->fill($validated);
            $request->session()->put('profile', $profile);
        } else {
            $profile = $request->session()->get('profile');
            $profile->fill($validated);
            $request->session()->put('profile', $profile);
        }

        return redirect('/register/avatar');
    }
}
