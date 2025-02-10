<?php

namespace App\Models;

use App\Models\accommodation\Accommodation;
use App\Models\activity\Activity;
use App\Models\user\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Ramsey\Uuid\Guid\Guid;

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
            $uuid = (string) Guid::uuid4();
            $order->id = strtoupper(substr($uuid, -12));
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
        return $this->belongsToMany(Product::class, 'orders_products', 'order_id', 'product_id')
        ->withPivot('quantity')
        ->withTimestamps();
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function address(){
        return $this->belongsTo(Address::class, 'address_id');
    }
}
