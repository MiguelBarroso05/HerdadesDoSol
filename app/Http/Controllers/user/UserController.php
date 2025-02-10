<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\user\UserRequest;
use App\Models\Address;
use App\Models\user\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch paginated users, including soft-deleted ones
        $search_param = $request->query('search_users');

        if ($search_param) {
            $users = User::withTrashed()
                ->where('firstname', 'like', '%' . $search_param . '%')
                ->orWhere('lastname', 'like', '%' . $search_param . '%')
                ->paginate(8);

            if ($users->isEmpty()) {
                session()->flash('warning', 'Nothing to show with "' . $search_param . '".');
                return redirect()->route('users.index');
            }
            return view('pages.users.users', compact('users', 'search_param'));

        } else {
            $users = User::withTrashed()->paginate(8);
            return view('pages.users.users', compact('users'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $response = Http::get('https://restcountries.com/v2/all?fields=flag&fields=name');
            $countries = $response->json();
            $countries = Arr::sort($countries);
            $apiFailed = false;

        } catch (\Exception $e) {
            $countries = ['No countries loaded'];
            $apiFailed = true;
        }

        $languages = DB::table('languages')->get();

        $roles = Role::all()->pluck('name', 'id');
        return view('pages.users.create', compact('roles', 'countries', 'apiFailed', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            $validated = $request->validated();
            $role = Role::findById($request->role);

            $user = User::create($validated)->assignRole($role);

            $this->userstoreimg($request, $user);

            return redirect()->route('users.index')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Error creating user: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        return view('pages.users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $user = User::withTrashed()->findOrFail($id);

        try {
            $response = Http::get('https://restcountries.com/v2/all?fields=flag&fields=name');
            $countries = $response->json();
            $countries = Arr::sort($countries);
            $apiFailed = false;

        } catch (\Exception $e) {
            $countries = ['No countries loaded'];
            $apiFailed = true;
        }

        $languages = DB::table('languages')->get();

        if (auth()->user()->HasRole('admin')) {
            $roles = Role::all()->pluck('name', 'id');
            return view('pages.users.edit', compact('user', 'roles', 'languages', 'countries', 'apiFailed'));
        }
        if (auth()->user()->HasRole('client')) {
            return view('pages.client.edit-personal-info', compact('user', 'languages', 'countries', 'apiFailed'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        try {
            $validated = $request->validated();
            $dataToUpdate = $validated;
            $user->update($dataToUpdate);



            $this->userstoreimg($request, $user);

            $allergies = $request->input('allergies');

            $user->allergies()->sync($allergies);

            if (auth()->user()->hasRole('admin')) {
                $user->roles()->sync([$request->role]);
                return redirect()->route('users.index')->with('success', 'User updated successfully');
            }
            if (auth()->user()->hasRole('client')) {
                return redirect()->route('personal-info')->with('success', 'User updated successfully');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating user');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('warning', 'User disabled successfully');
    }

    public function recover(string $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('users.index')->with('success', 'User recovered successfully');
    }

    public function storeAddress(AddressRequest $request, User $user)
    {
        try {
            $validated = $request->validated();

            $existentAddress = DB::table('addresses')->get()
                ->where('country', $validated['address']['country'])
                ->where('city', $validated['address']['city'])
                ->where('street', $validated['address']['street'])
                ->where('zipcode', $validated['address']['zipcode'])
                ->first();

            if ($existentAddress) {
                $user->addresses()->attach($existentAddress->id, [
                    'addressPhone' => $validated['addressPhone'],
                    'addressIdentifier' => $validated['addressIdentifier'],
                ]);
            } else {
                $newAddressId = DB::table('addresses')->insertGetId($validated['address']);
                $user->addresses()->attach($newAddressId, [
                    'addressPhone' => $validated['addressPhone'],
                    'addressIdentifier' => $validated['addressIdentifier'],
                ]);
            }

            $roles = Role::all()->pluck('name', 'id');
            return redirect()->back()->with(['user' => $user, 'roles' => $roles]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating user: ' . $e->getMessage());
        }
    }


    public function destroyUserAddress(User $user, Address $address)
    {
        $user->addresses()->detach($address->id);
        return redirect()->back();
    }

    protected function userstoreimg($request, User $user)
    {
        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $filename = $user->id . '_' . $user->firstname . '_' . $user->lastname . '.' . $img->getClientOriginalExtension();
            $url = $img->storeAs('users', $filename, 'public');
            $user->img = $url;
            $user->save();
        }
    }
    public function verifyAccount(Request $request)
    {
        $user = User::where('id', $request->id)->first();

        if (!$user) {
            return redirect()->route('home')->with('error', 'Token invalid');
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('login')->with('success', 'Account verified successfully!');
    }
}
