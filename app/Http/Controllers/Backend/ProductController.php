<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RequestProduct;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use App\Models\Trademark;
use App\Models\ProductImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
	public function index(Request $request){
		if(Auth::user()->can('viewAny',Product::class)){
			$products = Product::with('category:id,name')->withTrashed();
			if($request->name) $products->where('name','like','%'.$request->name.'%');
			if($request->category_id) $products->where('category_id',$request->category_id);
			$products = $products->orderBy('updated_at','DESC')->paginate(4);
			$categories = Category::select('id','name')->withTrashed();
			return view('backend.products.index')->with([
				'products' => $products,
				'categories' =>$categories
			]);
		}else{abort(403);}
	}

	public function create(){
		if(Auth::user()->can('create',Product::class)){
	    	$categories = Category::select('id','name')->get();
	    	$trademarks = Trademark::select('id','name')->get();
			return view('backend.products.create')->with([
			'categories' => $categories,
			'trademarks' => $trademarks
			]);
		}else{abort(403);}
	}

	public function store(RequestProduct $requestProduct){
		if(Auth::user()->can('create',Product::class)){
			$product = new Product();
			$user = Auth::user();

			$product->name = $requestProduct->get('name');
			$product->description = $requestProduct->get('description');
			$product->content = $requestProduct->get('content');
			$product->amount = $requestProduct->get('amount');
			if($requestProduct->filled('slug')){
				$product->slug = $requestProduct->get('slug');
			}else{
				$product->slug = str::slug($product->name);
			}
			$product->category_id = $requestProduct->get('category_id');
			$product->trademark_id = $requestProduct->get('trademark_id');
			$product->user_id = Auth::user()->id;
			$product->origin_price = $requestProduct->get('origin_price');
			$product->sale_price = $requestProduct->get('sale_price');
			$product->hot = $requestProduct->get('hot') =='on' ? 1 : 0;
			$product->discount_percent = $requestProduct->get('discount_percent');

			$image = $requestProduct->file('image');
			$name_image = date('YmdHis')."_".$image->getClientOriginalName();
			Storage::disk('public')->putFileAs('images/product/main', $requestProduct->file('image'), $name_image);
			$product->image = 'storage/images/product/main/'.$name_image;

			$product->save();
			$product_id = $product->id;

			if ($requestProduct->hasFile('images')){
				$images = $requestProduct->file('images');
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
	    	return redirect()->route('backend.product.index');
	    }else{abort(403);}
	}

	public function edit($id){
		$product = Product::withTrashed()->findOrFail($id);

		if(Auth::user()->can('update',$product)){
			$categories = Category::select('id','name','deleted_at')->get();
	    	return view('backend.products.edit')->with([
	    		'product' => $product,
	    		'categories' => $categories
	    	]);
    	}else{abort(403);}
	}

	public function update(RequestProduct $requestProduct,$id){
		$product = Product::withTrashed()->findOrFail($id);

		if(Auth::user()->can('update',$product)){
			$product->name = $requestProduct->get('name');
			$product->description = $requestProduct->get('description');
			$product->content = $requestProduct->get('content');
			$product->amount = $requestProduct->get('amount');
			if($requestProduct->filled('slug')){
				$product->slug = $requestProduct->get('slug');
			}else{
				$product->slug = str::slug($product->name);
			}
			$product->category_id = $requestProduct->get('category_id');
			$product->trademark_id = $requestProduct->get('trademark_id');
			$product->origin_price = $requestProduct->get('origin_price');
			$product->sale_price = $requestProduct->get('sale_price');
			$product->hot = $requestProduct->get('hot') =='on' ? 1 : 0;
			$product->discount_percent = $requestProduct->get('discount_percent');

			if($requestProduct->hasFile('image')){
				$image = $requestProduct->file('image');
				$name_image = date('YmdHis')."_".$image->getClientOriginalName();
				Storage::disk('public')->putFileAs('images/product/main',$image,$name_image);
				$product->image = 'storage/images/product/main/'.$name_image;
			}

			$product->update();
			$product_id = $product->id;

			if ($requestProduct->hasFile('images')){
				$images = $requestProduct->file('images');
				foreach ($images as $image) {
					$product_image = new ProductImage();
					if (isset($image)) {
						$name_product_image = date('YmdHis')."_".$image->getClientOriginalName();
						$product_image->name = $name_product_image;
						$product_image->path = 'storage/images/product/detail/'.$name_product_image;

						$product_image->product_id = $product_id;

						Storage::disk('public')->putFileAs('images/product/detail', $image, $name_product_image);
						$product_image->update();
					}
				}
			}
	    	return redirect()->route('backend.product.index');
	    }else{abort(403);}
	}

	public function destroy($id){
		$product = Product::withTrashed()->findOrFail($id);

		if(Auth::user()->can('delete',$product)){
			$product_images = ProductImage::where('product_id',$product->id)->get();
			$product->delete();
			return redirect()->route('backend.product.index');
		}else{abort(403);}
	}

	public function forceDelete($id){
		$product = Product::onlyTrashed()->findOrFail($id);

		if(Auth::user()->can('forceDelete',$product)){
			File::delete($product->image);

			$product_images = ProductImage::where('product_id',$product->id)->get();
			foreach ($product_images as $product_image) {
				File::delete($product_image->path);
			}
	        $product->product_images()->forceDelete();
	        $product->ratings()->forceDelete();
	        $product->forceDelete();
			return redirect()->route('backend.product.index');
		}else{abort(403);}
	}

	public function restore($id){
		$product = Product::onlyTrashed()->findOrFail($id);

		if(Auth::user()->can('restore',$product)){
			$product->restore();
			return redirect()->route('backend.product.index');
		}else{abort(403);}
	}

	public function changeHot($id){
		$product = Product::withTrashed()->findOrFail($id);

		if(Auth::user()->can('changeHot',$product)){
	    	if($product->hot == 1){
	    		$product->hot = 0;
	    	}else{
	    		$product->hot = 1;
	    	}
	    	$product->update();
	    	return redirect()->back();
	    }else{abort(403);}
	}

	public function showImages($id){
		$product = Product::find($id);
		$images = $product->images;
		return view('backend.products.show_image')->with([
			'images' => $images,
			'product' => $product
		]);
	}
}
?>