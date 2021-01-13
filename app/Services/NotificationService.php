<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class NotificationService
{
    /**
     * Get user notifications and count with cache added to request.
     * @param $user_id
     * @return array
     */
    public function userNotifications($user_id):array
    {
        return Cache::remember('NOTIFICATIONS_' . $user_id, Carbon::now()->addMinutes(15), function() {
              $count = auth()->user()->notifications->count();
              $notifications = auth()->user()->notifications()->limit(8)->get();
              return compact('count', 'notifications');
          });
    }
}
