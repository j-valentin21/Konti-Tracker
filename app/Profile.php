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
        'position','pto', 'points','avatar','user_id,'
    ];

    protected $casts = [
        'pto_usage' => 'array'
    ];
    /**
     * Returns an integer that gives you a two day expiration date.
     *
     * @return int
     */
    public function expireDate()
    {
        return 60*60*24*2;
    }
    /**
     * Create an array of months to be stored in the database and return the current month.
     *
     * @return string
     */
    public function getBarChartMonth()
    {
        if ($this->pto_usage === null) {
            $months = array('Jan' => 0, 'Feb' => 0, 'Mar' => 0, 'Apr' => 0, 'May' => 0, 'June' => 0,
                'July' => 0, 'Aug' => 0, 'Sept' => 0, 'Oct' => 0, 'Nov' => 0, 'Dec' => 0);
            $graph_date = $this->updated_at;
            $graph_month = $graph_date->shortEnglishMonth;
            $this->pto_usage = $months;
            $this->save();
            return $graph_month;
        }
        else {
            $graph_date = $this->updated_at;
            $graph_month = $graph_date->shortEnglishMonth;
            return $graph_month;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
