<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "product";
    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'quantity',
        'status',
        'category',
        'brand',
        'gender',
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class, 'id_product');
    }

    public function Warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'id_product');
    }
}
