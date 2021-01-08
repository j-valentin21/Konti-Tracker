<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Http\Requests\UpdatePasswordRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class DashboardPasswordController extends Controller
{
    /**
     * Show the dashboard password view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count = auth()->user()->notifications->count();
        $notifications = Auth()->user()->notifications()->limit(8)->get();
        return view('dashboard.password.index', ['count'=>$count, 'notifications' => $notifications]);
    }

    /**
     * Update old password to new password.
     *
     * @param UpdatePasswordRequest $request
     * @return String
     */
    public function update(UpdatePasswordRequest $request)
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
