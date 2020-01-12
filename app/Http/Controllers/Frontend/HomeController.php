<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{
    public function index(){
    	//$file = Storage::disk('public')->put('images/file_test.txt', 'Contents');
    	//$exists = Storage::disk('local')->exists('test.txt');
    	// $download = Storage::disk('public')->download('images/file_test.txt');

    	// Storage::copy('file.txt', 'public/images/file.txt');

		// Storage::move('public/images/file_test.txt', 'file_test.txt');
		//Storage::delete('file_test.txt');

		//$files = Storage::disk('public')->files('images/test');
		//$files = Storage::disk('public')->allFiles('images');
		// $files = Storage::allFiles(); lấy tất cả các file trong thư mục app
		//$file = Storage::deleteDirectory('a');
    	//dd(1);
    	return view('frontend.home');
    }
    
}
