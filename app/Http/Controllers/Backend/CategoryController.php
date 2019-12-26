<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RequestCategory;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
	public function index(){
		$categories = Category::select('id','name','description_seo','status')->get();
    	return view('backend.categories.index')->with([
    		'categories' => $categories
    	]);
    }

    public function create(){
    	return view('backend.categories.create');
    }

    public function store(RequestCategory $requestCategory){
    	$this->insertOrUpdate($requestCategory);
    	return redirect()->back();
    }

    public function edit($id){
    	$category = Category::find($id);
    	return view('backend.categories.edit')->with([
    		'category' => $category
    	]);
    }

    public function update(RequestCategory $requestCategory, $id){
    	$this->insertOrUpdate($requestCategory,$id);
    	return redirect()->back();
    }

    public function insertOrUpdate($requestCategory, $id=''){
    	$status = 1;
    	try {
    		$name = $requestCategory->get('name');
	    	$slug = str::slug($name);
	    	$title_seo = $requestCategory->get('title_seo');
	    	$description_seo = $requestCategory->get('description_seo');
	    	if ($id) {
	    		$category = Category::find($id);
	    	}else{
	    		$category = new Category();
	    	}
	    	$category->name = $name;
	    	$category->slug = $slug;
	    	$category->title_seo = $title_seo ? $title_seo : $name;
	    	$category->description_seo = $description_seo;
	    	$category->updated_at = null;
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
