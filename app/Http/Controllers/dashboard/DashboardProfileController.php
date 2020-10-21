<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class DashboardProfileController extends Controller
{
    /**
     * Show the dashboard profile view.
     *
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard.profile.index');
    }

    /**
     * Update dashboard profile view.
     *
     *
     * @param ProfileRequest $request
     * @return \Illuminate\Routing\Redirector
     */
    public function update(ProfileRequest $request)
    {
        $redis = Redis::connection();
        $profile = Profile::find(auth()->user()->id);
        $user = User::find(auth()->user()->id);

        $validated = $request->validated();

        $user->fill($validated);
        $profile->fill($validated);

        if(!isset($request->avatar)) {
            $user->save();
            $profile->save();
            $redis->set('message_' .  auth()->id(), 'Your profile was successfully updated!');
            return redirect('/dashboard');
        } else {
            $url = $request->file('avatar')->store('avatar', 's3');
            Storage::disk('s3')->setVisibility($url, 'public');
            $profile->update(['avatar'=>$url]);
            $user->save();
            $profile->save();
            $redis->set('message_' .  auth()->id(), 'Your profile was successfully updated!');
            return redirect('/dashboard');
        }
    }

    /**
     * Destroy image in profile view.
     *
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request)
    {
        $profile = Profile::find(auth()->user()->id);
        $img = $profile->avatar;
        Storage::disk('s3')->delete($img);
        $profile->avatar = null;
        $profile->save();
        return redirect('/dashboard/profile');
    }
}
