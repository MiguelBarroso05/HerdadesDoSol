<?php

namespace App\Models\accommodation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accommodation extends Model
{
    /** @use HasFactory<\Database\Factories\accommodation\AccommodationFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'accommodation_type_id',
        'size',
        'description',
    ];

    public function accommodation_types()
    {
        return $this->belongsTo(AccommodationType::class, 'accommodation_type_id');
    }
}
