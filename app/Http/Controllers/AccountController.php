<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

// use user to get editable fields?

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.account', ['user' => Auth::user()]);
    }

    public function updateAccount(AccountRequest $request)
    {
        $flashInfo = [
            'flash' => [
                'message' => 'You have successfully updated your account',
                'type' => 'success',
                'duration' => 5000,
            ]
        ];

        $user = Auth::user();

        $user->name = $request->get('name');
        $user->job_title = $request->get('job_title');
        $user->twitter_handle = $request->get('twitter_handle');

        $user->save();

        return Redirect::route('dashboard')->with($flashInfo);
    }
}
