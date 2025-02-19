<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProduct extends Model
{
    /** @use HasFactory<\Database\Factories\OrderProductFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'orders_products';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
    ];
    protected $rules = [
        'quantity' => 'required|integer|min:1',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
