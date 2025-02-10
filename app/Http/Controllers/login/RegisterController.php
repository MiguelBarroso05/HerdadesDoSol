<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use App\Models\user\User;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function create()
    {
        return view('pages.auth.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email:rfc,dns|max:255|unique:users,email',
            'password'  => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W]).{8,}$/',
                'confirmed'
            ],
            'firstname' => 'required|max:255|min:2',
            'lastname' => 'required|max:255|min:2',
            'birthdate' => 'required|date|before:18 years ago',
            'terms' => 'required'
        ]);

        $user = User::create($attributes)->assignRole('client');


        event(new Registered($user));

        return redirect()->route('login');
    }
}
