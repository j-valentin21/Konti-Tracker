<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Services\NotificationService;
use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class DashboardPasswordController extends Controller
{
    /**
     * Show the dashboard password view.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        try {
            $notifications = (new NotificationService())->userNotifications(auth()->user()->id);
            return view('dashboard.password.index',[
                'count' => $notifications['count'],
                'notifications' => $notifications['notifications']
            ]);
        } catch(\Exception $e ) {
            return view('errors.404');
        }
    }

    /**
     * Update old password to new password.
     *
     * @param UpdatePasswordRequest $request
     * @return RedirectResponse
     */
    public function update(UpdatePasswordRequest $request): RedirectResponse
    {
        $redis = Redis::connection();
        $hashedPassword = Auth::user()->password;

        if(Hash::check($request->oldpassword, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            $redis->set('message_' .  auth()->id(), 'Your password was successfully changed!');
            return redirect('/dashboard');
        } else {
            return redirect()->back()->with('errorMsg', 'Current password is invalid');
        }
    }
}
