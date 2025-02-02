<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{

    protected $fillable = [
        'user_id',
        'identifier',
        'name',
        'payment_method_type_id',
        'number',
        'last4',
        'validity',
        'predefined'
    ];

    public function type(){
        return $this->belongsTo(PaymentMethodType::class, 'payment_method_type_id');
    }
}
