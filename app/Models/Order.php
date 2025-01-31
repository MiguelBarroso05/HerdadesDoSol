<?php

namespace App\Models;

use App\Models\accommodation\Accommodation;
use App\Models\activity\Activity;
use App\Models\user\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory, SoftDeletes;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'order_id',
        'user_id',
        'estate_id',
        'invoice_id',
        'status',
        'price'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function accommodation()
    {
        return $this->belongsToMany(Accommodation::class, 'orders_accommodations', 'order_id', 'accommodation_id')
            ->withPivot(['date_in', 'date_out', 'created_at', 'updated_at', 'deleted_at'])
            ->withTimestamps();
    }

    //Para eliminar depois
    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'orders_activities');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'orders_products');
    }

    public function estate()
    {
        return $this->belongsTo(Estate::class, 'estate_id');
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
