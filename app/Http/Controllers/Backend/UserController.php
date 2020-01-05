<?php

namespace App\Http\Controllers\Backend;
use App\Models\User;
use App\Models\Category;
use App\Models\Userinfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function test($id){
  //   	$user = User::find($id);
		// $userInfo = $user->user_info;
		// dd($userInfo);

		$user_info = Userinfo::find($id);
		$user = $user_info->use;
		dd($user);
    }
    public function index(){
    	$users = User::withTrashed()->get();
    	return view('backend.users.index')->with([
    		'users' => $users
    	]);
    }

    public function editStatus($id){
    	$user = User::withTrashed()->where('id',$id)->first();
    	if ($user->status == 1) {
    		$user->status = 0;
    	}else{
    		$user->status = 1;
    	}
    	$user->save();
    	return redirect()->route('backend.user.index');
    }

    public function openOrBlock($id){
    	$user = User::withTrashed()->where('id',$id)->first();
    	if ($user->trashed()) {
    		$user->restore();
    	}else{
    		$user->delete();
    	}
    	$user->save();
    	return redirect()->route('backend.user.index');
    }

    public function showProducts(Request $request,$id){
        $products = User::withTrashed()->where('id',$id)->first()->products()->orderBy('updated_at','DESC')->paginate(4);
        $categories=Category::all();
        //dd($request->all());
        if($request->name) $products->where('name','like','%'.$request->name.'%');
        if($request->category_id) $products->where('category_id',$request->category_id);
        //$products = $products->orderBy('updated_at','DESC')->paginate(4);
        // dd($products);
        return view('backend.products.index')->with([
            'products' => $products,
            'categories' => $categories
        ]);
    }
}
