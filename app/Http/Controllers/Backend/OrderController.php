<?php

namespace App\Http\Controllers\Backend;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller{
	public function index(){
		$orders = Order::with('user:id,name')->paginate(4);
		return view('backend.orders.index')->with([
			'orders' => $orders,
    	]);
	}

	public function show(Request $request,$id){
		if ($request->ajax()) {
			$order = Order::where('id',$id)->get();

			$html = view('backend.orders.detail',compact('order'))->render();
			return \response()->json($html);
		}
	}

    // public function showProducts($order_id){
    // 	$order = Order::find($order_id);
    // 	$products = $order->products;
    // 	return view('backend.order.index')->with([
    // 		'products' => $products,
    // 		'order' => $order
    // 	]);
    // }
}
