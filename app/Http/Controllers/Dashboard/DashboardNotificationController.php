<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardNotificationController extends Controller
{
    /**
     * View all notifications.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        try {
            $count = auth()->user()->notifications->count();
            $notifications = auth()->user()->notifications()->paginate(10);
            $userId = auth()->user()->id;
            return view('dashboard.notification.index',[
                'count'=>$count,
                'notifications' => $notifications,
                'userId' => $userId,
            ]);
        } catch(\Exception $e ) {
            return view('errors.404');
        }
    }

    /**
     * Delete one or all notifications associated with user.
     *
     * @param  $id
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy( $id, request $request): JsonResponse
    {
        if(!empty($request->deleteAll)) {
            Cache::forget('NOTIFICATIONS_' . auth()->user()->id);
            auth()->user()->notifications()->delete();
            $results = auth()->user()->notifications()->paginate(10);
            return response()->json(['results' => $results]);
        } else {
            Cache::forget('NOTIFICATIONS_' . auth()->user()->id);
            auth()->user()->notifications->find($id)->delete();
            $results = auth()->user()->notifications()->paginate(10);
            return response()->json(['results' => $results]);
        }
    }
}
