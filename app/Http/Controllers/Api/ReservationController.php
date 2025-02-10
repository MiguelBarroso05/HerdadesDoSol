<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\Invoice;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    public function book(Request $request)
    {
        $validated = $request->validate([
            'estate_id' => 'required|exists:estates,id',
            'accommodation_id' => 'required|exists:accommodations,id',
            'entry_date' => 'required|date',
            'exit_date' => 'required|date|after:entry_date',
            'groupsize' => 'required|integer|min:1',
            'children' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'activities' => 'nullable|array',
            'activities.*' => 'exists:activities,id',
        ]);

        try {
            Log::info('Booking request received', ['request' => $validated]);

            DB::beginTransaction();

            $billing = Billing::where('user_id', auth()->id())->first();
            if (!$billing) {
                Log::error('No billing information found for user', ['user_id' => auth()->id()]);
                return response()->json([
                    'message' => 'No billing information found for the user.'
                ], 400);
            }

            $invoice = Invoice::create([
                'billing_id' => $billing->id,
                'payment_method_id' => $validated['payment_method_id'],
                'payment_date' => now(),
            ]);

            $reservation = Reservation::create([
                'id' => Str::uuid(),
                'user_id' => auth()->id(),
                'estate_id' => $validated['estate_id'],
                'accommodation_id' => $validated['accommodation_id'],
                'entry_date' => $validated['entry_date'],
                'exit_date' => $validated['exit_date'],
                'groupsize' => $validated['groupsize'],
                'children' => $validated['children'],
                'price' => $validated['price'],
                'invoice_id' => $invoice->id,
            ]);

            if (!empty($validated['activities'])) {
                $reservation->activities()->attach(array_map('strval', $validated['activities']));
                Log::info('Activities attached', ['activities' => $validated['activities']]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Reservation created successfully',
                'reservation_id' => $reservation->id,
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to create reservation',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getUserTrips(Request $request)
    {
        $user = auth()->user();

        $trips = Reservation::with([
            'estate',
            'accommodation.accommodationType:id,name,img',
            'activities'
        ])
            ->where('user_id', $user->id)
            ->orderBy('entry_date', 'desc')
            ->get();

        return response()->json(['trips' => $trips], 200);
    }
}
