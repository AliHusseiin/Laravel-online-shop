<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    use HasFactory;
    public static $ruels = [
        'name' => 'required',
        'image' => 'required|mimes:jpg,png,bmp,jpeg|max:2048'
    ];
    protected $guarded = [];
    public $timestamps = false;

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
