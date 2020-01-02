<?php

namespace App\Http\Controllers\Backend;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller{
    public function showProducts($order_id){
    	$order = Order::find($order_id);
    	$products = $order->products;
    	return view('backend.orders.index')->with([
    		'products' => $products,
    		'order' => $order
    	]);
    }
}
