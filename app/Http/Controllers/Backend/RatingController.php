<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rating;
use App\Models\Product;
use Carbon\Carbon;

class RatingController extends Controller{
    public function store(Request $requet,$id){
    	if($requet->ajax()){
    		$user = Auth::user();
    		Rating::insert([
    			'product_id' => $id,
    			'number_star' => $requet->number_star,
    			'content' => $requet->content_rating,
    			'user_id' => Auth::user()->id,
    			'created_at' => Carbon::now(),
    			'updated_at' => Carbon::now()
    		]);

    		$product = Product::findOrFail($id);

    		$product->total_rating +=1;
    		$product->total_number_star += $requet->number_star;
    		$product->save();

    		return response()->json(['code' => '1']);
    	}
    }
}
