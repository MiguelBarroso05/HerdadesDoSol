<?php

namespace App\Models;

use App\Models\accommodation\Accommodation;
use App\Models\activity\Activity;
use App\Models\user\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory, SoftDeletes;

    public $incrementing = false;

    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            // Gerar UUID quando um novo registo for criado
            if (!$order->id) {
                $order->id = Str::uuid()->toString();
            }
        });
    }

    protected $fillable = [
        'order_id',
        'user_id',
        'address_id',
        'invoice_id',
        'status',
        'price'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'orders_products')
        ->withPivot('quantity')
        ->withTimestamps();
    }


    public function invoice(){
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
