<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RequestProduct;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(){
		$products = Product::all();
    	return view('backend.products.index')->with([
    		'products' => $products
    	]);
    }

    public function create(){
    	return view('backend.products.create');
    }
}
