<?php

namespace App\Http\Controllers\Backend;
use App\Models\User;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RequestUser;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    public function index(){
        $this->authorize('check', User::class);
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
        $this->authorize('check', User::class);
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
        if($user->save()){
            Session::flash('message', 'Thêm mới thành công');
            Session::flash('alert-type', 'success');
        }else{
            Session::flash('message', 'Thêm mới thất bại');
            Session::flash('alert-type', 'error');
        }
        return redirect()->route('backend.user.index');
    }

    public function forceDelete($id){
        
        $user = User::onlyTrashed()->findOrFail($id);
        $this->authorize('isAdmin', User::class);
        if ($user->avatar != 'storage/images/user_avatar/default-avatar.jpg') {
            File::delete($user->avatar);
        }
        if($user->forceDelete()){
            Session::flash('message', 'Xóa thành công');
            Session::flash('alert-type', 'success');
        }else{
            Session::flash('message', 'Xóa thất bại');
            Session::flash('alert-type', 'error');
        }
        return redirect()->back();
    }

    public function editStatus($id){
        $this->authorize('isAdmin', User::class);
    	$user = User::withTrashed()->findOrFail($id);
    	if ($user->status == 1) {
    		$user->status = 0;
    	}else{
    		$user->status = 1;
    	}
    	if($user->update()){
            Session::flash('message', 'Thay đổi hoạt động thành công');
            Session::flash('alert-type', 'success');
        }else{
            Session::flash('message', 'Thay đổi hoạt động thất bại');
            Session::flash('alert-type', 'error');
        }
        return redirect()->route('backend.user.index');
    }

    public function openOrBlock($id){
    	$user = User::withTrashed()->findOrFail($id);
        $this->authorize('isAdmin', User::class);
    	if ($user->trashed()) {
    		if($user->restore()){
                Session::flash('message', 'Mở khóa tài khoản thành công');
                Session::flash('alert-type', 'success');
            }else{
                Session::flash('message', 'Mở khóa tài khoản thất bại');
                Session::flash('alert-type', 'error');
            }
    	}else{
    		if($user->delete()){
                Session::flash('message', 'Khóa tài khoản thành công');
                Session::flash('alert-type', 'success');
            }else{
                Session::flash('message', 'Khóa tài khoản thất bại');
                Session::flash('alert-type', 'error');
            }
    	}
    	$user->save();
    	return redirect()->route('backend.user.index');
    }

    public function showProducts(Request $request,$id){
        $this->authorize('check', User::class);
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
