<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    //
    function index($id=9)
    {
        $product = Product::findOrFail($id);
        $products = Product::all();
        return view('details')->with(['products'=>$products,'product'=>$product]);
    }
    
}
