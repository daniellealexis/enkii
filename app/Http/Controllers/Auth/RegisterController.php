<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [
            'username.regex' => 'Username can only contain A-Z, 0-9, -, and _',
            'password.regex' => 'Password must contain at least one lowercase, uppercase, number and special character.',
        ];

        return Validator::make($data, [
            'username' => 'required|string|max:28|unique:users|regex:/[a-zA-Z0-9\-_]+/',
            'name' => 'required|string|max:128',
            'email' => 'required|string|email|max:254|unique:users',
            'password' => 'required|string|min:8|confirmed|regex:/^(?:(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W])).+$/',
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'api_token' => hash('sha256',$data['username'] . random_bytes(512)),
        ]);
    }
}