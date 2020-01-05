<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // if (Auth::check()) {
        //     echo "ok login";
        //     dd();
        // }
        // $id = Auth::user()->id; //Lấy về ID người .
        // $user = Auth::user(); // Lấy về tất cả các thông tin của người dùng.
        // $email = Auth::user()->email; // Lây về email người dùng.
        // dd($user);
        return view('home');
    }
    
}
