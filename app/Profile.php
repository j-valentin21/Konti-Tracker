<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'position','pto', 'points','avatar','user_id','date_of_employment'
    ];

    protected $casts = [
        'pto_usage' => 'array',
        'points_usage' => 'array'
    ];

    /**
     * Returns an integer that gives you a two day expiration date.
     *
     * @return int
     */
    public function expireDate():int
    {
        return 60*60*24*2;
    }

    /**
     * Create an array of months to be stored in the database and return the current month.
     *
     * @return string
     */
    public function getChartMonth(): string
    {
        if ($this->pto_usage === null || $this->points_usage === null) {
            $months = array('Jan' => 0, 'Feb' => 0, 'Mar' => 0, 'Apr' => 0, 'May' => 0, 'June' => 0,
                'July' => 0, 'Aug' => 0, 'Sept' => 0, 'Oct' => 0, 'Nov' => 0, 'Dec' => 0);
            $graph_date = $this->updated_at;
            $graph_month = $graph_date->shortEnglishMonth;
            $this->pto_usage = $months;
            $this->points_usage = $months;
            $this->save();
            return $graph_month;
        } else {
            $graph_date = $this->updated_at;
            $graph_month = $graph_date->shortEnglishMonth;
            return $graph_month;
        }
    }

    /**
     * Update year_count to correct year .
     *
     */
    public function updateYearCount():void
    {
        $graph_year = date('Y');

        if($graph_year >= $this->user->year_count) {
            $this->user->year_count = $graph_year + 1;
            $this->user->save();
        }
    }

    /**
     * Reset month array at the end of the year.
     *
     */
    public function resetMonths():void
    {
        $graph_year = date('Y');

        if($graph_year >= $this->user->year_count) {
            $months = array('Jan' => 0, 'Feb' => 0, 'Mar' => 0, 'Apr' => 0, 'May' => 0, 'June' => 0,
                'July' => 0, 'Aug' => 0, 'Sept' => 0, 'Oct' => 0, 'Nov' => 0, 'Dec' => 0);
            $this->pto_usage = $months;
            $this->points_usage = $months;
            $this->save();
        }
    }

    /**
     * Sort months based on number of array.
     * @param $data //PTO or points array name
     * @return array
     */
    public function sortMonths($data):array
    {
        return array('Jan' => $data[0], 'Feb' => $data[1], 'Mar' => $data[2], 'Apr' => $data[3], 'May' => $data[4], 'June' => $data[5],
            'July' => $data[6], 'Aug' => $data[7], 'Sept' => $data[8], 'Oct' => $data[9], 'Nov' => $data[10], 'Dec' => $data[11]);
    }

    /**
     * Sort months based on month.
     * @param $profile  //PTO or points array name
     * @return array
     */
    public function sortMonthsByMonth($profile): array
    {
        return array('Jan' => $profile['Jan'], 'Feb' => $profile['Feb'], 'Mar' => $profile['Mar'], 'Apr' => $profile['Apr'], 'May' => $profile['May'],
            'June' => $profile['June'], 'July' => $profile['July'], 'Aug' => $profile['Aug'], 'Sept' => $profile['Sept'], 'Oct' => $profile['Oct'],
            'Nov' => $profile['Nov'], 'Dec' => $profile['Dec']);
    }

    /**
     * Arrange months in order with full name.
     *
     * @return array
     */
    public function fullMonths(): array
    {
        return ['January', 'February', 'March', 'April', 'May', 'June', 'July',
            'August', 'September', 'October', 'November', 'December'];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
