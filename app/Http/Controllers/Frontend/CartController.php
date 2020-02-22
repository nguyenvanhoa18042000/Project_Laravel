<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

class CartController extends Controller
{
    public function index(){
    	$categories = Cache::remember('categories', 60*60*24, function() {
            return Category::withTrashed()->orderBy('created_at','ASC')->paginate(7);
        });

    	$products = \Cart::content();
    	return view('frontend.cart')->with([
    		'categories' => $categories,
    		'products' => $products,
    	]);
    }

    public function addProduct(Request $request,$id){
    	$product = Product::select('id','name','slug','amount','image','origin_price','sale_price','discount_percent')->findOrFail($id);

        if ($product->amount < 1) {
            Session::flash('message', 'Sản phẩm đã hết hàng');
            Session::flash('alert-type', 'error');
            return redirect()->back();
        }
    	$sale_price = $product->sale_price;
    	$discount_percent = $product->discount_percent;
    	$price = $sale_price - ($sale_price * $discount_percent/100);
    	\Cart::add([
    		'id' => $id, 
    		'name' => $product->name,
    		'qty' => 1,
    		'price' => $price,
    		'weight' => 0,
    		'options' => ['origin_price' => $product->origin_price, 'sale_price' => $sale_price, 'slug' => $product->slug, 'discount_percent' => $discount_percent, 'image' => $product->image],
    	]);

        Session::flash('message', 'Thêm vào giỏ hàng thành công');
        Session::flash('alert-type', 'success');
    	return redirect()->back();
    }

    public function addProductWithQuantity(Request $request,$id){
        $qty_product = $request->get('quantity_product');
        $product = Product::select('id','name','slug','amount','image','origin_price','sale_price','discount_percent')->findOrFail($id);

        if ($qty_product > $product->amount) {
            Session::flash('message', 'Không đủ đáp ứng số lượng sản phẩm');
            Session::flash('alert-type', 'error');
            return redirect()->back();
        }else{
            $sale_price = $product->sale_price;
            $discount_percent = $product->discount_percent;
            $price = $sale_price - ($sale_price * $discount_percent/100);
            $bol = \Cart::add([
                'id' => $id, 
                'name' => $product->name,
                'qty' => $qty_product,
                'price' => $price,
                'weight' => 0,
                'options' => ['origin_price' => $product->origin_price, 'sale_price' => $sale_price, 'slug' => $product->slug, 'discount_percent' => $discount_percent, 'image' => $product->image],
            ]);
            Session::flash('message', 'Thêm vào giỏ hàng thành công');
            Session::flash('alert-type', 'success');
            return redirect()->back();
        }
    }

    public function destroy($id){
    	\Cart::remove($id);
    	return redirect()->back();
    }

    public function updateQuantityProduct(Request $request){
        if ($request->ajax()) {
            $rowId = $request->rowId;
            $qty = $request->quantity_product;
            \Cart::update($rowId,$qty);
            return response()->json(['code'=>1]);
        }
    }

    public function getFormPay(){
    	$categories = Cache::remember('categories', 60*60*24, function() {
            return Category::withTrashed()->orderBy('created_at','ASC')->paginate(7);
        });
        $products = \Cart::content();
    	return view('frontend.checkout')->with([
    		'categories' => $categories,
    		'products' => $products,
    	]);	
    }

    public function saveInfoShoppingCart(Request $request){
        $user = Auth::user();
        $totalMoney = str_replace(',', '', \Cart::subtotal(0,3));
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->total_money = $totalMoney;
        $order->email = ($request->email != null) ? $request->email : $user->email;
        $order->address = ($request->address != null) ? $request->address : $user->address;
        $order->phone_number = ($request->phone != null) ? $request->phone : $user->phone;
        $order->note = $request->note;

        if ($order->save()) {
            $products = \Cart::content();
            $total_money_origin = 0;
            foreach ($products as $key => $product) {
                $order->products()->attach([
                $product->id => [
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $product->qty,
                    'origin_price' => $product->options->origin_price,
                    'sale_price' => $product->options->sale_price,
                    'discount_percent' => $product->options->discount_percent,
                ]]);
                $total_money_origin += $product->qty * $product->options->origin_price;
            }
            $order->revenue = $order->total_money - $total_money_origin;
            $order->update();
            \Cart::destroy();
            Session::flash('message', 'Đã đặt hàng thành công');
            Session::flash('alert-type', 'success');
        }else{
            Session::flash('message', 'Có lỗi xảy ra. Đặt hàng thất bại');
            Session::flash('alert-type', 'error');
        }

        $info_products_in_order = $order->products;
        foreach ($info_products_in_order as $product) {
            $product->amount = ($product->amount) - ($product->pivot->quantity);
            $product->amount_sold += $product->pivot->quantity;
            $product->update();
        }
        return redirect('/');
    }
}
