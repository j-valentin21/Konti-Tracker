<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Contracts\Support\Renderable;


class DashboardWeatherController extends Controller
{
    /**
     * Show dashboard weather view.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        try {
            $notifications = (new NotificationService())->userNotifications(auth()->user()->id);
            return view('dashboard.weather.index',[
                'count' => $notifications['count'],
                'notifications' => $notifications['notifications']
            ]);
        } catch(\Exception $e ) {
            return view('errors.404');
        }
    }
}
