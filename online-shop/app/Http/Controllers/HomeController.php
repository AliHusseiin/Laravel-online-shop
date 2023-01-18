<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index()
    {
        $categories = Category::all();
        
        return view('welcome')->with('categories',$categories);
    }
    function shop()
    {
        return view('shop');
    }
}
