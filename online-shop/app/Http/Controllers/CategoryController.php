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

    function edit($id)
    {
        $categories = Category::findOrFail($id);
        return view('layouts.edit', compact('categories'));

    }
    function update($id,Request $request)
    {
         $categories = Category::findOrFail($id);
          $request->validate([
            'name'=> 'required|min:8',
            'image'=>'required'
        ]);

        $categories['name'] = $request['name'];
        $categories['image'] = $request['image'];
        $categories->save();
        return redirect()->route('layouts.categories');


    }

    function destroy($id)
    {
        
        $categories = Category::findOrFail($id);

        $categories->destroy($id);
        return redirect()->route('layouts.categories');

    }
}
