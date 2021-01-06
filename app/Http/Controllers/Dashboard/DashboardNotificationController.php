<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardNotificationController extends Controller
{
    /**
     * View all notifications.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count = auth()->user()->notifications->count();
        $notifications = Auth()->user()->notifications()->limit(8)->get();
        $userId = auth()->user()->id;
        return view('dashboard.notification.index',['count'=>$count, 'notifications' => $notifications, 'userId' => $userId]);
    }
}
