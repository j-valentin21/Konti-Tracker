<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormUploadRequest;
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
     * Post Request to store image in session
     *
     *
     * @param Request $request
     * @return Redirector
     */
    public function post(FormUploadRequest $request)
    {
        $profile = $request->session()->get('profile');

        if(!isset($profile->avatar)) {
            if ($request->file('avatar') === null) {
                return redirect('/register/confirmation');
            } else {
                $profile = $request->session()->get('profile');
                $url = $request->file('avatar')->store('avatar', 's3');
                Storage::disk('s3')->setVisibility($url, 'public');
                $profile->avatar = $url;
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
        $imageName = $profile->avatar;
        Storage::disk('s3')->delete($imageName);
        $profile->avatar = null;
        return redirect('/register/avatar');
    }
}
