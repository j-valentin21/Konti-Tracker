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
        try {
            $userId = auth()->user()->id;
            $notifications = (new NotificationService())->userNotifications(auth()->user()->id);
            return view('dashboard.activity.index',[
                'count'=> $notifications['count'],
                'notifications' => $notifications['notifications'],
                'userId' => $userId
            ]);
        } catch(\Exception $e ) {
            return view('errors.404');
        }
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

    /**
     * Get data to view all activities in dashboard.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getActivityData(request $request): JsonResponse
    {
        if(!empty($request->activity)) {
            $pagination = 10;
        } else {
            $pagination = 5;
        }
        $activity = Activity::latest()->where('user_id', auth()->user()->id )->with('user')->paginate($pagination);
        $data = $activity;
        return response()->json($data);
    }
}
