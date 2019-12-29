<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RequestProduct;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductController extends Controller
{
	public function index(){
		$products = Product::orderBy('updated_at','DESC')->paginate(4);
		return view('backend.products.index')->with([
			'products' => $products
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
    	return view('backend.products.edit')->with([
    		'product' => $product
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
