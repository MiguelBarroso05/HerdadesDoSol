<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use SoftDeletes;
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'identifier',
        'name',
        'number',
        'cvv',
        'expiration_date',
    ];
}
