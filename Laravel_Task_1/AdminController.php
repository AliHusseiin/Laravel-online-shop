<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    function admin()
    {
        return view('layouts.admin');
    }
      function categoriesPage()
    {
        $categories = Category::all();
        
        return view('layouts.categories')->with('categories',$categories);
    }

}