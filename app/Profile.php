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
    /**
     * Returns an integer that gives you a two day expiration date.
     *
     * @return int
     */
    public function expireDate()
    {
        return 60*60*24*2;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
