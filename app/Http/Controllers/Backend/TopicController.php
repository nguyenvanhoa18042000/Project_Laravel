<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\requestTopic;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

class TopicController extends Controller
{
    public function index(){
        $this->authorize('viewAny', Topic::class);
		$topics = Topic::orderBy('updated_at','DESC')->get();
    	return view('backend.topics.index')->with([
    		'topics' => $topics
    	]);
    }

	public function create(){
	    $this->authorize('create', Topic::class);
	    $topics = Topic::orderBy('updated_at','DESC')->select('id','name','parent_id','depth')->get();
		return view('backend.topics.create')->with([
	        'topics' => $topics,
	    ]);
    }

    public function store(requestTopic $requestTopic){
        $this->authorize('create', Topic::class);
        $topic = new topic();
        $parent_id = $requestTopic->get('parent_id');
        $topic->name = $requestTopic->get('name');
        $topic->parent_id = $parent_id;
        $topic->user_id = Auth::user()->id;
        if ($parent_id != NULL) {
            $topic_of_parent = topic::select('id','depth')->findOrFail($parent_id);
            $topic->depth = $topic_of_parent->depth + 1;
        }
        $save = $topic->save();

    	if($save){
            Session::flash('message', 'Thêm mới thành công');
            Session::flash('alert-type', 'success');
        }else{
            Session::flash('message', 'Thêm mới thất bại');
            Session::flash('alert-type', 'error');
        }
        return redirect()->route('backend.topic.index');
    }

    public function edit($id){
    	$topic = Topic::findOrFail($id);

        $this->authorize('update', $topic);
        $topics = Topic::orderBy('updated_at','DESC')->select('id','name','parent_id','depth')->get();

    	return view('backend.topics.edit')->with([
    		'topic' => $topic,
    		'topics' => $topics,
    	]);
    }

    public function update(RequestTopic $requestTopic,$id){
    	$topic = Topic::findOrFail($id);

        $this->authorize('update', $topic);
        $parent_id = $requestTopic->get('parent_id');
    	$topic->name = $requestTopic->get('name');
        $topic->parent_id = $parent_id;
        $topic->user_id = Auth::user()->id;
        if($parent_id != NULL){
            $topic_of_parent = Topic::select('id','depth')->findOrFail($parent_id);
            $topic->depth = $topic_of_parent->depth + 1;
        }else{
            $topic->depth = 0;
        }

        $update = $topic->update();
        if($update){
            Session::flash('message', 'Chỉnh sửa thành công');
            Session::flash('alert-type', 'success');
        }else{
            Session::flash('message', 'Chỉnh sửa thất bại');
            Session::flash('alert-type', 'error');
        }
        return redirect()->route('backend.topic.index');
    }

    public function destroy($id){
    	$topic = Topic::findOrFail($id);
    	$this->authorize('delete', $topic);
    	if($topic->delete()){
            Session::flash('message', 'Xóa thành công');
            Session::flash('alert-type', 'success');
        }else{
            Session::flash('message', 'Xóa thất bại');
            Session::flash('alert-type', 'error');
        }
    	return redirect()->route('backend.topic.index');
    }

}
