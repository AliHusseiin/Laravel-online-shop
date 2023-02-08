<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_Details;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller 
{
// 
function index()
  {

       $products = Order_Details::orderDetailsProducts();
        $quantity= Order_Details::orderDetailsQuantity();
        $subTotal= Order_Details::orderDetailsSubTotal();
        $shipping= Order_Details::orderDetailsShipping();
        $total= Order_Details::orderDetailsTotal();
    return view('checkout', compact('products', 'quantity', 'shipping','subTotal','total'));
    }

}