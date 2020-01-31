<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RequestTrademark;
use App\Models\Trademark;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TrademarkController extends Controller{

	public function index(){
		$trademarks = Trademark::orderBy('updated_at','DESC')->select('id','name','image')->paginate(7);
    	return view('backend.trademarks.index')->with([
    		'trademarks' => $trademarks
    	]);
    }

    public function create(){
    	return view('backend.trademarks.create');
    }

    public function store(Request $request){
    	$trademark = new Trademark();

        $trademark->name = $request->get('name');
        $trademark->slug = str::slug($request->get('name'));

        $image = $request->file('image');
		$name_image = date('YmdHis')."_".$image->getClientOriginalName();
		Storage::disk('public')->putFileAs('images/trademark/', $image , $name_image);
		$trademark->image = 'storage/images/trademark/'.$name_image;

        $trademark->save();

    	return redirect()->route('backend.trademark.index');
    }

    public function getTrademarks($idCategory){
    	$category = Category::withTrashed()->findOrFail($idCategory);
    	$trademarks = $category->trademarks;

    	foreach ($trademarks as $trademark) {
    		echo "<option value='".$trademark->id."'>".$trademark->name."</option>";
    	}
    }

}
