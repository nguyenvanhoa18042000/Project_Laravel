<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rating;
use App\Models\Product;
use Carbon\Carbon;

class RatingController extends Controller{
    public function index(){
        $ratings = Rating::with('user:id,name','product:id,name')->withTrashed()->orderBy('created_at','DESC')->paginate(9);

        return view('backend.ratings.index')->with(['ratings' => $ratings]);
    }

    public function forceDelete($id){
        $rating = Rating::withTrashed()->findOrFail($id);
        $rating->forceDelete();
        return redirect()->route('backend.rating.index');
    }

    public function store(Request $requet,$id){
        $product = Product::findOrFail($id);
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

    		$product->total_rating +=1;
    		$product->total_number_star += $requet->number_star;
    		$product->save();

    		return response()->json(['code' => $product->save()]);
    	}
    }
}
