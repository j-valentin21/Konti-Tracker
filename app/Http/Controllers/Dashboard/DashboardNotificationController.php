<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardNotificationController extends Controller
{
    /**
     * View all notifications.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count = auth()->user()->notifications->count();
        $notifications = auth()->user()->notifications()->paginate(10);
        $userId = auth()->user()->id;
        return view('dashboard.notification.index',[
            'count'=>$count,
            'notifications' => $notifications,
            'userId' => $userId,
        ]);
    }

    /**
     * Delete one or all notifications associated with user.
     *
     * @param  $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy( $id, request $request)
    {
        if(!empty($request->deleteAll)) {
            auth()->user()->notifications()->delete();
            $results = auth()->user()->notifications()->paginate(4);
            return response()->json(['results' => $results]);
        } else {
            auth()->user()->notifications->find($id)->delete();
            $results = auth()->user()->notifications()->paginate(4);
            return response()->json(['results' => $results]);
        }
    }
}
