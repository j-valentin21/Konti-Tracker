<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Profile;
use App\Services\NotificationService;
use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class DashboardProfileController extends Controller
{
    /**
     * Show the dashboard profile view.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        try {
            $notifications = (new NotificationService())->userNotifications(auth()->user()->id);
            return view('dashboard.profile.index',[
                'count' => $notifications['count'],
                'notifications' => $notifications['notifications']
            ]);
        } catch(\Exception $e ) {
            return view('errors.404');
        }
    }

    /**
     * Update dashboard profile view.
     *
     * @param ProfileRequest $request
     * @return RedirectResponse
     */
    public function update(ProfileRequest $request): RedirectResponse
    {
        try {
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
        } catch(\Exception $e ) {
            return redirect()->back()->with('errorMsg', 'An issue occurred trying to update your profile. Please try again at a later time.');
        }

    }

    /**
     * Destroy image in profile view.
     *
     * @return RedirectResponse
     */
    public function destroy(): RedirectResponse
    {
        try{
            $profile = Profile::find(auth()->user()->id);
            $img = $profile->avatar;
            Storage::disk('s3')->delete($img);
            $profile->avatar = null;
            $profile->save();
            return redirect('/dashboard/profile');
        } catch(\Exception $e ) {
            return redirect()->back()->with('errorMsg', 'An issue occurred trying to delete your profile. Please try again at a later time.');
        }
    }
}
