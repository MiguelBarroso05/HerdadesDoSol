<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';
    protected $fillable = [
        'country',
        'state',
        'city',
        'street',
        'lot',
        'number',
        'zipcode',
    ];

    public function users(){
        return $this->belongsToMany(User::class, 'users_addresses')
            ->withTimestamps();
    }
}
