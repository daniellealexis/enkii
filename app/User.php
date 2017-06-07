<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'twitter_handle', 'job_title',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    private $validationRules = [
        'name' => '',
        'email' => '',
        'password' => '',
        'twitter_handle' => '',
        'job_title' => '',
    ];

    public function createValidator($data)
    {
        return new Validator($data, $this->rules);
    }
}
