<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Renderable;
use App\Models\user\User;
use App\Notifications\WrongLoginAttempt;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use ThrottlesLogins, AuthenticatesUsers;

    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('pages.auth.login');
    }

    /**
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $user = User::where('email', $request->email)->first();
            $user->notify(new WrongLoginAttempt());
            return $this->sendLockoutResponse($request);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            if (Auth::user()->hasRole('admin')) {
                return redirect()->intended('dashboard');
            }

            return redirect()->intended('teste');
        }

        $this->incrementLoginAttempts($request);

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function loginAdmin()
    {
        // Exemplo: login do admin com ID 1
        $admin = User::find(1); // Assume que o utilizador com ID 1 é o admin
        if ($admin) {
            Auth::login($admin);
            return redirect()->route('dashboard'); // Redirecionar para a dashboard ou outra rota
        }
        return redirect()->route('login')->with('error', 'Admin não encontrado.');
    }

    public function loginClient()
    {
        // Exemplo: login do cliente com ID 2
        $client = User::find(2); // Assume que o utilizador com ID 2 é o cliente
        if ($client) {
            Auth::login($client);
            return redirect()->route('account'); // Redirecionar para a dashboard ou outra rota
        }
        return redirect()->route('login')->with('error', 'Cliente não encontrado.');
    }

    protected function maxAttempts(): int
    {
        return 3;
    }

    protected function decayMinutes(): int
    {
        return 15;
    }
    public function username(): string
    {
        return 'email';
    }
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        $minutes = ceil($seconds / 60);

        throw ValidationException::withMessages([
            'email' => [
                __('Too many login attempts. Please try again in :minutes minutes.', ['minutes' => $minutes]),
            ],
        ])->status(429);
    }

}
