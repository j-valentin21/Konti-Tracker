<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Create relationship between user and profile
     *
     * @return HasOne
     */
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }
    /**
     * Create relationship between user and calendar
     *
     * @return HasMany
     */
    public function calendar(): HasMany
    {
        return $this->hasMany(Calendar::class);
    }
    /**
     * Create relationship between user and requestPTO
     *
     * @return HasMany
     */
    public function p_t_o_request(): HasMany
    {
        return $this->hasMany(PTORequest::class);
    }
    /**
     * Create relationship between user and requestPTO
     *
     * @return HasMany
     */
    public function activity(): HasMany
    {
        return $this->hasMany(Activity::class);
    }
}
