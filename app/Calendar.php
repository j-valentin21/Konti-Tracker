<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_name', 'start_date', 'end_date',
    ];
    /**
     * Get the user that owns the calendar events.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
