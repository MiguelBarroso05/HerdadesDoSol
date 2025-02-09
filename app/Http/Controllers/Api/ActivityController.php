<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\activity\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::with('activityType', 'estate')->get();

        return response()->json([
            'activities' => $activities
        ]);
    }

    public function getActivitiesByEstateAndDate(Request $request)
    {
        $estateId = $request->query('estate_id');
        $checkIn = trim($request->query('check_in'), '"');
        $checkOut = trim($request->query('check_out'), '"');

        try {
            $checkIn = Carbon::createFromFormat('Y-m-d', $checkIn)->toDateString();
            $checkOut = Carbon::createFromFormat('Y-m-d', $checkOut)->toDateString();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid date format'], 400);
        }

        $groupSize = $request->query('group_size', 1);
        $childrenCount = $request->query('children', 0);

        $activities = Activity::where('estate_id', $estateId)
            ->whereBetween('date', [$checkIn, $checkOut])
            ->where(function ($query) use ($groupSize, $childrenCount) {
                $query->whereRaw("$groupSize <= (max_participants - participants)")
                ->orWhere(function ($q) use ($groupSize, $childrenCount) {
                    $q->where('adult_activity', true)
                    ->whereRaw("($groupSize + $childrenCount) <= (max_participants - participants)");
                });
            })
            ->get();

        return response()->json(['activities' => $activities]);
    }
}
