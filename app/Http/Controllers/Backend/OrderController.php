<?php

namespace App\Http\Controllers\Backend;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller{
	public function index(Request $request){
		$this->authorize('viewAny',Order::class);
		$orders = Order::with('user:id,name')->orderBy('id','DESC')->paginate(7);
		if($request->status_order) {
		$orders = $orders->where('status',$request->status_order);
		};
		return view('backend.orders.index')->with([
			'orders' => $orders,
    	]);
	}

	public function show(Request $request,$id){
		if ($request->ajax()) {
			$order = Order::findOrFail($id);
			$products = $order->products;

			$html = view('backend.orders.detail',compact(['order','products']))->render();
			return \response()->json($html);
		}
	}

	public function destroy($id){
		$order = Order::findOrFail($id);
		$this->authorize('delete',$order);
		$products = $order->products;
		foreach ($products as $product) {
			$product->amount = ($product->amount) + ($product->pivot->quantity);
			$product->amount_sold -= $product->pivot->quantity;
			$product->update();
		}
		$order->products()->detach();
		$order->delete();
		return redirect()->back();
	}

	public function handleOrder(Request $request){
		if ($request->ajax()) {
			$id = $request->id_order;
			$order = Order::findOrFail($id);
			$this->authorize('handleOrder',$order);
			$status = $request->status;
			if ($status == 0) {
				$products = $order->products;
				foreach ($products as $product) {
					$product->amount = ($product->amount) + ($product->pivot->quantity);
					$product->amount_sold -= $product->pivot->quantity;
					$product->update();
				}
			}
			$order->status = $status;
			$order->update();
			return response()->json(['code' => $order->update()]);
		}
	}
}
