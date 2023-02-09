<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Order_Detail;
use App\Models\Order_Details;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller 
{
// 
function index()
  {

       $products = OrderDetail::orderDetailsProducts();
        $quantity= OrderDetail::orderDetailsQuantity();
        $subTotal= OrderDetail::orderDetailsSubTotal();
        $shipping= OrderDetail::orderDetailsShipping();
        $total= OrderDetail::orderDetailsTotal();
    return view('checkout', compact('products', 'quantity', 'shipping','subTotal','total'));
    }
    function placeOrder(Request $request)
    {
      $order = new Order;
      $user_id = Auth::user()->id;
    $order['user_id'] = $user_id;
    $order->fill($request->post());
    $order->save();
       $products = OrderDetail::orderDetailsProducts();
        $quantity= OrderDetail::orderDetailsQuantity();
        $subTotal= OrderDetail::orderDetailsSubTotal();
        $shipping= OrderDetail::orderDetailsShipping();
        $total= OrderDetail::orderDetailsTotal();
    
    foreach($products as $product)
    {
      $order_details = new OrderDetail;
      $order_details['product_id'] =$product['id'] ;
      $order_details['price'] =$product->getPriceWithDiscount() ;
      $order_details['quantity'] =$quantity[$product['id']];
      $order_details['subtotal'] = $subTotal;
    $order_details['shipping'] = $shipping;
     $order_details['total'] = $total;
     $order_details['order_id'] = $order['id'];
     $order_details->save();
    }
    
    Session::forget('ids');

    
    $order_number = $order['id'] . '45f' . $order['id'] . 'rts';
    return Redirect()->back()->with('success', 'Thank you for you Order, Order Number:'. $order_number);

    }
    

}