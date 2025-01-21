<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\user\UserRequest;
use App\Models\user\Address;
use App\Models\user\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
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
                session()->flash('warning_users', 'Nothing to show with "' . $search_param . '".');
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
        $roles = Role::all()->pluck('name', 'id');
        return view('pages.users.create', compact('roles'));
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
            return redirect()->back()->with('error', 'Error creating user: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('pages.users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $response = Http::get('https://restcountries.com/v2/all?fields=flag&fields=name');
        $countries = $response->json();
        $countries = Arr::sort($countries);
        $languages = DB::table('languages')->get();

        if (auth()->user()->HasRole('admin')){
            $roles = Role::all()->pluck('name', 'id');
            return view('pages.users.edit', compact('user', 'roles', 'languages', 'countries'));
        }
        if (auth()->user()->HasRole('client')){
            return view('pages.client.edit-personal-info', compact('user', 'languages', 'countries'));
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

            if (auth()->user()->HasRole('admin')){
                $user->roles()->sync([$request->role]);
                return redirect()->route('users.index')->with('success', 'User updated successfully');
            }
            if (auth()->user()->HasRole('client')){
                return redirect()->route('personal-info');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating user: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
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
                if ($user->addresses()->where('address_id', $existentAddress->id)->exists()) {
                    $user->addresses()->updateExistingPivot($existentAddress->id, ['updated_at' => now()]);
                } else {
                    $user->addresses()->attach($existentAddress->id, [
                        'addressPhone' => $validated['addressPhone'],
                        'addressIdentifier' => $validated['addressIdentifier'],
                    ]);
                }
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
}
