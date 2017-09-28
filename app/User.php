<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'email', 'twitter_handle', 'job_title', 'password', 'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token',
    ];

    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();

        // Cascade delete related models
        static::deleting(function ($user) {
            $user->lists()->delete();
            $user->comments()->delete();
        });
    }

    public function lists()
    {
        return $this->hasMany('App\Lists');
    }

    public function comments()
    {
        return $this->hasMany('App\ListComments');
    }
}
