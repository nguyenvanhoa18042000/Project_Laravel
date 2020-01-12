<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RequestNewsCategory;
use App\Models\NewsCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsCategoryController extends Controller{

	public function index(){
		$news_categories = NewsCategory::orderBy('updated_at','DESC')->select('id','name','description','status')->paginate(7);
    	return view('backend.news_categories.index')->with([
    		'news_categories' => $news_categories
    	]);
    }

    public function showPosts($mews_category_id){
        // $products = Category::find($category_id)->products()->orderBy('updated_at','DESC')->paginate(4);
        // return view('backend.products.index')->with([
        //     'products' => $products
        // ]);
    }

    public function create(){
        $news_categories = NewsCategory::orderBy('updated_at','DESC')->select('id','name','parent_id','depth')->where('status','1')->get();
    	return view('backend.news_categories.create')->with([
            'news_categories' => $news_categories
        ]);
    }

    public function store(RequestNewsCategory $requestNewsCategory){
    	$this->insertOrUpdate($requestNewsCategory);
    	return redirect()->route('backend.news_category.index');
    }

    public function edit($id){
    	$news_category = NewsCategory::find($id);
        $news_categories = NewsCategory::orderBy('updated_at','DESC')->select('id','name','parent_id','depth')->where('status','1')->get();
    	return view('backend.news_categories.edit')->with([
    		'news_category' => $news_category,
            'news_categories' => $news_categories
    	]);
    }

    public function update(RequestNewsCategory $requestNewsCategory, $id){
    	$this->insertOrUpdate($requestNewsCategory,$id);
    	return redirect()->route('backend.news_category.index');
    }

    public function insertOrUpdate($requestNewsCategory, $id=''){
    	$status = 1;
    	try {
    		$name = $requestNewsCategory->get('name');
	    	$slug = str::slug($name);
	    	$description = $requestNewsCategory->get('description');
            $parent_id = $requestNewsCategory->get('parent_id');
	    	if ($id) {
	    		$news_category = NewsCategory::find($id);
	    	}else{
	    		$news_category = new NewsCategory();
	    	}
	    	$news_category->name = $name;
	    	$news_category->slug = $slug;
            $news_category->parent_id = $parent_id;
	    	$news_category->description = $description;
	    	$news_category->save();
    	} catch (Exception $e) {
    		$status = 0;
    		Log::error('[Error insertOrUpdate news categories]'.$e->getMessages());
    	}
    	return $status;
    }

    public function destroy($id){
    	$news_category = NewsCategory::find($id);
        $news_category->delete();
        return redirect()->back();
    }

    public function editStatus($id){
    	$news_category = NewsCategory::find($id);
    	if($news_category->status==1){
    		$news_category->status = 0;
    	}else{
    		$news_category->status = 1;
    	}
    	$news_category->save();
    	return redirect()->back();
    }
}
