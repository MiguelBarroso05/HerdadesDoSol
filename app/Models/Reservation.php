<?php

namespace App\Models;

use App\Models\accommodation\Accommodation;
use App\Models\accommodation\AccommodationType;
use App\Models\activity\Activity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Guid\Guid;

class Reservation extends Model
{
    /** @use HasFactory<\Database\Factories\ReservationFactory> */
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $uuid = (string) Guid::uuid4();
            $order->id = strtoupper(substr($uuid, -12));
        });
    }

    protected $fillable = [
        'user_id',
        'estate_id',
        'accommodation_id',
        'groupsize',
        'children',
        'entry_date',
        'exit_date',
        'price',
        'status',
        'invoice_id',
    ];

    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'reservation_activities', 'reservation_id', 'activity_id')->withTimestamps();
    }
    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function estate(){
        return $this->belongsTo(Estate::class);
    }
    public function accommodationType(){
        return $this->belongsTo(AccommodationType::class);
    }
}
