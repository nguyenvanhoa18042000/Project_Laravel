<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RequestCategory;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function showProducts($category_id){
        $products = Category::find($category_id)->products()->orderBy('updated_at','DESC')->paginate(4);
        return view('backend.products.index')->with([
            'products' => $products
        ]);
    }

	public function index(){
		$categories = Category::orderBy('updated_at','DESC')->select('id','name','description','status')->paginate(7);
    	return view('backend.categories.index')->with([
    		'categories' => $categories
    	]);
    }

    public function create(){
        $categories = Category::orderBy('updated_at','DESC')->select('id','name','parent_id','depth')->where('status','1')->get();
    	return view('backend.categories.create')->with([
            'categories' => $categories
        ]);
    }

    public function store(RequestCategory $requestCategory){
    	$this->insertOrUpdate($requestCategory);
    	return redirect()->route('backend.category.index');
    }

    public function edit($id){
    	$category = Category::find($id);
        $categories = Category::orderBy('updated_at','DESC')->select('id','name','parent_id','depth')->where('status','1')->get();
    	return view('backend.categories.edit')->with([
    		'category' => $category,
            'categories' => $categories
    	]);
    }

    public function update(RequestCategory $requestCategory, $id){
    	$this->insertOrUpdate($requestCategory,$id);
    	return redirect()->route('backend.category.index');
    }

    public function insertOrUpdate($requestCategory, $id=''){
    	$status = 1;
    	try {
    		$name = $requestCategory->get('name');
	    	$slug = str::slug($name);
	    	$description = $requestCategory->get('description');
            $parent_id = $requestCategory->get('parent_id');
	    	if ($id) {
	    		$category = Category::find($id);
	    	}else{
	    		$category = new Category();
	    	}
	    	$category->name = $name;
	    	$category->slug = $slug;
            $category->parent_id = $parent_id;
	    	$category->description = $description;
	    	$category->save();
    	} catch (Exception $e) {
    		$status = 0;
    		Log::error('[Error insertOrUpdate categories]'.$e->getMessages());
    	}
    	return $status;
    }
    public function destroy($id){
    	$category = Category::find($id);
        $category->delete();
        return redirect()->back();
    }

    public function editStatus($id){
    	$category = Category::find($id);
    	if($category->status==1){
    		$category->status = 0;
    	}else{
    		$category->status = 1;
    	}
    	$category->save();
    	return redirect()->back();
    }
}
