<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardPTOPointsController extends Controller
{
    /**
     * Show dashboard weather view.
     *
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard.pto-points.index');
    }
}
