<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RequestPassword;
use App\Http\Requests\RequestOrder;
use App\Http\Requests\RequestSettingUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\Rating;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Mail;

class ProfileController extends Controller
{
    public function index(){
        $number_order_process = Order::select('id','status')->where('user_id',Auth::user()->id)->where('status',Order::STATUS_PROCESS)->count();
        $number_order_cancelled = Order::select('id','status')->where('user_id',Auth::user()->id)->where('status',Order::STATUS_CANCELLED)->count();
        $number_order_done = Order::select('id','status')->where('user_id',Auth::user()->id)->where('status',Order::STATUS_DONE)->count();
        $number_order_delivery = Order::select('id','status')->where('user_id',Auth::user()->id)->where('status',Order::STATUS_DELIVERY)->count();
        $user_orders = Order::select('id','user_id','total_money','email','address','phone_number','note','status','created_at')->where('user_id',Auth::user()->id)->take(10)->get();
        $user_ratings = Rating::with('product')->take(10)->get();
    	return view('backend.profiles.index')->with([
            'user_orders' => $user_orders,
            'user_ratings' => $user_ratings,
            'number_order_done' => $number_order_done,
            'number_order_cancelled' => $number_order_cancelled,
            'number_order_process' => $number_order_process,
            'number_order_delivery' => $number_order_delivery,
        ]);
    }

    public function userOrder(){
        $orders = Order::select('id','user_id','total_money','email','address','phone_number','note','status','created_at')->where('user_id',Auth::user()->id)->paginate(10);
        return view('backend.profiles.user_order')->with([
            'orders' => $orders,
        ]);
    }

    public function showOrder(Request $request,$id){
        if ($request->ajax()) {
            $order = Order::findOrFail($id);
            $products = $order->products;

            $html = view('backend.orders.detail',compact(['order','products']))->render();
            return \response()->json($html);
        }
    }

    public function editOrder($id){
        $order = Order::findOrFail($id);
        $this->authorize('update',$order);
        return view('backend.orders.edit')->with([
            'order' => $order
        ]);
    }

    public function updateOrder(RequestOrder $requestOrder, $id){
        $order = Order::findOrFail($id);
        $this->authorize('update',$order);
        $order->email = $requestOrder->email;
        $order->address = $requestOrder->address ;
        $order->phone_number = $requestOrder->phone_number ;
        $order->note = $requestOrder->note;
        $order->update();
        \Session::flash('message', 'Chỉnh sửa đơn hàng thành công');
        \Session::flash('alert-type', 'success');
        return redirect()->route('profile.user.order');
    }

    public function forceDelete($id){
        $rating = Rating::withTrashed()->findOrFail($id);
        $rating->forceDelete();
        return redirect()->route('profile.user.rating');
    }

    public function deleteOrder($id){
        $order = Order::findOrFail($id);

        $this->authorize('delete', $order);
        if($order->status == 1){
            $products = $order->products;
            foreach ($products as $product) {
                $product->amount = ($product->amount) + ($product->pivot->quantity);
                $product->amount_sold -= $product->pivot->quantity;
                $product->update();
            }
            $order->products()->detach();
            $order->delete();
        }elseif($order->status == 2 || $order->status == 3){
            $order->status = 0;
            $order->update();
        }
        \Session::flash('message', 'Xóa đơn hàng thành công');
        \Session::flash('alert-type', 'success');
        return redirect()->back();
    }

    public function userRating(){
        $ratings = Rating::with('product:id,name,slug,deleted_at')->select('id','product_id','number_star','content','created_at')->paginate(10);
        return view('backend.profiles.user_rating')->with([
            'ratings' => $ratings,
        ]);
    }

    public function formChangePassword(){
    	return view('backend.profiles.form_change_password');
    }

    public function performChangePassword(RequestPassword $requestPassword){
    	$user = Auth::user();
    	if (Hash::check($requestPassword->password_old, $user->password)) {
    		$info_user = User::findOrFail($user->id);
    		$info_user->password = bcrypt($requestPassword->password);
    		$info_user->update();
			\Session::flash('message', 'Cập nhật mật khẩu thành công');
    		\Session::flash('alert-type', 'success');
    		return redirect()->route('profile.index');		
    	}else{
    		\Session::flash('message', 'Mật khẩu cũ không chính xác');
	    	\Session::flash('alert-type', 'error');
	    	return redirect()->back();
    	}
    }

    public function formSettingUser(){
    	$user = User::findOrFail(Auth::user()->id);
    	return view('backend.profiles.info')->with([
    		'user' => $user,
    	]);
    }

    public function performSettingUser(RequestSettingUser $requestSettingUser){
    	$user = User::findOrFail(Auth::user()->id);
    	$user->name = $requestSettingUser->get('name');
    	$user->phone = $requestSettingUser->get('phone');
    	$user->address = $requestSettingUser->get('address');
    	if ($requestSettingUser->hasFile('avatar')){
    		File::delete($user->avatar);
			$avatar = $requestSettingUser->file('avatar');
			$name_avatar = date('YmdHis')."_".$avatar->getClientOriginalName();
			Storage::disk('public')->putFileAs('images/user_avatar/',$avatar,$name_avatar);
			$user->avatar = 'storage/images/user_avatar/'.$name_avatar;
    	}
    	$user->update();
        \Session::flash('message', 'Chỉnh sửa thông tin thành công');
        \Session::flash('alert-type', 'success');
    	return redirect()->back();
    }

    public function performForgotPassword(Request $request){
    	$email = $request->email;
    	$checkUser = User::where('email',$email)->first();
    	if (!$checkUser) {
    		return redirect()->back()->with('danger','Email không tồn tại');
    	}else{
            $code = mt_rand(1000000000000, 9999999999999);
	    	Mail::send('backend.profiles.forgot_password', array('code'=>$code), function($message) use ($email){

	            $message->to($email, 'Quên mật khẩu')->subject('Siêu thị điện máy');
	        });
            $checkUser->password = Hash::make($code);
            $checkUser->update();
            return redirect()->back()->with('success','Đã gửi thành công, hãy kiểm tra tin nhắn gmail');
    	}
    }
}
