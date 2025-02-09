<?php

namespace App\Http\Controllers\Api;

use App\Models\activity\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $request->validate([
            'estate_id' => 'required|integer|exists:estates,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
        ]);

        $activities = Activity::where('estate_id', $request->estate_id)
            ->whereBetween('date', [$request->check_in, $request->check_out])
            ->get();

        return response()->json(['activities' => $activities]);
    }
}
