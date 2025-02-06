<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\PaymentMethodType;
use Illuminate\Support\Facades\Auth;

class PaymentMethodController extends Controller
{
    /**
     * List all payment methods of the authenticated user.
     */
    public function index()
    {
        $user = Auth::user();
        $paymentMethods = $user->paymentMethods()->with('type')->get();

        return response()->json([
            'payment_methods' => $paymentMethods
        ]);
    }

    /**
     * Store a new payment method.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'identifier' => 'nullable|string|max:255',
            'payment_method_type_id' => 'required|exists:payment_method_types,id',
            'name' => 'required|string|max:255',
            'number' => 'required|string|max:16|unique:payment_methods,number',
            'validity' => 'required|string|max:5|regex:/^\d{2}\/\d{2}$/',
            'predefined' => 'boolean',
        ]);

        $user = Auth::user();

        if ($validated['predefined']) {
            $user->paymentMethods()->update(['predefined' => false]);
        }

        $paymentMethod = $user->paymentMethods()->create([
            'identifier' => $validated['identifier'] ?? 'Card',
            'payment_method_type_id' => $validated['payment_method_type_id'],
            'name' => $validated['name'],
            'number' => $validated['number'],
            'last4' => substr($validated['number'], -4),
            'validity' => $validated['validity'],
            'predefined' => $request->has('predefined') ? $request->predefined : false,
        ]);

        return response()->json([
            'message' => 'Payment method added successfully',
            'payment_method' => $paymentMethod
        ], 201);
    }


    /**
     * Delete a payment method.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $paymentMethod = $user->paymentMethods()->findOrFail($id);

        $paymentMethod->delete();

        return response()->json([
            'message' => 'Payment method deleted successfully'
        ]);
    }

    /**
     * Set a payment method as the default.
     */
    public function setDefault($id)
    {
        $user = Auth::user();
        $paymentMethod = $user->paymentMethods()->findOrFail($id);

        $user->paymentMethods()->update(['predefined' => false]);

        $paymentMethod->update(['predefined' => true]);

        return response()->json([
            'message' => 'Payment method set as default',
            'payment_method' => $paymentMethod
        ]);
    }
}
