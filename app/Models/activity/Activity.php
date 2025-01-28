<?php

namespace App\Models\activity;

use App\Models\Estate;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    /** @use HasFactory<\Database\Factories\activity\ActivityFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'activity_type_id',
        'name',
        'description',
        'img',
        'date',
    ];

    public function activity_types()
    {
        return $this->belongsTo(ActivityType::class, 'activity_type_id');
    }
    public function estate()
    {
        return $this->belongsTo(Estate::class, 'estate_id');
    }
    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_activities', 'activity_id', 'reservation_id');
    }
}
