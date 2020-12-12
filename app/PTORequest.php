<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PTORequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reason_for_request', 'pto_days', 'dates', 'times'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'dates' => 'array',
        'start_times' => 'array',
        'end_times' => 'array'
    ];
    /**
     * Get the user that owns the requestPTO events.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

