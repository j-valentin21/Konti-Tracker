<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormUploadRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function __construct()
    {
        $this->middleware('firstTimeUser');
        $this->middleware('verified');
    }

    /**
     * Show avatar view.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        try {
            $redis = Redis::connection();
            $profile = unserialize($redis->get('profile_' . auth()->id()));
            return view('auth.profile.avatar',compact('profile', $profile));
        } catch(\Exception $e ) {
            return view('errors.404');
        }
    }

    /**
     * Get image and store it in session.
     *
     * @param FormUploadRequest $request
     * @return RedirectResponse
     */
    public function create(FormUploadRequest $request): RedirectResponse
    {
        $redis = Redis::connection();
        $profile = unserialize($redis->get('profile_' . auth()->id()));

        if(!isset($profile->avatar)) {
            if ($request->file('avatar') === null) {
                $redis->set('profile_'. auth()->id(), serialize($profile));
                $redis->expire('profile_' . auth()->id(), $profile->expireDate());
                return redirect('/register/confirmation');
            } else {
                $profile = unserialize($redis->get('profile_' . auth()->id()));
                $url = $request->file('avatar')->store('avatar', 's3');
                Storage::disk('s3')->setVisibility($url, 'public');
                $profile->avatar = $url;
                $redis->set('profile_'. auth()->id(), serialize($profile));
                $redis->expire('profile_' . auth()->id(), $profile->expireDate());
            }
        }
        return redirect('/register/confirmation');
    }

    /**
     * Destroy image in session
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        $redis = Redis::connection();
        $profile = unserialize($redis->get('profile_' . auth()->id()));
        $imageName = $profile->avatar;
        Storage::disk('s3')->delete($imageName);
        $profile->avatar = null;
        $redis->set('profile_'. auth()->id(), serialize($profile));
        return redirect('/register/avatar');
    }
}
