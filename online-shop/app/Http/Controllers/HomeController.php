<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index()
    {
        $categories = Category::all();
        $products = Product::all();
        
        return view('welcome')->with(['categories'=>$categories,'products'=>$products]);
    }
    function shop()
    {
        return view('shop');
    }
}
