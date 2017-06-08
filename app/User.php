<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Validator;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'twitter_handle', 'job_title',
    ];

    private $validationRules = [
        'name' => 'string',
        'email' => 'email|unique:users',
        'twitter_handle' => 'nullable|string|max:15',
        'job_title' => 'nullable|string|max:50',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function createValidator($data)
    {
        return Validator::make($data, $this->validationRules);
    }
}
