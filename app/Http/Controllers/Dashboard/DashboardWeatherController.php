<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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
        $count = auth()->user()->notifications->count();
        $notifications = Auth()->user()->notifications()->limit(8)->get();
        return view('dashboard.weather.index',['count'=>$count, 'notifications' => $notifications]);
    }
}
