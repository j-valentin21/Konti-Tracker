<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Profile;
use Illuminate\Http\Request;

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
}
