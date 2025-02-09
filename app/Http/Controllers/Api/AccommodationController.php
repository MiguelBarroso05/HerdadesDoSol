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

        Log::info("DEBUG: Estate ID: $estateId, Check-In: $checkIn, Check-Out: $checkOut, Group Size: $groupSize");

        $types = Accommodation::where('estate_id', $estateId)
            ->where('size', '>=', $groupSize)
            ->whereNotIn('id', function ($query) use ($checkIn, $checkOut) {
                $query->select('accommodation_id')
                    ->from('reservations')
                    ->whereBetween('entry_date', [$checkIn, $checkOut])
                    ->orWhereBetween('exit_date', [$checkIn, $checkOut]);
            })
            ->with('accommodationType')
            ->groupBy('accommodation_type_id')
            ->select('accommodation_type_id', DB::raw('COUNT(*) as count'))
            ->get();

        $types = $types->map(function ($type) {
            return [
                'accommodation_type_id' => $type->accommodation_type_id,
                'name' => $type->accommodationType->name ?? 'Unknown',
                'count' => $type->count
            ];
        });

        return response()->json(['accommodation_types' => $types]);
    }

    public function getAvailableAccommodations(Request $request)
    {
        $estateId = $request->query('estate_id');
        $checkIn = $request->query('check_in');
        $checkOut = $request->query('check_out');
        $groupSize = $request->query('group_size');
        $accommodationTypeId = $request->query('accommodation_type_id');

        $availableAccommodations = Accommodation::where('estate_id', $estateId)
            ->where('accommodation_type_id', $accommodationTypeId)
            ->where('size', '>=', $groupSize)
            ->whereNotIn('id', function ($query) use ($checkIn, $checkOut) {
                $query->select('accommodation_id')
                    ->from('reservations')
                    ->whereBetween('entry_date', [$checkIn, $checkOut])
                    ->orWhereBetween('exit_date', [$checkIn, $checkOut]);
            })->get();

        return response()->json(['accommodations' => $availableAccommodations]);
    }
}
