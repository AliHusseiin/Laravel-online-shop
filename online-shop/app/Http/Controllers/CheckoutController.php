<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller 
{
// 
function index()
  {

      $cartIds = Session::get('ids', []);
      $products = product::findOrFail($cartIds);
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
        
    return view('checkout', compact('products', 'quantity', 'shipping','subTotal','total'));
    }

}