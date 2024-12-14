<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'id_user',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(ItemInvoice::class, 'id_invoice');
    }
}
