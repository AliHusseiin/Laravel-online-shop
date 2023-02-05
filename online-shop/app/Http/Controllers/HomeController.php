<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    function index()
    {
        
        $categories = Category::all();
        $products = Product::all();
        
        return view('welcome')->with(['categories'=>$categories,'products'=>$products]);
    }
    function shop(Request $request)
    {
        
        $query = Product::query();

        $inputs = $request->all();

        if (isset($inputs['keyword'])) {
            $query = $query->where('name', 'like', "%" . $inputs['keyword'] . "%");
        }
        if (isset($inputs['color'])) {
            if (!in_array('-1', $inputs['color'])) {

                $query = $query->whereIn('color_id', $inputs['color']);
            }
        }
        if (isset($inputs['size'])) {
            if (!in_array('-1', $inputs['size'])) {
                $query = $query->whereIn('size_id', $inputs['size']);
            }
        }

        if ($request->has('category_id')) {
            $query = $query->where('category_id', $request->get('category_id'));
        }

        if ($request->has('price')) {
            if (!in_array('-1', $inputs['price'])) {
                $query = $query->where(function ($q) use ($inputs) {
                    foreach ($inputs['price'] as $price) {
                        $q = $q->orWhereBetween('price', [$price, $price + 100]);
                    }
                });
            }
        }

        /*SELECT * FROM Products WHERE con1 and con2 and (
        price between 0 and 100 or
        price between 100 and 200
        )
        */

        $query = $query->orderByDesc('created_at');
        $products = $query->paginate(3);


        return view('shop')->with([
            'products' => $products,
            'colors' => Color::all(),
            'sizes' => Size::all()
        ]);
    }
      function add_product(Request $request)
    {
        if ($request->has('id')) {
            $cartIds = Session::get('ids', []);
            array_push($cartIds, $request->get('id'));
            Session::put('ids', $cartIds);
            return response()->json(count($cartIds));
        }
        return abort(404);
    }
      function addToWishList(Request $request)
    {
        if ($request->has('id')) {
            $wishList = Session::get('wishList', []);
            array_push($wishList, $request->get('wishList'));
            Session::put('wishList', $wishList);
            return response()->json(count($wishList));
        }
        return abort(404);
    }
    
}

