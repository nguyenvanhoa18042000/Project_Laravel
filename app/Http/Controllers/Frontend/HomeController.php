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
            return Category::with(['products:id,category_id,name,slug,image,sale_price,total_rating,total_number_star,discount_percent,amount','trademarks'])->withTrashed()->orderBy('created_at','ASC')->paginate(7);
        });
    	return view('frontend.home')->with([
            'categories' => $categories,
        ]);
    }

    public function detailProduct($slug){
        $categories = Cache::remember('categories', 60*60*24, function() {
            return Category::withTrashed()->orderBy('created_at','ASC')->paginate(7);
        });
        $product =  Product::with(['category:id,name','product_images'])->where('slug',$slug)->firstOrFail();
        $products = Product::where('category_id',$product->category_id)->where('slug','!=',$slug)->orderBy('amount_sold','DESC')->paginate(20);
        $ratings = Rating::where('product_id',$product->id)->orderBy('id','DESC')->paginate(2);

        $rating_level = array();
        $ratings_of_product =  $product->ratings;
        for ($i=1; $i <=5 ; $i++) { 
            $rating_level[$i] = $ratings_of_product->where('number_star',$i)->count();
        }
        
        return view('frontend.detail_product')->with([
            'categories' => $categories,
            'product' => $product,
            'products' => $products,
            'rating_level' => $rating_level,
            'ratings' => $ratings,
        ]);
    }

    public function detailCategory(Request $request,$slug,$trademark=null){
        $categories = Cache::remember('categories', 60*60*24, function() {
            return Category::withTrashed()->orderBy('created_at','ASC')->paginate(7);
        });
        $category = Category::where('slug',$slug)->firstOrFail();

        $trademarks = $category->trademarks;

        if($trademark != null){
            $trademark_search = Trademark::withTrashed()->where('slug',$trademark)->firstOrFail();
            $products = Product::select('id','name','slug','image','sale_price','total_rating','total_number_star','discount_percent','amount')->where('category_id',$category->id)->where('trademark_id',$trademark_search->id);
        }else{
            $products = Product::select('id','name','slug','image','sale_price','total_rating','total_number_star','discount_percent','amount')->where('category_id',$category->id);
        }

        if($request->p){
            $price = $request->p;
            switch ($price) {
                case 'duoi-2-trieu':
                    $products = $products->where('sale_price','<',2000000);
                    break; 
                case 'tu-2-4-trieu':
                    $products = $products->whereBetWeen('sale_price',[2000000,4000000]); 
                    break; 
                case 'tu-4-7-trieu':
                    $products = $products->whereBetWeen('sale_price',[4000000,7000000]); 
                    break; 
                case 'tu-7-13-trieu':
                    $products = $products->whereBetWeen('sale_price',[7000000,13000000]); 
                    break; 
                case 'tren-13-trieu':
                    $products = $products->where('sale_price','>',13000000); 
                    break;              
                default:
                break;
            }
        }else{
            $products = $products;
        }

        if($request->orderby != null){
            $orderby = $request->orderby;
            switch ($orderby) {
                case 'moi-nhat':
                    $products = $products->orderBy('id','DESC');
                    break;
                case 'gia-cao-den-thap':
                    $products = $products->orderBy('sale_price','DESC');
                    break; 
                case 'gia-thap-den-cao':
                    $products = $products->orderBy('sale_price','ASC');
                    break;             
                default:
                    $products = $products->orderBy('id','DESC');
                break;
            }
        }else{
            $products = $products->orderBy('id','DESC');
        }

        $products = $products->paginate(25);

        if($trademark != null){
            return view('frontend.detail_category')->with([
                'categories' => $categories,
                'category' => $category,
                'products' => $products,
                'trademark_search' => $trademark_search,
                'trademarks' => $trademarks,
            ]);
        }else{
            return view('frontend.detail_category')->with([
                'categories' => $categories,
                'category' => $category,
                'products' => $products,
                'trademarks' => $trademarks,
            ]);
        }
    }

    public function news(){
        $categories = Cache::remember('categories', 60*60*24, function() {
            return Category::withTrashed()->orderBy('created_at','ASC')->paginate(7);
        });
        $posts = Post::select('id','title','image','slug','deleted_at','created_at','news_category_id')->orderBy('id','DESC')->paginate(5);
        $popular_posts = Post::select('id','title','image','slug','deleted_at','view_count')->orderBy('view_count','DESC')->paginate(5);
        $news_categories = NewsCategory::select('id','name','slug','created_at','deleted_at')->orderBy('id','ASC')->get();
        return view('frontend.list_post')->with([
            'categories' => $categories,
            'posts' => $posts,
            'news_categories' => $news_categories,
            'popular_posts' => $popular_posts
        ]);
    }

    public function detailNewsCategory($slug){
        $categories = Cache::remember('categories', 60*60*24, function() {
            return Category::withTrashed()->orderBy('created_at','ASC')->paginate(7);
        });
        $news_cate = NewsCategory::where('slug',$slug)->firstOrFail();
        $news_categories = NewsCategory::select('id','name','slug','created_at','deleted_at')->orderBy('id','ASC')->get();
        $popular_posts = Post::select('id','title','image','slug','deleted_at','view_count')->orderBy('view_count','DESC')->paginate(5);
        $posts = Post::orderBy('id','DESC')->where('news_category_id',$news_cate->id)->paginate(8);
        $new_posts = Post::select('id','title','image','slug','deleted_at')->orderBy('id','DESC')->where('news_category_id','!=',$news_cate->id)->paginate(5);
        return view('frontend.list_post')->with([
            'posts' => $posts,
            'news_cate' => $news_cate,
            'news_categories' => $news_categories,
            'new_posts' => $new_posts,
            'categories' => $categories,
            'popular_posts' => $popular_posts,
        ]);
    }

    public function detailPost($slug){
        $categories = Cache::remember('categories', 60*60*24, function() {
            return Category::withTrashed()->orderBy('created_at','ASC')->paginate(7);
        });
        $post = Post::with(['user:id,name,avatar','news_category:id,name,slug'])->withTrashed()->where('slug',$slug)->firstOrFail();
        $post->view_count +=1;
        $post->update();
        $news_categories = NewsCategory::select('id','name','slug','created_at','deleted_at')->orderBy('id','ASC')->withTrashed()->get();
        $posts = Post::select('id','title','news_category_id','description','slug','image','deleted_at','created_at')->where('news_category_id',$post->news_category_id)->get();
        return view('frontend.detail_post')->with([
            'post' => $post,
            'posts' => $posts,
            'news_categories' => $news_categories,
            'categories' => $categories,
        ]);
    }    

    public function createContact(){
        $categories = Cache::remember('categories', 60*60*24, function() {
            return Category::withTrashed()->orderBy('created_at','ASC')->paginate(7);
        });
        $topics = Topic::all();
        return view('frontend.contact')->with([
            'topics' => $topics,
            'categories' => $categories,
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

            
        
           
        
            
        
            
        
            


        
        
        
        
        
        


            
        


        
