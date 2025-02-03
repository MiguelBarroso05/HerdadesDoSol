<?php

namespace App\Models;

use App\Models\user\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'addresses';
    protected $fillable = [
        'country',
        'city',
        'street',
        'zipcode',
    ];

    public function users(){
        return $this->belongsToMany(User::class, 'users_addresses')
            ->withTimestamps()
            ->withPivot('addressPhone', 'addressIdentifier', 'isFavorite', 'order');
    }
}
