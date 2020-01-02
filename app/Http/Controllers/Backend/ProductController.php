<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RequestProduct;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductController extends Controller
{
	public function index(Request $request){
		$products = Product::with('category:id,name');
		if($request->name) $products->where('name','like','%'.$request->name.'%');
		if($request->category_id) $products->where('category_id',$request->category_id);
		$products = $products->orderBy('updated_at','DESC')->paginate(4);
		$categories = $this->getCategories();
		return view('backend.products.index')->with([
			'products' => $products,
			'categories' =>$categories
		]);
	}

	public function showImages($id){
		$product = Product::find($id);
		$images = $product->images;
		return view('backend.products.show_image')->with([
			'images' => $images,
			'product' => $product
		]);
	}

	public function create(){
		$categories = $this->getCategories();
		return view('backend.products.create')->with([
			'categories' => $categories
		]);
	}

	public function store(RequestProduct $requestProduct){
		$this->insertOrUpdate($requestProduct);
    	return redirect()->back();
	}

	public function edit($id){
		$product = Product::find($id);
		$categories = Category::all();
    	return view('backend.products.edit')->with([
    		'product' => $product,
    		'categories' => $categories
    	]);
	}

	public function update(RequestProduct $requestProduct,$id){
		$this->insertOrUpdate($requestProduct,$id);
    	return redirect()->back();
	}

	public function getCategories(){
		return Category::all();
	}

	public function insertOrUpdate($requestProduct,$id=''){
		$status = 1;
		try {
			$name = $requestProduct->get('name');
			$slug = str::slug($name);
			$description = $requestProduct->get('description');
			$content = $requestProduct->get('content');
			$category_id = $requestProduct->get('category_id');
			$origin_price = $requestProduct->get('origin_price');
			$sale_price = $requestProduct->get('sale_price');
			$discount_percent = $requestProduct->get('discount_percent');
			$hot = $requestProduct->get('hot');

			if ($id) {
				$product = Product::find($id);
			}else{
				$product = new Product();
			}
			$product->name = $name;
			$product->slug = $slug;
			$product->description = $description;
			$product->content = $content;
			$product->category_id = $category_id;
			$product->origin_price = $origin_price;
			$product->sale_price = $sale_price;
			$product->hot = $hot=='on' ? 1 : 0;
			$product->discount_percent = $discount_percent;

			$product->save();
		} catch (Exception $e) {
			$status = 0;
			Log::error('[Error insertOrUpdate products]'.$e->getMessages());
		}
		return $status;
	}
}
