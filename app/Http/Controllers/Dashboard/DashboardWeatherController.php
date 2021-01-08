<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardWeatherController extends Controller
{
    /**
     * Show dashboard weather view.
     *
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count = auth()->user()->notifications->count();
        $notifications = Auth()->user()->notifications()->limit(8)->get();
        return view('dashboard.weather.index',['count'=>$count, 'notifications' => $notifications]);
    }
}
