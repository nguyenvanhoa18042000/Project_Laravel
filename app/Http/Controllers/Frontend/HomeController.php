<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RequestContact;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Trademark;
use App\Models\Post;
use App\Models\NewsCategory;
use App\Models\Topic;
use App\Models\Contact;
use Helper;

class HomeController extends Controller
{
    public function index(){
        $categories = Cache::remember('categories', 60*60*24, function() {
            return Category::withTrashed()->orderBy('created_at','ASC')->paginate(7);
        });
    	return view('frontend.home')->with([
            'categories' => $categories,
        ]);
    }

    public function detailProduct($id){
        $product =  Product::with(['category:id,name','product_images'])->findOrFail($id);
        $products = Product::where('category_id',$product->category_id)->orderBy('id','DESC')->paginate(15);
        $ratings = Rating::where('product_id',$id)->orderBy('id','DESC')->paginate(2);

        $rating_level = array();
        $ratings_of_product =  $product->ratings;
        for ($i=1; $i <=5 ; $i++) { 
            $rating_level[$i] = $ratings_of_product->where('number_star',$i)->count();
        }
        
        return view('frontend.detail_product')->with([
            'product' => $product,
            'products' => $products,
            'rating_level' => $rating_level,
            'ratings' => $ratings,
        ]);
    }

    public function detailCategory($id){
        $category = Category::findOrFail($id);
        $trademarks = $category->trademarks;

        $products = Product::select('id','name','slug','image','sale_price','total_rating','total_number_star')->where('category_id',$id)->get();
        return view('frontend.detail_category')->with([
            'category' => $category,
            'products' => $products,
            'trademarks' => $trademarks,
        ]);
    }


    public function detailCategoryByTrademark($idCategory,$idTrademark){
        $category = Category::findOrFail($idCategory);
        $trademark_search = Trademark::withTrashed()->findOrFail($idTrademark);
        $trademarks = $category->trademarks;

        $products = Product::select('id','name','slug','image','sale_price','total_rating','total_number_star','trademark_id')->where('category_id',$idCategory)->where('trademark_id',$idTrademark)->get();
        return view('frontend.detail_category')->with([
            'trademark_search' => $trademark_search,
            'category' => $category,
            'products' => $products,
            'trademarks' => $trademarks,
        ]);
    }

    public function detailCategoryByPrice($idCategory,$minPrice,$maxPrice){
        $category = Category::findOrFail($idCategory);
        $trademarks = $category->trademarks;

        $products = Product::select('id','name','slug','image','sale_price','total_rating','total_number_star','sale_price')->where('category_id',$idCategory)->where('sale_price','>',$minPrice)->where('sale_price','<',$maxPrice)->get();
        return view('frontend.detail_category')->with([
            'category' => $category,
            'products' => $products,
            'trademarks' => $trademarks,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice
        ]);
    }

    public function detailCategoryByTrademarkAndPrice($idCategory,$idTrademark,$minPrice,$maxPrice){
        $category = Category::findOrFail($idCategory);
        $trademark_search = Trademark::withTrashed()->findOrFail($idTrademark);
        $trademarks = $category->trademarks;

        $products = Product::select('id','name','slug','image','sale_price','total_rating','total_number_star','sale_price')->where('category_id',$idCategory)->where('sale_price','>',$minPrice)->where('sale_price','<',$maxPrice)->where('trademark_id',$idTrademark)->get();
        return view('frontend.detail_category')->with([
            'category' => $category,
            'products' => $products,
            'trademark_search' => $trademark_search,
            'trademarks' => $trademarks,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice
        ]);
    }

    //Post
    public function news(){
        $posts = Post::select('id','title','image','slug','deleted_at','created_at','news_category_id')->orderBy('id','DESC')->paginate(5);
        $news_categories = NewsCategory::select('id','name','slug','created_at','deleted_at')->orderBy('id','ASC')->get();
        return view('frontend.list_post')->with([
            'posts' => $posts,
            'news_categories' => $news_categories
        ]);
    }

    public function detailNewsCategory($slug){
        $news_cate = NewsCategory::where('slug',$slug)->firstOrFail();
        $news_categories = NewsCategory::select('id','name','slug','created_at','deleted_at')->orderBy('id','ASC')->get();
        $posts = Post::orderBy('id','DESC')->where('news_category_id',$news_cate->id)->paginate(8);
        $new_posts = Post::select('id','title','image','slug','deleted_at')->orderBy('id','DESC')->where('news_category_id','!=',$news_cate->id)->take(5)->get();
        return view('frontend.list_post')->with([
            'posts' => $posts,
            'news_cate' => $news_cate,
            'news_categories' => $news_categories,
            'new_posts' => $new_posts
        ]);
    }

    public function detailPost($slug){
        $post = Post::with(['user:id,name,avatar','news_category:id,name,slug'])->withTrashed()->where('slug',$slug)->firstOrFail();
        $news_categories = NewsCategory::select('id','name','slug','created_at','deleted_at')->orderBy('id','ASC')->withTrashed()->get();
        $posts = Post::select('id','title','news_category_id','description','slug','image','deleted_at','created_at')->where('news_category_id',$post->news_category_id)->get();
        return view('frontend.detail_post')->with([
            'post' => $post,
            'posts' => $posts,
            'news_categories' => $news_categories
        ]);
    }    

    public function createContact(){
        $topics = Topic::all();
        return view('frontend.contact')->with([
            'topics' => $topics
        ]);
    }

    public function storeContact(RequestContact $requestContact){      
        $contact = new Contact();
        $contact->topic_id = $requestContact->get('topic_id');
        $contact->title = $requestContact->get('title');
        $contact->content = $requestContact->get('content');
        $contact->name = $requestContact->get('name');
        $contact->email = $requestContact->get('email');
        $contact->phone = $requestContact->get('phone');

        $save = $contact->save();
        if($save){
            return redirect()->back()->with('send_contact_success','Bạn đã gửi liên hệ thành công');
        }    
    }
}

            
        
           
        
            
        
            
        
            


        
        
        
        
        
        


            
        


        
