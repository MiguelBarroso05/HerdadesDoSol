<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use App\Models\user\User;
use App\Notifications\ForgotPassword;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class ResetPassword extends Controller
{
    use Notifiable;

    public function show()
    {
        return view('pages.auth.reset-password');
    }

    public function routeNotificationForMail()
    {
        return request()->email;
    }

    public function send(Request $request)
    {
        // Validate the email input
        $validated = $request->validate([
            'email' => ['required', 'email'] // Ensure it's a valid email
        ]);

        $email = $validated['email'];

        // Find the user by email
        $user = User::where('email', $email)->first();

        if ($user) {
            // Send a forgot password notification
            $user->notify(new ForgotPassword($user->id)); // Assuming ForgotPassword is implemented correctly
            return back()->with('success', 'An email was sent to your email address.');
        }

        // Optional: Handle cases where the user is not found
        return back()->with('error', 'No account found with that email address.');
    }
}
