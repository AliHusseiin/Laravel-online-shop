<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\product;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $products = Product::paginate(5);
        
        return view('admin.products.products')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.products.addProducts', compact('categories','colors','sizes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         $request->validate(Product::$ruels);

        $imageUrl = $request->file('image')->store('products',['disk' => 'public']); 

        $products = new Product;
        $products->fill($request->post());
        $products['image'] = $imageUrl;
         $products['is_recent'] = isset($request['is_recent']) ? 1 : 0;
        $products['is_featured'] = isset($request['is_featured']) ? 1 : 0;

        $products->save();

      
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $colors = Color::all();
        $sizes = Size::all();
        $categories = Category::all();
         $products = Product::findOrFail($id);
        return view('admin.products.edit', compact('products','categories','sizes','colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
          $products = Product::findOrFail($id);
          $request->validate(
            Product::$ruels
        );

        $products->fill($request->post());
        $imageUrl = $request->file('image')->store('products',['disk' => 'public']); 
        
        $products['image'] = $imageUrl;
        $products['is_recent'] = isset($request['is_recent']) ? 1 : 0;
        $products['is_featured'] = isset($request['is_featured']) ? 1 : 0;
        $products->save();
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
         $products = Product::findOrFail($id);

        $products->destroy($id);
        return redirect()->route('products.index')->with('success','Item has been deleted Successfuly');
    }
}
