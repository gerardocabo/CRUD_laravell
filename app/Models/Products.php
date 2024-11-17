<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    
    protected $table = 'products';
    
    protected $fillable = [
        'product_name',
        'product_price',
        'product_seller',
        'product_place',
        'product_description',
        'product_quantity',
        'product_image',
    ];
}
