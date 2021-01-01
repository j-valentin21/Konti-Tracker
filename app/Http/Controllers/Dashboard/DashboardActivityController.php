<?php

namespace App\Http\Controllers\Dashboard;

use App\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardActivityController extends Controller
{
    /**
     * View all activities.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = auth()->user()->id;
        return view('dashboard.activity.index',['userId' => $userId]);
    }

    /**
     * Delete one or all activities associated with user.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id, request $request)
    {
        if(!empty($request->deleteAll)) {
            Activity::where('user_id', auth()->user()->id )->delete();
            $results = Activity::latest()->where('user_id', auth()->user()->id )->paginate(10);
            return response()->json(['results' => $results]);
        } else {
            Activity::find($id)->delete();
            $results = Activity::latest()->where('user_id', auth()->user()->id )->paginate(10);
            return response()->json(['results' => $results]);
        }
    }
}
