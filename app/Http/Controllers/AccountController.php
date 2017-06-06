<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use Illuminate\Http\Request;
use App\Http\User;
use Illuminate\Support\Facades\Validator;

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
        if (Auth::check()) {
            return view('pages.account', $this->getDataForRender());
        } else {
            return redirect()->route('home');
        }
    }

    private function getDataForRender()
    {
        $user = Auth::user();

        return [
            'name'=>$user['name'],
            'email'=>$user['email'],
            'twitterHandle'=>$user['twitter_handle'],
            'jobTitle'=>$user['job_title'],
        ];
    }

    public function updateAccount(Request $request)
    {
        if (!Auth::check()) {
            // redirect to not allowed
        }

        $user = Auth::user();

        // Add validation
        // https://laravel.io/forum/06-05-2014-updating-data-to-database

        $user->update($request->all());
        $user->save();

        return Redirect::route('account')->with('message', 'You have successfully updated your account');
    }
}
