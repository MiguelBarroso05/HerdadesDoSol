<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethodType extends Model
{

    protected $fillable = [
        'name',
        'img',
        ];
}
