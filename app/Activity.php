<?php

namespace App;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class Activity extends Model
{
    protected $guarded = [];

    /**
     * Get the user's date and format to m/d/y.
     *
     * @param string $value
     * @return string
     *
     */
    public function getDateAttribute(string $value)
    {
        return $this->attributes['date'] = (new Carbon($value))->format('m/d/y');
    }

    /**
     * Get the user's time and format to 12HR time format.
     *
     * @param string $value
     * @return string
     *
     */
    public function getTimeAttribute(string $value)
    {
        return  $this->attributes['time'] = (new Carbon($value))->timezone('America/New_York')->format('g:i A');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
