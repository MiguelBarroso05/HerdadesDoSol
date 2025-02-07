<?php

namespace App\Models;

use App\Models\accommodation\Accommodation;
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
    ];
    public function create($request)
    {
        $request->validate([
            'entry_date' => 'required | date',
            'exit_date' => 'required | date',
            'user_id' => 'required',
            'estate_id' => 'required',
            'accommodation_id' => 'required',
            'groupsize' => 'required,numeric, min:1, max:8',
            'children' => 'required,numeric, min:0, max:8',
        ]);
        $reservation = new Reservation();
        $reservation->fill($request->all());
        $reservation->save();
        foreach ($request->activities as $activity) {
            $reservation->activities()->attach($activity);
        }
        return $reservation;
    }
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


}
