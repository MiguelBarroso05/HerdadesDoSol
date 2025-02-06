<?php

namespace App\Models;

use App\Models\user\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use HasFactory;
    public $timestamps = false;

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

    protected $hidden = [
        'number'
    ];

    public function getValidityAttribute($value)
    {
        return date('m/y', strtotime($value));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type(){
        return $this->belongsTo(PaymentMethodType::class, 'payment_method_type_id');
    }
}
