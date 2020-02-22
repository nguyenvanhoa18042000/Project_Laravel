<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Http\Requests\RequestPost;
use Illuminate\Support\Facades\Auth;
use App\Models\Topic;
use App\Models\Contact;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

class ContactController extends Controller
{
    public function index(){
		$contacts = Contact::orderBy('updated_at','DESC')->paginate(4);
		$topics = Topic::all();
		return view('backend.contacts.index')->with([
			'contacts' => $contacts,
			'topics' =>$topics
		]);
	}

	public function destroy($id){
    	$contact = Contact::findOrFail($id);
    	$this->authorize('delete', $contact);
    	if($contact->delete()){
            Session::flash('message', 'Xóa thành công');
            Session::flash('alert-type', 'success');
        }
    	return redirect()->route('backend.contact.index');
    }
}
