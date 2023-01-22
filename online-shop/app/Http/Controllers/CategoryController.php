<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class CategoryController extends Controller
{
    //
      function categoriesPage()
    {
        $categories = Category::paginate(5);
        
        return view('layouts.categories')->with('categories',$categories);
    }
    
    function addCategory() {
        return view('layouts.addCategory');
    }
    
    
    function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|min:8',
            'image'=>'required'
        ]);

        Category::create($request->post());

      
        return redirect()->route('layouts.categories');
    }
}
