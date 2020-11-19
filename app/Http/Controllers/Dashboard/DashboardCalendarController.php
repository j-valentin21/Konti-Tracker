<?php

namespace App\Http\Controllers\Dashboard;

use App\Calendar;
use App\Http\Controllers\Controller;
use App\Http\Resources\CalendarResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardCalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard.calendar.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $new_calendar = Calendar::create($request->all());
        return response()->json([
            'data' => new CalendarResource($new_calendar),
            'message' => 'Successfully added new event!',
            'status' => Response::HTTP_CREATED
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function show(Calendar $calendar)
    {
        return response($calendar, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Calendar  $calendar
     * @return JsonResponse
     */
    public function update(Request $request, Calendar $calendar)
    {
        $calendar->update($request->all());
        return response()->json([
            'data' => new CalendarResource($calendar),
            'message' => 'Successfully updated event!',
            'status' => Response::HTTP_ACCEPTED
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $calendar
     * @return \Illuminate\Http\Response
     *
     */
    public function destroy(Calendar $calendar)
    {
        $calendar->delete();
        return response('Event removed successfully!', Response::HTTP_NO_CONTENT);
    }

    /**
     * Get data to update points chart in dashboard.
     *
     * @return JsonResponse
     */
    public function getCalendarData()
    {
//        $calendar = Calendar::find(8);
        $resource = CalendarResource::collection(Calendar::all());
        return response()->json(['resource' => $resource]);
    }
}
