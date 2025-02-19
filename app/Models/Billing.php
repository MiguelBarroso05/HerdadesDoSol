<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Billing extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'address_id',
        'name',
        'email',
        'phone',
        'nif',
        'status'
    ];

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }
}
