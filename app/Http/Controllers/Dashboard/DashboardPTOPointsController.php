<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PTOPointsDataRequest;
use App\Profile;
use App\Services\NotificationService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use MultipleIterator;

class DashboardPTOPointsController extends Controller
{
    /**
     * Show dashboard PTO/points view.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        try {
            $profile = Profile::find(auth()->user()->id);
            $notifications = (new NotificationService())->userNotifications(auth()->user()->id);
            $results = new MultipleIterator();
            $results->attachIterator( new \ArrayIterator($profile->sortMonthsByMonth($profile->pto_usage)));
            $results->attachIterator( new \ArrayIterator($profile->fullMonths()));
            $results->attachIterator( new \ArrayIterator($profile->sortMonthsByMonth($profile->points_usage)));
            return view('dashboard.pto-points.index', [
                'results' => $results,
                'count' => $notifications['count'],
                'notifications' => $notifications['notifications']
            ]);
        } catch(\Exception $e ) {
            return view('errors.404');
        }
    }

    /**
     * Update dashboard pto/points data view.
     *
     * @param PTOPointsDataRequest $request
     * @return RedirectResponse
     */
    public function update(PTOPointsDataRequest $request): RedirectResponse
    {
        $redis = Redis::connection();
        $profile = Profile::find(auth()->user()->id);
        $ptoMonths = array_map('floatval', $request->request->get('pto_used', []));
        $pointsMonths = array_map('intval', $request->request->get('points_used', []));
        $profile->pto_usage = $profile->sortMonths($ptoMonths);
        $profile->points_usage = $profile->sortMonths($pointsMonths);
        $redis->set('message_' .  auth()->id(), 'Your PTO/Points data was successfully updated!');
        $redis->expire('message_' . auth()->id(),5);
        $profile->save();
        return redirect('/dashboard');
    }
}
