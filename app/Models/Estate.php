<?php

namespace App\Models;

use App\Models\accommodation\Accommodation;
use App\Models\activity\Activity;
use App\Models\user\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estate extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'address_id',
        'image',
        ];

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
    public function accommodations(){
        return $this->hasMany(Accommodation::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
}
