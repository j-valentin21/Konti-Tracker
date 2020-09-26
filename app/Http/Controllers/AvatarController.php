<?php

namespace App\Http\Controllers;

use App\Http\Requests\FirstTimeRegistrationValidation;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    /**
     * Show Avatar view.
     *
     * @param Request $request
     * @return Renderable
     */
    public function create(Request $request)
    {
        $profile = $request->session()->get('profile');
        return view('auth.profile.avatar',compact('profile', $profile));
    }

    /**
     * Post Request to store step 2 info in session
     *
     *
     * @param Request $request
     * @return Redirector
     */
    public function post(Request $request)
    {
        $profile = $request->session()->get('profile');

        if(!isset($profile->image)) {
            if($request->file('img')) {
                $profile = $request->session()->get('profile');
                $url = $request->file('img')->store('images','s3');
                Storage::disk('s3')->setVisibility($url, 'public');
                $profile->image = $url;
                $request->session()->put('profile', $profile);
            }
        }

        return redirect('/register/confirmation');
    }

    /**
     * Destroy image in session
     *
     * @param Request $request
     * @return Redirector
     */
    public function destroy(Request $request)
    {
        $profile = $request->session()->get('profile');
        $profile->image = null;
        return redirect('/register/avatar');
    }
}
