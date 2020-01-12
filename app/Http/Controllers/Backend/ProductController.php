<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RequestProduct;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
    	return redirect()->route('backend.product.index');
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
    	return redirect()->route('backend.product.index');
	}

	public function destroy($id){
		$product = Product::findOrFail($id);
		Storage::disk('public')->delete('images/product/main/'.$product->image);
		$product_images = ProductImage::where('product_id',$product->id)->get();
		$id_product_images = array();
		foreach ($product_images as $product_image) {
			Storage::disk('public')->delete('images/product/detail/'.$product_image->name);
			$id_product_images[] = $product_image->id;
		}
		$product->delete();
		ProductImage::destroy($id_product_images);
		return redirect()->route('backend.product.index');
	}

	public function editStatus($id){
    	$product = Product::find($id);
    	if($product->status==1){
    		$product->status = 0;
    	}else{
    		$product->status = 1;
    	}
    	$product->save();
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
			$amount = $requestProduct->get('amount');
			$image = $requestProduct->file('image');
			$name_image = date('YmdHis')."_".$image->getClientOriginalName();
			Storage::disk('public')->putFileAs('images/product/main', $requestProduct->file('image'), $name_image);
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
			$product->amount = $amount;
			$product->image = $name_image;
			$product->category_id = $category_id;
			$product->user_id = Auth::user()->id;
			$product->origin_price = $origin_price;
			$product->sale_price = $sale_price;
			$product->hot = $hot=='on' ? 1 : 0;
			$product->discount_percent = $discount_percent;

			$product->save();
			$product_id = $product->id;

			$images = $requestProduct->file('images');
			if ($requestProduct->hasFile('images')){
				foreach ($images as $image) {
					$product_image = new ProductImage();
					if (isset($image)) {
						$name_product_image = date('YmdHis')."_".$image->getClientOriginalName();
						$product_image->name = $name_product_image;
						$product_image->path = 'storage/images/product/detail/'.$name_product_image;

						$product_image->product_id = $product_id;

						Storage::disk('public')->putFileAs('images/product/detail', $image, $name_product_image);
						$product_image->save();
					}
				}
			}
		} catch (Exception $e) {
			$status = 0;
			Log::error('[Error insertOrUpdate products]'.$e->getMessages());
		}
		return $status;
	}
}
