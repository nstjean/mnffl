<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin', 'team_name', 'profile_pic'
    ];

    /**
     * The attributes with a default value.
     *
     * @var array
     */
    protected $attributes = [
       'is_admin' => 0,
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
     * Check if user is an admin
     */
    public function isAdmin() {
        return $this->is_admin;
    }

    /**
     * Get the posts for this user
     */
    public function posts()
    {
        return $this->hasMany('App\Post', 'user_id', 'id');
    }
}
