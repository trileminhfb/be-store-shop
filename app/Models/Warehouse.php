<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $table = "wareHouse";
    protected $fillable = [
        'id_product',
        'quantity',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($warehouse) {
            $product = Product::find($warehouse->id_product);
            if ($product) {
                $product->delete();
            }
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'id', 'id_product');
    }
}
