<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormUploadRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redis;
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
        $redis = Redis::connection();
        $profile = unserialize($redis->get('profile_' . auth()->id()));
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
        $redis = Redis::connection();
        $profile = unserialize($redis->get('profile_' . auth()->id()));

        if(!isset($profile->avatar)) {
            if ($request->file('avatar') === null) {
                return redirect('/register/confirmation');
            } else {
                $profile = unserialize($redis->get('profile_' . auth()->id()));
                $url = $request->file('avatar')->store('avatar', 's3');
                Storage::disk('s3')->setVisibility($url, 'public');
                $profile->avatar = $url;
                $redis->set('profile_'. auth()->id(), serialize($profile));
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
        $redis = Redis::connection();
        $profile = unserialize($redis->get('profile_' . auth()->id()));
        $imageName = $profile->avatar;
        Storage::disk('s3')->delete($imageName);
        unset($profile->avatar);
        return redirect('/register/avatar');
    }
}
