<?php

namespace App\Http\Controllers;

use App\Models\Order_Details;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    //
    function index()
  {
        $products = Order_Details::orderDetailsProducts();
        $quantity= Order_Details::orderDetailsQuantity();
        $subTotal= Order_Details::orderDetailsSubTotal();
        $shipping= Order_Details::orderDetailsShipping();
        $total= Order_Details::orderDetailsTotal();
        
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
