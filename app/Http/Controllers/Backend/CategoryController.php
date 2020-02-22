<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RequestCategory;
use App\Models\Category;
use App\Models\Trademark;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function showProducts($category_id){
        $this->authorize('viewAny', Category::class);
        $products = Category::withTrashed()->findOrFail($category_id)->products()->orderBy('updated_at','DESC')->paginate(4);
        return view('backend.products.index')->with([
            'products' => $products
        ]);
    }

	public function index(){
        $this->authorize('viewAny', Category::class);
        // $categories = Cache::remember('categories', 100, function() {
        //     return Category::withTrashed()->orderBy('updated_at','DESC')->paginate(7);
        // });
		 $categories = Category::withTrashed()->orderBy('updated_at','DESC')->paginate(7);
    	return view('backend.categories.index')->with([
    		'categories' => $categories
    	]);
    }

    public function create(){
        $this->authorize('create', Category::class);
        $categories = Category::orderBy('updated_at','DESC')->select('id','name','parent_id','depth')->get();
        $trademarks = Trademark::all();
    	return view('backend.categories.create')->with([
            'categories' => $categories,
            'trademarks' => $trademarks,
        ]);
    }

    public function store(RequestCategory $requestCategory){
        $this->authorize('create', Category::class);
        $category = new Category();

        $parent_id = $requestCategory->get('parent_id');
        $category->name = $requestCategory->get('name');
        if($requestCategory->filled('slug')){
            $category->slug = $requestCategory->get('slug');
        }else{
            $category->slug = str::slug($requestCategory->get('name'));
        }
        $category->parent_id = $parent_id;
        $category->user_id = Auth::user()->id;
        $category->description = $requestCategory->get('description');
        if ($parent_id != NULL) {
            $category_of_parent = Category::select('id','depth')->findOrFail($parent_id);
            $category->depth = $category_of_parent->depth + 1;
        }
        $trademarks = $requestCategory->get('trademarks');

        $image = $requestCategory->file('image');
        $name_image = date('YmdHis')."_".$image->getClientOriginalName();
        Storage::disk('public')->putFileAs('images/category', $image , $name_image);
        $category->image = 'storage/images/category/'.$name_image;

        $save = $category->save();

        $sync_data = [];
        for($i = 0; $i < count($trademarks); $i++){
            $sync_data[$trademarks[$i]] = ['category_id' => $category->id,'trademark_id' => $trademarks[$i]];
        }
        $category->trademarks()->sync($sync_data);

    	if($save){
            Session::flash('message', 'Thêm mới thành công');
            Session::flash('alert-type', 'success');
        }else{
            Session::flash('message', 'Thêm mới thất bại');
            Session::flash('alert-type', 'error');
        }
        return redirect()->route('backend.category.index');
    }

    public function edit($id){
    	$category = Category::withTrashed()->findOrFail($id);

        $this->authorize('update', $category);
        $categories = Category::orderBy('updated_at','DESC')->select('id','name','parent_id','depth')->withTrashed()->get();

        $trademarks_edit = $category->trademarks;
        $trademarks = Trademark::all();

    	return view('backend.categories.edit')->with([
    		'category' => $category,
            'categories' => $categories,
            'trademarks' => $trademarks,
            'trademarks_edit' => $trademarks_edit
    	]);
    }

    public function update(RequestCategory $requestCategory, $id){
    	$category = Category::withTrashed()->findOrFail($id);

        $this->authorize('update', $category);
        $parent_id = $requestCategory->get('parent_id');
    	$category->name = $requestCategory->get('name');
        if($requestCategory->filled('slug')){
            $category->slug = $requestCategory->get('slug');
        }  	
        $category->parent_id = $parent_id;
        $category->user_id = Auth::user()->id;
    	$category->description = $requestCategory->get('description');
        if($parent_id != NULL){
            $category_of_parent = Category::select('id','depth')->findOrFail($parent_id);
            $category->depth = $category_of_parent->depth + 1;
        }else{
            $category->depth = 0;
        }
        $trademarks = $requestCategory->get('trademarks');

        if($requestCategory->hasFile('image')){
            File::delete($category->image);
            $image = $requestCategory->file('image');
            $name_image = date('YmdHis')."_".$image->getClientOriginalName();
            Storage::disk('public')->putFileAs('images/category',$image,$name_image);
            $category->image = 'storage/images/category/'.$name_image;
        }
        $update = $category->update();

        $sync_data = [];
        for($i = 0; $i < count($trademarks); $i++){
            $sync_data[$trademarks[$i]] = ['category_id' => $category->id,'trademark_id' => $trademarks[$i]];
        }
        $category->trademarks()->sync($sync_data);

        if($update){
            Session::flash('message', 'Chỉnh sửa thành công');
            Session::flash('alert-type', 'success');
        }else{
            Session::flash('message', 'Chỉnh sửa thất bại');
            Session::flash('alert-type', 'error');
        }
        return redirect()->route('backend.category.index');
    }

    public function destroy($id){
    	$category = Category::withTrashed()->findOrFail($id);
        $this->authorize('delete', $category);
        if($category->delete()){
            Session::flash('message', 'Đưa vào thùng rác thành công');
            Session::flash('alert-type', 'success');
        }else{
            Session::flash('message', 'Đưa vào thùng rác thất bại');
            Session::flash('alert-type', 'error');
        }
        return redirect()->back();
    }

    public function forceDelete($id){
        $category = Category::onlyTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $category);
        File::delete($category->image);
        $category->trademarks()->detach();
        if($category->forceDelete()){
            Session::flash('message', 'Xóa thành công');
            Session::flash('alert-type', 'success');
        }else{
            Session::flash('message', 'Xóa thất bại');
            Session::flash('alert-type', 'error');
        }
        return redirect()->back();
    }

    public function restore($id){
        $category = Category::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $category);
        if($category->restore()){
            Session::flash('message', 'Khôi phục thành công');
            Session::flash('alert-type', 'success');
        }else{
            Session::flash('message', 'Khôi phục thất bại');
            Session::flash('alert-type', 'error');
        }
        return redirect()->back();
    }
}
