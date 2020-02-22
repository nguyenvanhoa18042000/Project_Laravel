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
	public function index(Request $request){
		$this->authorize('viewAny',Post::class);
		$posts = Post::with('news_category:id,name')->withTrashed();
		if($request->title) $posts->where('title','like','%'.$request->title.'%');
		if($request->news_category_id) $posts->where('news_category_id',$request->news_category_id);
		$posts = $posts->orderBy('updated_at','DESC')->paginate(8);
		$news_categories = NewsCategory::all();
		return view('backend.posts.index')->with([
			'posts' => $posts,
			'news_categories' =>$news_categories
		]);
	}

    public function create(){
    	$this->authorize('create',Post::class);
    	$news_categories = NewsCategory::all();
    	return view('backend.posts.create')->with([
    		'news_categories' => $news_categories,
    	]);
    }

    public function store(RequestPost $requestPost){
    	$this->authorize('create',Post::class);
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
		Storage::disk('public')->putFileAs('images/post/thumbnail/', $requestPost->file('image'), $name_image);
		$post->image = 'storage/images/post/thumbnail/'.$name_image;

		if($requestPost->hasFile('background_img_title')){
			$background_img_title = $requestPost->file('background_img_title');
			$name_background_img_title = date('YmdHis')."_".$background_img_title->getClientOriginalName();
			Storage::disk('public')->putFileAs('images/post/background_img_title/', $requestPost->file('background_img_title'), $name_background_img_title);
			$post->background_img_title = 'storage/images/post/background_img_title/'.$name_background_img_title;
		}

		$post->save();
    	return redirect()->route('backend.post.index');
    }

	public function edit($id){
		$post = Post::withTrashed()->findOrFail($id);
		$this->authorize('update',$post);
		$news_categories = NewsCategory::all();
		return view('backend.posts.edit')->with([
			'post' => $post,
			'news_categories' => $news_categories,
		]);
	}    

	public function update(RequestPost $requestPost,$id){
		$post = Post::withTrashed()->findOrFail($id);
		$this->authorize('update',$post);
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
			File::delete($post->image);
			$image = $requestPost->file('image');
			$name_image = date('YmdHis')."_".$image->getClientOriginalName();
			Storage::disk('public')->putFileAs('images/post/thumbnail/', $requestPost->file('image'), $name_image);
			$post->image = 'storage/images/post/thumbnail/'.$name_image;
		}
		if($requestPost->hasFile('background_img_title')){
			File::delete($post->background_img_title);
			$background_img_title = $requestPost->file('background_img_title');
			$name_background_img_title = date('YmdHis')."_".$background_img_title->getClientOriginalName();
			Storage::disk('public')->putFileAs('images/post/background_img_title/', $requestPost->file('background_img_title'), $name_background_img_title);
			$post->background_img_title = 'storage/images/post/background_img_title/'.$name_background_img_title;
		}
		$post->update();
    	return redirect()->route('backend.post.index');
	}

	public function destroy($id){
		$post = Post::findOrFail($id);
		$this->authorize('delete',$post);
		$post->delete();
		return redirect()->route('backend.post.index');
	}

	public function forceDelete($id){
		$post = Post::onlyTrashed()->findOrFail($id);
		$this->authorize('forceDelete',$post);
		File::delete($post->image);
		File::delete($post->background_img_title);
		$post->forceDelete();
		return redirect()->route('backend.post.index');
	}

	public function restore($id){
		$post = Post::onlyTrashed()->findOrFail($id);
		$this->authorize('restore',$post);
		$post->restore();
		return redirect()->route('backend.post.index');
	}

	public function changeHot($id){
		$post = Post::withTrashed()->findOrFail($id);
		$this->authorize('changeHot',$post);
		if(Auth::user()->can('changeHot',$post)){
	    	$post->hot = !$post->hot;
	    	$post->update();
	    	return redirect()->back();
	    }else{abort(403);}
	}
}
