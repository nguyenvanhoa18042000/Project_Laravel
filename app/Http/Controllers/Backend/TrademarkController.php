<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RequestTrademark;
use App\Models\Trademark;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class TrademarkController extends Controller{

	public function index(){
        $this->authorize('viewAny', Trademark::class);
		$trademarks = Trademark::withTrashed()->orderBy('updated_at','DESC')->select('id','name','image','deleted_at')->paginate(7);
    	return view('backend.trademarks.index')->with([
    		'trademarks' => $trademarks
    	]);
    }

    public function create(){
        $this->authorize('create', Trademark::class);
    	return view('backend.trademarks.create');
    }

    public function store(RequestTrademark $requestTrademark){
        $this->authorize('create', Trademark::class);
    	$trademark = new Trademark();

        $trademark->name = $requestTrademark->get('name');
        $trademark->slug = str::slug($requestTrademark->get('name'));

        $image = $requestTrademark->file('image');
		$name_image = date('YmdHis')."_".$image->getClientOriginalName();
		Storage::disk('public')->putFileAs('images/trademark/', $image , $name_image);
		$trademark->image = 'storage/images/trademark/'.$name_image;

        if($trademark->save()){
                Session::flash('message', 'Thêm mới thành công');
                Session::flash('alert-type', 'success');
            }else{
                Session::flash('message', 'Thêm mới thất bại');
                Session::flash('alert-type', 'error');
            }
    	return redirect()->route('backend.trademark.index');
    }

    public function edit($id){
        $trademark = Trademark::withTrashed()->findOrFail($id);
        $this->authorize('update',Trademark::class);
        return view('backend.trademarks.edit')->with([
            'trademark' => $trademark,
        ]);
    }

    public function update(RequestTrademark $requestTrademark,$id){
        $trademark = Trademark::withTrashed()->findOrFail($id);

        $this->authorize('update',Trademark::class);
        $trademark->name = $requestTrademark->get('name');
        $trademark->slug = str::slug($requestTrademark->get('name'));
        if ($requestTrademark->hasFile('image')) {
            File::delete($trademark->image);
            $image = $requestTrademark->file('image');
            $name_image = date('YmdHis')."_".$image->getClientOriginalName();
            Storage::disk('public')->putFileAs('images/trademark/', $image , $name_image);
            $trademark->image = 'storage/images/trademark/'.$name_image;
        }
        $trademark->update();
        return redirect()->route('backend.trademark.index');
    }

    public function destroy($id){
        $trademark = Trademark::findOrFail($id);
        $this->authorize('delete', Trademark::class);
        $trademark->delete();
        return redirect()->route('backend.trademark.index');
    }

    public function forceDelete($id){
        $trademark = Trademark::onlyTrashed()->findOrFail($id);
        $this->authorize('forceDelete', Trademark::class);
        $trademark->categories()->detach();
        $trademark->forceDelete();
        File::delete($trademark->image);
        return redirect()->route('backend.trademark.index');
    }

    public function restore($id){
        $trademark = Trademark::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', Trademark::class);
        $trademark->restore();
        return redirect()->route('backend.trademark.index');
    }

    public function getTrademarks($idCategory){
    	$category = Category::withTrashed()->findOrFail($idCategory);
    	$trademarks = $category->trademarks;

    	foreach ($trademarks as $trademark) {
    		echo "<option value='".$trademark->id."'>".$trademark->name."</option>";
    	}
    }

}
