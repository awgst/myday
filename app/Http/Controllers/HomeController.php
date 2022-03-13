<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified')->only('authenticated');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            redirect()->route('authenticated');
        }
        
        return view('welcome');
    }

    public function authenticated()
    {
        $user = Auth::user();
        return view('home', compact('user'));
    }
}
