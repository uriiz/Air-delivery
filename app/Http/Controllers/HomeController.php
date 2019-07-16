<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function getUser()
    {
        if(Auth::user()){
            return Auth::user();
        }else{
            return 0;
        }
    }

    public function logOut()
    {

        Auth::logout();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function updateUser()
    {
        return 'https://my.tranzila.com/assets/images/bg1.jpg';
    }
}
