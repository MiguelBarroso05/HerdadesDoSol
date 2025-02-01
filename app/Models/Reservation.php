<?php

namespace App\Models;

use App\Models\accommodation\Accommodation;
use App\Models\activity\Activity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    /** @use HasFactory<\Database\Factories\ReservationFactory> */
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
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
            'start_date' => 'required',
            'end_date' => 'required',
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
