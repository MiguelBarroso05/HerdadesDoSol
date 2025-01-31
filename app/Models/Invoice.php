<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
    public $timestamps = false;

    protected $fillable = [
        'billing_id',
        'payment_method_id',
        'payment_date'
    ];

    public function billing(){
        return $this->belongsTo(Billing::class, 'billing_id');
    }

    public function payment_method(){
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }
}
