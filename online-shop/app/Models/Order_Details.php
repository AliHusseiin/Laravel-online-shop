<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Order_Details extends Model
{
    use HasFactory;
    public static function orderDetailsProducts()
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
       
      
    return $products; 
      
    }
    public static function orderDetailsQuantity()
    {
        $cartIds = Session::get('ids', []);
        $quantity = array_count_values($cartIds);
        return $quantity;

    }
    public static function orderDetailsSubTotal()
    {
        $products = self::orderDetailsProducts();
        $quantity = self::orderDetailsQuantity();
        $subTotal = 0;
        foreach ($products as $product) 
        {
            $subTotal += $product->getPriceWithDiscount() * $quantity[$product['id']];
        }

        return $subTotal;
    }
    public static function orderDetailsShipping()
    {
         $products = self::orderDetailsProducts();
        $quantity = self::orderDetailsQuantity();
        $shipping = 0;
        foreach ($products as $product) 
        {
            $shipping += $quantity[$product['id']] * 5;
        }

        return $shipping;

    }

    public static function orderDetailsTotal()
    {
        $subTotal = self::orderDetailsSubTotal();
        $shipping = self::orderDetailsShipping();
        $total = $subTotal + $shipping;

        return $total;
    }


}
