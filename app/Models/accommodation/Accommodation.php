<?php

namespace App\Models\accommodation;

use App\Models\Estate;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accommodation extends Model
{
    /** @use HasFactory<\Database\Factories\accommodation\AccommodationFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'accommodation_type_id',
        'estate_id',
        'size',
        'name',
        'price',
    ];

    public function accommodationType()
    {
        return $this->belongsTo(AccommodationType::class, 'accommodation_type_id');
    }
    public function estate()
    {
        return $this->belongsTo(Estate::class);
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
