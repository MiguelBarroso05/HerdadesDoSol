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
        'type',
        'number',
        'last4',
        'validity',
        'predefined'
    ];
}
