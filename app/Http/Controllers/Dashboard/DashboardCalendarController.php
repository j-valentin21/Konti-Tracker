<?php

namespace App\Http\Controllers\Dashboard;

use App\Calendar;
use App\Http\Controllers\Controller;
use App\Http\Resources\CalendarResource;
use App\Services\NotificationService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardCalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $notifications = (new NotificationService())->userNotifications(auth()->user()->id);
        return view('dashboard.calendar.index',[
            'count'=> $notifications['count'],
            'notifications' => $notifications['notifications']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $new_calendar = Calendar::create($request->all());
        $new_calendar->user_id = auth()->id();
        $new_calendar->save();
        return response()->json([
            'data' => new CalendarResource($new_calendar),
            'message' => 'Successfully added new event!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Calendar $calendar
     * @return \Illuminate\Http\Response
     */
    public function show(Calendar $calendar): \Illuminate\Http\Response
    {
        return response($calendar, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Calendar $calendar
     * @return JsonResponse
     */
    public function update(Request $request, Calendar $calendar): JsonResponse
    {
        $calendar->user_id = auth()->id();
        $calendar->update($request->all());
        return response()->json([
            'data' => new CalendarResource($calendar),
            'message' => 'Successfully updated event!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $calendar
     * @return \Illuminate\Http\Response
     *
     */
    public function destroy(Calendar $calendar): \Illuminate\Http\Response
    {
        $calendar->delete();
        return response(['message' => 'Your Event has been successfully removed']);
    }

    /**
     * Get data to update points chart in dashboard.
     *
     * @return JsonResponse
     */
    public function getCalendarData(): JsonResponse
    {
        $calendar = Calendar::where("user_id", "=", auth()->id())->get();
        $resource = CalendarResource::collection($calendar);
        return response()->json(['resource' => $resource]);
    }
}
