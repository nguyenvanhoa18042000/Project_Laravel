<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Trademark;

class HomeController extends Controller
{
    public function index(){
    	//$file = Storage::disk('public')->put('images/file_test.txt', 'Contents');
    	//$exists = Storage::disk('local')->exists('test.txt');
    	// $download = Storage::disk('public')->download('images/file_test.txt');

    	// Storage::copy('file.txt', 'public/images/file.txt');

		// Storage::move('public/images/file_test.txt', 'file_test.txt');
		//Storage::delete('file_test.txt');

		//$files = Storage::disk('public')->files('images/test');
		//$files = Storage::disk('public')->allFiles('images');
		// $files = Storage::allFiles(); lấy tất cả các file trong thư mục app
		//$file = Storage::deleteDirectory('a');
    	//dd(1);
    	return view('frontend.home');
    }

    public function detailProduct($id){
        $product =  Product::with(['category:id,name','product_images'])->findOrFail($id);
        $products = Product::where('category_id',$product->category_id)->orderBy('id','DESC')->paginate(15);
        $ratings = Rating::where('product_id',$id)->orderBy('id','DESC')->paginate(2);

        $rating_level = array();
        for ($i=1; $i <=5 ; $i++) { 
            $rating_level[$i] = $product->ratings()->where('number_star',$i)->count();
        }
        
        return view('frontend.detail_product')->with([
            'product' => $product,
            'products' => $products,
            'rating_level' => $rating_level,
            'ratings' => $ratings,
        ]);
    }

    public function detailCategory($id){
        $category = Category::findOrFail($id);
        $trademarks = $category->trademarks;

        $products = Product::select('id','name','image','sale_price','total_rating','total_number_star')->where('category_id',$id)->get();
        return view('frontend.detail_category')->with([
            'category' => $category,
            'products' => $products,
            'trademarks' => $trademarks,
        ]);
    }

    public function detailCategoryByTrademark($idCategory,$idTrademark){
        $category = Category::findOrFail($idCategory);
        $trademark_search = Trademark::findOrFail($idTrademark);
        $trademarks = $category->trademarks;

        $products = Product::select('id','name','image','sale_price','total_rating','total_number_star','trademark_id')->where('category_id',$idCategory)->where('trademark_id',$idTrademark)->get();
        return view('frontend.detail_category')->with([
            'trademark_search' => $trademark_search,
            'category' => $category,
            'products' => $products,
            'trademarks' => $trademarks,
        ]);
    }

    public function detailCategoryByPrice($idCategory,$minPrice,$maxPrice){
        $category = Category::findOrFail($idCategory);
        $trademarks = $category->trademarks;

        $products = Product::select('id','name','image','sale_price','total_rating','total_number_star','sale_price')->where('category_id',$idCategory)->where('sale_price','>',$minPrice)->where('sale_price','<',$maxPrice)->get();
        return view('frontend.detail_category')->with([
            'category' => $category,
            'products' => $products,
            'trademarks' => $trademarks,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice
        ]);
    }

    public function detailCategoryByTrademarkAndPrice($idCategory,$idTrademark,$minPrice,$maxPrice){
        $category = Category::findOrFail($idCategory);
        $trademark_search = Trademark::findOrFail($idTrademark);
        $trademarks = $category->trademarks;

        $products = Product::select('id','name','image','sale_price','total_rating','total_number_star','sale_price')->where('category_id',$idCategory)->where('sale_price','>',$minPrice)->where('sale_price','<',$maxPrice)->where('trademark_id',$idTrademark)->get();
        return view('frontend.detail_category')->with([
            'category' => $category,
            'products' => $products,
            'trademark_search' => $trademark_search,
            'trademarks' => $trademarks,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice
        ]);
    }
    
}
