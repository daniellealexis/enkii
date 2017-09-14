<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'twitter_handle', 'job_title', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    private $validationRules = [
        'name' => 'string',
        'email' => 'email|unique:users',
        'twitter_handle' => 'nullable|string|max:15',
        'job_title' => 'nullable|string|max:50',
    ];

    protected static function boot()
    {
        parent::boot();

        // Cascade delete related models
        static::deleting(function ($user) {
            $user->lists()->delete();
        });
    }

    public function createValidator($data)
    {
        return Validator::make($data, $this->validationRules);
    }

    public function lists()
    {
        return $this->hasMany('App\Lists');
    }
}
