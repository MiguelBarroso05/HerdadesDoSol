<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\user\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password'  => [
                    'required',
                    'string',
                    'min:8',
                    'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W]).{8,}$/',
                    'confirmed'
                ],
                'nif' => 'nullable|digits:9|unique:users,nif',
                'birthdate' => 'required|date',
                'phone' => 'nullable|string|max:15',
            ]);

            $user = User::create($validated);

            return response()->json([
                'message' => 'User registered successfully',
                'user' => $user
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * User login.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Validate input data
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the user exists and credentials are valid
        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.'
            ], 401);
        }

        // Generate token using Laravel Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful.',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

    public function edit(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'nif' => 'nullable|digits:9',
            'birthdate' => 'nullable|date',
            'phone' => 'nullable|string|max:15',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = $request->user();
        $user->update($validated);

        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $filename = $user->id . '_' . $user->firstname . '_' . $user->lastname . '.' . $img->getClientOriginalExtension();
            $path = $img->storeAs('users', $filename, 'public');

            $user->img = $path;
            $user->save();
        }


        return response()->json([
            'message' => 'User updated successfully.',
            'user' => $user,
        ]);
    }

    public function getUserData(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if ($user->img && !str_contains($user->img, 'http')) {
            $user->img = asset("storage/{$user->img}") . '?t=' . $user->updated_at->timestamp;
        }

        return response()->json(['user' => $user]);
    }

    public function getBillingInfo(Request $request)
    {
        $user = $request->user();
        $billing = $user->billing()->with('address')->first();

        if ($billing) {
            $isBillingEmpty = is_null($billing->name) && is_null($billing->phone) && is_null($billing->nif) && is_null($billing->email);

            return response()->json([
                'billing' => $isBillingEmpty ? null : $billing,
                'address' => $billing->address ?? null,
            ]);
        }

        return response()->json([
            'billing' => null,
            'address' => null,
        ]);
    }

    public function updateBillingInfo(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nif' => 'nullable|string|size:9',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:15',
        ]);

        $user = $request->user();
        $billing = $user->billing()->firstOrCreate([]);

        $billing->update([
            'name' => $validated['name'],
            'nif' => $validated['nif'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);

        return response()->json([
            'message' => 'Billing information updated successfully!',
            'billing' => $billing->load('address'),
        ]);
    }

    public function updateBillingAddress(Request $request)
    {
        $validated = $request->validate([
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'street' => 'required|string|max:255',
            'zipcode' => 'required|string|max:20',
        ]);

        $user = $request->user();
        $billing = $user->billing()->firstOrCreate([]);

        $address = $billing->address()->updateOrCreate(
            ['id' => $billing->address_id],
            [
                'country' => $validated['country'],
                'city' => $validated['city'],
                'street' => $validated['street'],
                'zipcode' => $validated['zipcode'],
            ]
        );

        $billing->update(['address_id' => $address->id]);

        return response()->json([
            'message' => 'Billing address updated successfully!',
            'address' => $address,
        ]);
    }
}
