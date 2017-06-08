<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use Session;
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
            abort(403);
        }

        $user = Auth::user();

        $requestData = [
            'name' => $request->get('name'),
            'job_title' => $request->get('job_title'),
            'twitter_handle' => $request->get('twitter_handle'),
        ];

        $validator = $user->createValidator($requestData);

        if ($validator->passes()) {
            $user->update($requestData);
            $user->save();

            return Redirect::route('account')->with('flashMessage', 'You have successfully updated your account');
        } else {
            // Reload view with errors
            return Redirect::route('account')->withErrors($validator);
        }
    }
}
