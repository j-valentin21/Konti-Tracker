<?php

namespace App;

use Carbon\Carbon;
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
     * Reset month array at the end of the year.
     *
     */
    public function resetMonths():void
    {
        $graph_date = $this->updated_at;
        $graph_year = $graph_date->year;
        if($graph_year >= $this->user->year_count) {
            if($graph_year > $this->user->year_count) {
                $this->user->year_count = $graph_year;
                $this->user->save();
            }
            $months = array('Jan' => 0, 'Feb' => 0, 'Mar' => 0, 'Apr' => 0, 'May' => 0, 'June' => 0,
                'July' => 0, 'Aug' => 0, 'Sept' => 0, 'Oct' => 0, 'Nov' => 0, 'Dec' => 0);
            $this->pto_usage = $months;
            $this->points_usage = $months;
            $this->user->year_count++;
            $this->user->save();
            $this->save();
        }
    }

    /**
     * Sort months based on number of array.
     * @param $data
     * @return array
     */
    public function sortMonths($data):array
    {
        return array('Jan' => $data[0], 'Feb' => $data[1], 'Mar' => $data[2], 'Apr' => $data[3], 'May' => $data[4], 'June' => $data[5],
            'July' => $data[6], 'Aug' => $data[7], 'Sept' => $data[8], 'Oct' => $data[9], 'Nov' => $data[10], 'Dec' => $data[11]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
