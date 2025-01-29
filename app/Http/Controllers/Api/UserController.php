<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\user\User;

class UserController extends Controller
{
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
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validação da imagem
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

        if ($user->img && !str_contains($user->img, 'http')) {
            $user->img = asset("storage/{$user->img}") . '?t=' . $user->updated_at->timestamp;
        }

        return response()->json(['user' => $user]);
    }
}
