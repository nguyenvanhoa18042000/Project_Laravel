<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index(){
    	return view('frontend.home');
    }
    
}
