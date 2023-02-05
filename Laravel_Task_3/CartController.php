<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    //
    function index()
  {

      $cartIds = Session::get('ids', []);
      $products = Product::findOrFail($cartIds);
      $quantity = array_count_values($cartIds);
        $subTotal = 0;
        $shipping = 0;
        $total = 0;
       
        foreach ($products as $product) 
        {
            $shipping += $quantity[$product['id']] * 5;
            $subTotal += $product->getPriceWithDiscount() * $quantity[$product['id']];
        }
        $total = $subTotal + $shipping;
        
    return view('cart', compact('products', 'quantity', 'shipping','subTotal','total'));
    }
        function incProduct(Request $request)
        {
        
       
            $cartIds = Session::get('ids', []);
            array_push($cartIds, $request->get('id'));
            Session::put('ids', $cartIds);
            return response()->json(count($cartIds));
        
    
            
            
        }
    function decProduct(Request $request)
    {
       
        $cartIds = Session::get('ids', []);
        $cartId = array_search($request->get('id'), $cartIds);
        array_splice($cartIds, $cartId, 1);
        
        Session::put('ids', $cartIds);
        return response()->json(count($cartIds));


    }

    function removeProduct(Request $request)
    {
        $newCartIds = [];
          $cartIds = Session::get('ids', []);
          foreach($cartIds as $cartId)
          {
            if($cartId !== $request->get('id'))
            {
                array_push($newCartIds, $cartId);
            }
          }
        
        
        Session::put('ids', $newCartIds);
        return response()->json(count($newCartIds));

    }
       

        
    
}
