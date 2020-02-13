<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RequestProduct;
use App\Http\Requests\RequestProductImage;
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
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

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
	    	$categories = Category::select('id','name','parent_id')->get();
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

			$save = $product->save();
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
	    	if($save){
	    		Session::flash('message', 'Thêm mới thành công');
	    		Session::flash('alert-type', 'success');
			}else{
				Session::flash('message', 'Thêm mới thất bại');
	    		Session::flash('alert-type', 'error');
	    	}
	    	return redirect()->route('backend.product.index');
	    }else{abort(403);}
	}

	public function edit($id){
		$product = Product::withTrashed()->findOrFail($id);

		if(Auth::user()->can('update',$product)){
			if($product->category->deleted_at != NULL){
				$categories = Category::select('id','name','parent_id','deleted_at')->withTrashed()->get();
			}else{
				$categories = Category::select('id','name','parent_id')->get();
			}
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
				File::delete($product->image);
				$image = $requestProduct->file('image');
				$name_image = date('YmdHis')."_".$image->getClientOriginalName();
				Storage::disk('public')->putFileAs('images/product/main',$image,$name_image);
				$product->image = 'storage/images/product/main/'.$name_image;
			}

			$update = $product->update();
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
			if($update){
	    		Session::flash('message', 'Chỉnh sửa thành công');
	    		Session::flash('alert-type', 'success');
			}else{
				Session::flash('message', 'Chỉnh sửa thất bại');
	    		Session::flash('alert-type', 'error');
	    	}
	    	return redirect()->route('backend.product.index');
	    }else{abort(403);}
	}

	public function destroy($id){
		$product = Product::withTrashed()->findOrFail($id);

		if(Auth::user()->can('delete',$product)){
			if($product->delete()){
	    		Session::flash('message', 'Đưa vào thùng rác thành công');
	    		Session::flash('alert-type', 'success');
			}else{
				Session::flash('message', 'Đưa vào thùng rác thất bại');
	    		Session::flash('alert-type', 'error');
	    	}
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

			if($product->forceDelete()){
	    		Session::flash('message', 'Xóa thành công');
	    		Session::flash('alert-type', 'success');
			}else{
				Session::flash('message', 'Xóa thất bại');
	    		Session::flash('alert-type', 'error');
	    	}
	    	return redirect()->route('backend.product.index');
		}else{abort(403);}
	}

	public function restore($id){
		$product = Product::onlyTrashed()->findOrFail($id);

		if(Auth::user()->can('restore',$product)){
			if($product->restore()){
	    		Session::flash('message', 'Khôi phục thành công');
	    		Session::flash('alert-type', 'success');
			}else{
				Session::flash('message', 'Khôi phục thất bại');
	    		Session::flash('alert-type', 'error');
	    	}
	    	return redirect()->route('backend.product.index');
		}else{abort(403);}
	}

	public function changeHot($id){
		$product = Product::withTrashed()->findOrFail($id);

		if(Auth::user()->can('changeHot',$product)){
	    	$product->hot = !$product->hot;
	    	if($product->update()){
	    		Session::flash('message', 'Thay đổi nổi bật thành công');
	    		Session::flash('alert-type', 'success');
			}else{
				Session::flash('message', 'Thay đổi nổi bật thất bại');
	    		Session::flash('alert-type', 'error');
	    	}
	    	return redirect()->back();
	    }else{abort(403);}
	}

	public function getImageDescription($id){
		$this->authorize('viewAny',Product::class);
		$product = Product::withTrashed()->findOrFail($id);
		$product_images = $product->product_images()->paginate(5);
		return view('backend.product_images.index')->with([
			'product_images' => $product_images,
			'product' => $product,
		]);
	}

	public function addImageDescription($idProduct){
		$product = Product::withTrashed()->findOrFail($idProduct);
		$this->authorize('actionProductImageDescription',$product);
		return view('backend.product_images.create')->with(['idProduct' => $idProduct]);
	}

	public function storeImageDescription(RequestProductImage $requestProductImage){
		$product_image = new ProductImage();
		$idProduct = $requestProductImage->get('idProduct');
		$product = Product::withTrashed()->findOrFail($idProduct);
		$this->authorize('actionProductImageDescription',$product);

		if ($requestProductImage->hasFile('paths')){
			$paths = $requestProductImage->file('paths');
			foreach ($paths as $path) {
				$product_image = new ProductImage();
				if (isset($path)) {
					$name_product_image = date('YmdHis')."_".$path->getClientOriginalName();
					$product_image->name = $name_product_image;
					$product_image->path = 'storage/images/product/detail/'.$name_product_image;

					$product_image->product_id = $idProduct;

					Storage::disk('public')->putFileAs('images/product/detail', $path, $name_product_image);
					$product_image->save();
					if(!$product_image->save()){
						Session::flash('errorSave','error');
					}
				}
			}
		}

		if(!Session::has('errorSave')){
    		Session::flash('message', 'Thêm ảnh mô tả thành công');
    		Session::flash('alert-type', 'success');
		}else{
			Session::flash('message', 'Thêm ảnh mô tả thất bại');
    		Session::flash('alert-type', 'error');
    	}
    	return redirect()->route('backend.product.get.image.description',$idProduct);
	}

	public function forceDeleteImageDescription($idProductImage){
		$product_image = ProductImage::findOrFail($idProductImage);
		File::delete($product_image->path);

		if($product_image->delete()){
    		Session::flash('message', 'Xóa ảnh mô tả thành công');
    		Session::flash('alert-type', 'success');
		}else{
			Session::flash('message', 'Xóa ảnh mô tả thất bại');
    		Session::flash('alert-type', 'error');
    	}
		return redirect()->back();
	}
}
?>