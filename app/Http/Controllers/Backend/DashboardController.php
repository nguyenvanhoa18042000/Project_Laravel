<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use App\Models\Product;
use App\Models\User;
use App\Models\Rating;
use App\Models\Order;
use App\Models\Post;
use App\Models\Contact;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
    	$contacts = Contact::select('id','name','title','status')->orderBy('id','DESC')->take(10)->get();
    	$ratings = Rating::with('user:id,name','product:id,name,slug')->select('id','product_id','user_id','number_star')->orderBy('id','DESC')->take(10)->get();
    	$orders = Order::with('user:id,name')->select('id','user_id','total_money','phone_number','status','created_at')->orderBy('id','DESC')->take(10)->get();

    	//doanh thu ngày
    	$moneyDay = Order::whereDay('updated_at',date('d'))->where('status',Order::STATUS_DONE)->sum('revenue');

    	//doanh thu tuần
    	$moneyWeek = Order::whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('status',Order::STATUS_DONE)->sum('revenue');

    	//doanh thu tháng
    	$moneyMonth = Order::whereMonth('updated_at',date('m'))->where('status',Order::STATUS_DONE)->sum('revenue');

    	//doanh thu tháng
    	$moneyYear = Order::whereYear('updated_at',date('Y'))->where('status',Order::STATUS_DONE)->sum('revenue');
    	$dataMoney = [
    		[
    			"name" => "Doanh thu ngày",
    			"y" => (int)$moneyDay
    		],
    		[
    			"name" => "Doanh thu tuần",
    			"y" => (int)$moneyWeek
    		],
    		[
    			"name" => "Doanh thu tháng",
    			"y" => (int)$moneyMonth
    		],
    		[
    			"name" => "Doanh thu năm",
    			"y" => (int)$moneyYear
    		],
    	];
    	
    	$number_products = Product::select('id')->withTrashed()->count();
    	$number_orders = Order::select('id')->count();
    	$number_posts = Post::select('id')->withTrashed()->count();
    	$number_users = User::select('id')->withTrashed()->count();
    	
    	return view('backend.dashboard')->with([
    		'contacts' => $contacts,
    		'ratings' => $ratings, 
    		'orders' => $orders,
    		'dataMoney' => json_encode($dataMoney),
    		'number_products' => $number_products,
    		'number_users' => $number_users,
    		'number_posts' => $number_posts,
    		'number_orders' => $number_orders,
    	]);
    }
}
