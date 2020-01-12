<?php

namespace App\Http\Controllers\Backend;
use App\Models\User;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RequestUser;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function index(){
    	$users = User::withTrashed()->orderBy('role','DESC')->paginate(5);
    	return view('backend.users.index')->with([
    		'users' => $users
    	]);
    }

    public function create(){
        return view('backend.users.create');
    }

    public function show(Request $request,$id){
        $user = User::withTrashed()->where('id',$id)->first();
        return view('backend.users.detail')->with([
            'user' => $user
        ]);
    }

     public function store(RequestUser $requestUser){
        $user = new User();
        $user->name = $requestUser->get('name');
        $user->email = $requestUser->get('email');
        $user->password = bcrypt($requestUser->get('password'));
        $user->address = $requestUser->get('address');
        $user->phone = $requestUser->get('phone');
        $user->role = $requestUser->get('role');
        $user->save();
        return redirect()->route('backend.user.index');
    }

    public function destroy($id){
        $user = User::withTrashed()->where('id',$id)->first();
        $user->forceDelete();
        return redirect()->back();
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
