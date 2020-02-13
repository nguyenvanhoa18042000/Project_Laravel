<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RequestNewsCategory;
use App\Models\NewsCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class NewsCategoryController extends Controller{

	public function index(){
		$news_categories = NewsCategory::withTrashed()->orderBy('updated_at','DESC')->select('id','name','slug','parent_id','description','deleted_at')->paginate(7);
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
        $news_categories = NewsCategory::orderBy('updated_at','DESC')->select('id','name','parent_id','depth')->get();
    	return view('backend.news_categories.create')->with([
            'news_categories' => $news_categories
        ]);
    }

    public function store(RequestNewsCategory $requestNewsCategory){
        $news_category = new NewsCategory();

        $parent_id = $requestNewsCategory->get('parent_id');
    	$news_category->name = $requestNewsCategory->get('name');
        $news_category->slug = str::slug($requestNewsCategory->get('name'));
        $news_category->description = $requestNewsCategory->get('description');
        $news_category->parent_id = $parent_id;
        if ($parent_id != NULL) {
            $news_category_of_parent = NewsCategory::select('id','depth')->findOrFail($parent_id);
            $news_category->depth = $news_category_of_parent->depth + 1;
        }
        $news_category->save();
    	return redirect()->route('backend.news_category.index');
    }

    public function edit($id){
    	$news_category = NewsCategory::withTrashed()->find($id);      
        $news_categories = NewsCategory::orderBy('updated_at','DESC')->select('id','name','parent_id','depth')->get();
    	return view('backend.news_categories.edit')->with([
    		'news_category' => $news_category,
            'news_categories' => $news_categories
    	]);
    }

    public function update(RequestNewsCategory $requestNewsCategory, $id){
        $news_category = NewsCategory::withTrashed()->findOrFail($id);

        $parent_id = $requestNewsCategory->get('parent_id');
    	$news_category->name = $requestNewsCategory->get('name');
        $news_category->slug = str::slug($requestNewsCategory->get('name'));
        $news_category->description = $requestNewsCategory->get('description');
        $news_category->parent_id = $parent_id;
        if($parent_id != NULL){
            $news_category_of_parent = NewsCategory::select('id','depth')->findOrFail($parent_id);
            $news_category->depth = $news_category_of_parent->depth + 1;
        }else{
            $news_category->depth = 0;
        }
        $news_category->update();
    	return redirect()->route('backend.news_category.index');
    }

    public function destroy($id){
    	$news_category = NewsCategory::find($id);
        $news_category->delete();
        return redirect()->back();
    }

    public function forceDelete($id){
        $news_category = NewsCategory::onlyTrashed()->findOrFail($id);
        $news_category->forceDelete();
        return redirect()->back();
    }

    public function restore($id){
        $news_category = NewsCategory::onlyTrashed()->findOrFail($id);
        $news_category->restore();
        return redirect()->back();
    }







}
