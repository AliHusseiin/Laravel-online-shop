<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class CategoryController extends Controller
{
    //
      function index()
    {
        $categories = Category::paginate(5);
        
        return view('admin.categories.categories')->with('categories',$categories);
    }
    
    function create() {
      
        return view('admin.categories.addCategory');
    }
    
    
    function store(Request $request)
    {
        $request->validate(Category::$ruels);

        $imageUrl = $request->file('image')->store('categories',['disk' => 'public']); 

        $category = new Category;
        $category->fill($request->post());
        $category['image'] = $imageUrl;

        $category->save();

      
        return redirect()->route('categories.index');
    }

    function edit($id)
    {
        $categories = Category::findOrFail($id);
        return view('admin.categories.edit', compact('categories'));

    }
    function update($id,Request $request)
    {
         $categories = Category::findOrFail($id);
          $request->validate(Category::$ruels
           
        );

        $categories->fill($request->post());
        $imageUrl = $request->file('image')->store('categories',['disk' => 'public']); 

        $categories['image'] = $imageUrl;
        $categories->save();
        return redirect()->route('categories.index');


    }

    function destroy($id)
    {
        
        $categories = Category::findOrFail($id);

        $categories->destroy($id);
        return redirect()->route('categories.index')->with('success','Item has been deleted Successfuly');

    }
}
