<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    public function show()
    {
        return view('pages.users.user-profile');
    }

    public function update(Request $request)
    {
        $attributes = $request->validate([
            'firstname' => ['max:100'],
            'lastname' => ['max:100'],
            'email' => ['required', 'email', 'max:255',  Rule::unique('users')->ignore(auth()->user()->id),],
            'img' => 'nullable|image|max:2048',
            'address' => ['max:100'],
            'city' => ['max:100'],
            'country' => ['max:100'],
            'postal' => ['max:100'],
            'about' => ['max:255']
        ]);

        $user = auth()->user();

        $dataToUpdate =([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'city' => $request->get('city'),
            'country' => $request->get('country'),
            'postal' => $request->get('postal'),
            'about' => $request->get('about')
        ]);

        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $filename = $user->id . '_' . $user->firstname . '_' . $user->lastname . '.' . $img->getClientOriginalExtension();
            $url = $img->storeAs('users', $filename, 'public');
            $dataToUpdate['img'] = $url;
        }

        $user->update($dataToUpdate);
        return back()->with('succes', 'Profile succesfully updated');
    }
}
