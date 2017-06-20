<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use JavaScript;

class DashboardController extends Controller
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
            return view('pages.dashboard', $this->getDataForRender());
        } else {
            return redirect()->route('home');
        }
    }

    private function getDataForRender()
    {
        $user = Auth::user();

        $dataForRender = [
            'user' => [
                'name'=>$user['name'],
                'twitterHandle'=>$user['twitter_handle'],
                'jobTitle'=>$user['job_title'],
            ],
        ];

        JavaScript::put($dataForRender);

        return $dataForRender;
    }
}
