<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PTOPointsDataRequest;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use MultipleIterator;

class DashboardPTOPointsController extends Controller
{
    /**
     * Show dashboard weather view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $profile = Profile::find(auth()->user()->id);
        $ptoDays = $profile->pto_usage;
        $points = $profile->points_usage;
        $count = auth()->user()->notifications->count();
        $notifications = Auth()->user()->notifications()->limit(8)->get();
        $month = ['January', 'February', 'March', 'April', 'May', 'June', 'July',
            'August', 'September', 'October', 'November', 'December'];
        $ptoMonths = array('Jan' => $ptoDays['Jan'], 'Feb' => $ptoDays['Feb'], 'Mar' => $ptoDays['Mar'], 'Apr' => $ptoDays['Apr'],
            'May' => $ptoDays['May'], 'June' => $ptoDays['June'], 'July' => $ptoDays['July'], 'Aug' => $ptoDays['Aug'],
            'Sept' => $ptoDays['Sept'], 'Oct' => $ptoDays['Oct'], 'Nov' => $ptoDays['Nov'], 'Dec' => $ptoDays['Dec']);
        $pointMonths = array('Jan' => $points['Jan'], 'Feb' => $points['Feb'], 'Mar' => $points['Mar'], 'Apr' => $points['Apr'],
            'May' => $points['May'], 'June' => $points['June'], 'July' => $points['July'], 'Aug' => $points['Aug'],
            'Sept' => $points['Sept'], 'Oct' => $points['Oct'], 'Nov' => $points['Nov'], 'Dec' => $points['Dec']);
        $results = new MultipleIterator();
        $results->attachIterator( new \ArrayIterator($ptoMonths));
        $results->attachIterator( new \ArrayIterator($month));
        $results->attachIterator( new \ArrayIterator($pointMonths));
        return view('dashboard.pto-points.index', ['results'=> $results, 'count'=>$count, 'notifications' => $notifications]);
    }

    /**
     * Update dashboard pto/points data view.
     *
     * @param Request $request
     */
    public function update(PTOPointsDataRequest $request)
    {
        $redis = Redis::connection();
        $profile = Profile::find(auth()->user()->id);
        $ptoMonths = array_map('floatval', $request->request->get('pto_used', []));
        $pointsMonths = array_map('intval', $request->request->get('points_used', []));;
        $profile->pto_usage = $profile->sortMonths($ptoMonths);
        $profile->points_usage = $profile->sortMonths($pointsMonths);
        $redis->set('message_' .  auth()->id(), 'Your PTO/Points data was successfully updated!');
        $redis->expire('message_' . auth()->id(),5);
        $profile->save();
        return redirect('/dashboard');
    }
}
