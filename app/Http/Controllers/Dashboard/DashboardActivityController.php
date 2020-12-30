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
        $activity =  Activity::latest()->where('user_id', auth()->user()->id )->get();
        return view('dashboard.activity.index',['activity'=>$activity]);
    }

    /**
     * Display different activities executed throughout the application.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Activity::find($id)->delete();
        $results = User::find(auth()->user()->id)->activity;
        return response()->json(['results' => $results]);
    }

}
