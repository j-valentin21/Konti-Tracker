<?php

namespace App\Http\Controllers\Dashboard;

use App\Activity;
use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardActivityController extends Controller
{
    /**
     * View all activities.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $userId = auth()->user()->id;
        $notifications = (new NotificationService())->userNotifications(auth()->user()->id);
        return view('dashboard.activity.index',[
            'count'=> $notifications['count'],
            'notifications' => $notifications['notifications'],
            'userId' => $userId
        ]);
    }

    /**
     * Delete one or all activities associated with user.
     *
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(int $id, request $request): JsonResponse
    {
        if(!empty($request->deleteAll)) {
            Activity::where('user_id', auth()->user()->id )->delete();
            $results = [];
            return response()->json(['results' => $results]);
        } else {
            Activity::find($id)->delete();
            $results = Activity::latest()->where('user_id', auth()->user()->id )->paginate(10);
            return response()->json(['results' => $results]);
        }
    }
}
