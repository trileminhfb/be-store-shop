<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_product',
        'id_invoice',
        'quantity'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
