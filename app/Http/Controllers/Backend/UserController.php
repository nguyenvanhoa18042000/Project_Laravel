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
        $this->authorize('isQtvOrAdmin', User::class);
    	$users = User::withTrashed()->orderBy('role','DESC')->paginate(5);
    	return view('backend.users.index')->with([
    		'users' => $users
    	]);
    }

    public function create(){
        $this->authorize('isAdmin', User::class);
        return view('backend.users.create');
    }

    public function show(Request $request,$id){
        $this->authorize('isQtvOrAdmin', User::class);
        $user = User::withTrashed()->where('id',$id)->first();
        return view('backend.users.detail')->with([
            'user' => $user
        ]);
    }

     public function store(RequestUser $requestUser){
        $this->authorize('isAdmin', User::class);
        $user = new User();
        $user->name = $requestUser->get('name');
        $user->email = $requestUser->get('email');

        if($requestUser->hasFile('avatar')){
            $image = $requestUser->file('avatar');
            $name_image = date('YmdHis')."_".$image->getClientOriginalName();
            Storage::disk('public')->putFileAs('images/user_avatar/',$image,$name_image);
            $user->avatar = 'storage/images/user_avatar/'.$name_image;
        }else{
            $user->avatar = 'storage/images/user_avatar/default-avatar.jpg';
        }

        $user->password = bcrypt($requestUser->get('password'));
        $user->address = $requestUser->get('address');
        $user->phone = $requestUser->get('phone');
        $user->role = $requestUser->get('role');
        $user->save();
        return redirect()->route('backend.user.index');
    }

    public function forceDelete($id){
        $this->authorize('isAdmin', User::class);
        $user = User::onlyTrashed()->where('id',$id)->get();
        $user->forceDelete();
        return redirect()->back();
    }

    public function editStatus($id){
        $this->authorize('isAdmin', User::class);
    	$user = User::withTrashed()->where('id',$id)->first();
    	if ($user->status == 1) {
    		$user->status = 0;
    	}else{
    		$user->status = 1;
    	}
    	$user->update();
    	return redirect()->route('backend.user.index');
    }

    public function openOrBlock($id){
        $this->authorize('isAdmin', User::class);
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
        $this->authorize('isQtvOrAdmin', User::class);
        $products = User::withTrashed()->where('id',$id)->first()->products()->orderBy('updated_at','DESC')->paginate(4);
        $categories=Category::all();
        if($request->name) $products->where('name','like','%'.$request->name.'%');
        if($request->category_id) $products->where('category_id',$request->category_id);
        return view('backend.products.index')->with([
            'products' => $products,
            'categories' => $categories
        ]);
    }

}
