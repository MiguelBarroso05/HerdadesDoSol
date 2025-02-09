<?php

namespace App\Http\Controllers\Api;

use App\Models\accommodation\Accommodation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AccommodationController extends Controller
{
    public function index()
    {
        $accommodations = Accommodation::with('accommodationType', 'estate')->get();

        return response()->json([
            'accommodations' => $accommodations
        ]);
    }

    public function getAvailableAccommodationTypes(Request $request)
    {
        $estateId = $request->query('estate_id');
        $checkIn = $request->query('check_in');
        $checkOut = $request->query('check_out');
        $groupSize = $request->query('group_size');

        $types = Accommodation::where('estate_id', $estateId)
            ->where('size', '>=', $groupSize)
            ->whereNotExists(function ($query) use ($checkIn, $checkOut) {
                $query->select(DB::raw(1))
                    ->from('reservations')
                    ->whereColumn('reservations.accommodation_id', 'accommodations.id')
                    ->where(function ($query) use ($checkIn, $checkOut) {
                        $query->whereBetween('entry_date', [$checkIn, $checkOut])
                            ->orWhereBetween('exit_date', [$checkIn, $checkOut])
                            ->orWhere(function ($query) use ($checkIn, $checkOut) {
                                $query->where('entry_date', '<=', $checkIn)
                                    ->where('exit_date', '>=', $checkOut);
                            });
                    });
            })
            ->join('accommodation_types', 'accommodations.accommodation_type_id', '=', 'accommodation_types.id')
            ->select('accommodation_types.id as id', 'accommodation_types.name as name')
            ->distinct()
            ->get();

        return response()->json(['accommodation_types' => $types]);
    }

    public function getAvailableAccommodations(Request $request)
    {
        $estateId = $request->estate_id;
        $checkIn = $request->check_in;
        $checkOut = $request->check_out;
        $groupSize = $request->group_size;

        // DEBUG: Mostrar o que está a ser recebido
        Log::info("DEBUG: Estate ID: $estateId, Check-In: $checkIn, Check-Out: $checkOut, Group Size: $groupSize");

        $availableAccommodations = Accommodation::where('estate_id', $estateId)
            ->where('size', '>=', $groupSize)
            ->whereNotIn('id', function ($query) use ($checkIn, $checkOut) {
                $query->select('accommodation_id')
                    ->from('reservations')
                    ->whereBetween('entry_date', [$checkIn, $checkOut])
                    ->orWhereBetween('exit_date', [$checkIn, $checkOut]);
            })->get();

        // DEBUG: Mostrar quantas acomodações foram encontradas
        Log::info("DEBUG: Found " . count($availableAccommodations) . " accommodations");

        return response()->json(['accommodations' => $availableAccommodations]);
    }
}
