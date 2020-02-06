<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RequestPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\NewsCategory;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class PostController extends Controller{
	public function index(){
		$posts = post::with('news_category:id,name')->withTrashed();
		$posts = $posts->orderBy('updated_at','DESC')->paginate(4);
		$news_categories = NewsCategory::all();
		return view('backend.posts.index')->with([
			'posts' => $posts,
			'news_categories' =>$news_categories
		]);
	}

    public function create(){
    	$news_categories = NewsCategory::all();
    	return view('backend.posts.create')->with([
    		'news_categories' => $news_categories,
    	]);
    }

    public function store(RequestPost $requestPost){
    	$post = new Post();
		$user = Auth::user();

		$post->title = $requestPost->get('title');
		$post->description = $requestPost->get('description');
		$post->content = $requestPost->get('content');
		if($requestPost->filled('slug')){
			$post->slug = $requestPost->get('slug');
		}else{
			$post->slug = str::slug($post->title);
		}
		$post->news_category_id = $requestPost->get('news_category_id');
		$post->user_id = Auth::user()->id;
		$post->hot = $requestPost->get('hot') =='on' ? 1 : 0;

		$image = $requestPost->file('image');
		$name_image = date('YmdHis')."_".$image->getClientOriginalName();
		Storage::disk('public')->putFileAs('images/post/', $requestPost->file('image'), $name_image);
		$post->image = 'storage/images/post/'.$name_image;

		$post->save();
    	return redirect()->route('backend.post.index');
    }

	public function edit($id){
		$post = Post::withTrashed()->findOrFail($id);
		$news_categories = NewsCategory::all();
		return view('backend.posts.edit')->with([
			'post' => $post,
			'news_categories' => $news_categories,
		]);
	}    

	public function update(RequestPost $requestPost,$id){
		$post = Post::withTrashed()->findOrFail($id);

		$post->title = $requestPost->get('title');
		$post->description = $requestPost->get('description');
		$post->content = $requestPost->get('content');
		if($requestPost->filled('slug')){
			$post->slug = $requestPost->get('slug');
		}else{
			$post->slug = str::slug($post->title);
		}
		$post->news_category_id = $requestPost->get('news_category_id');
		$post->hot = $requestPost->get('hot') =='on' ? 1 : 0;

		if($requestPost->hasFile('image')){
			$image = $requestPost->file('image');
			$name_image = date('YmdHis')."_".$image->getClientOriginalName();
			Storage::disk('public')->putFileAs('images/post/', $requestPost->file('image'), $name_image);
			$post->image = 'storage/images/post/'.$name_image;
		}
		$post->update();
    	return redirect()->route('backend.post.index');
	}

	public function destroy($id){
		$post = Post::findOrFail($id);
		$post->delete();
		return redirect()->route('backend.post.index');
	}

	public function forceDelete($id){
		$post = Post::onlyTrashed()->findOrFail($id);
		File::delete($post->image);
		$post->forceDelete();
		return redirect()->route('backend.post.index');
	}

	public function restore($id){
		$post = Post::onlyTrashed()->findOrFail($id);
		$post->restore();
		return redirect()->route('backend.post.index');
	}
}
