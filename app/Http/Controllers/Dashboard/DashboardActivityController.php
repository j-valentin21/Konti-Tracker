<?php

namespace App\Http\Controllers\Dashboard;

use App\Activity;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;

class DashboardActivityController extends Controller
{
    /**
     * Display different activities executed throughout the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $activity = User::find(auth()->user()->id)->activity;
        return view('dashboard.activity.index',['activity'=>$activity]);
    }
}
