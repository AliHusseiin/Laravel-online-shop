<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    public static $ruels = ['name' => 'required'];

    protected $guarded = ['rating', 'rating_count'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function getPriceWithDiscount(){
        return $this->price - $this->price * $this->discount;
    }
 
}
