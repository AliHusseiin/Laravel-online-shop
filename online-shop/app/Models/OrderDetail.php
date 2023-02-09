<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class OrderDetail extends Model
{
    use HasFactory;
    protected $guarded = [];
       public function order(){
        return $this->belongsTo(Order::class);
    }
    public static function orderDetailsProducts()
    {
          $cartIds = Session::get('ids', []);
      $products = Product::findOrFail($cartIds);
      
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
