<?php

namespace App\Http\Controllers;

use App\Models\Estate;

use App\Models\user\Address;
use Illuminate\Http\Request;

class EstatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estates = Estate::all();
        return view('pages.estates.index', compact('estates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.estates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'country' => 'required',
            'city' => 'required',
            'street' => 'required',
            'zipcode' => 'required',
        ]);
        $alreadyExistsaddrees = Address::where('country',
            $validated['country'])->where('city',
            $validated['city'])->where('street',
            $validated['street'])->where('zipcode',
            $validated['zipcode'])->first();
        if ($alreadyExistsaddrees) {
            $estate = new Estate();
            $estate->name = $validated['name'];
            $estate->address_id = $alreadyExistsaddrees->id;
            $estate->save();
            return redirect()->route('pages.estates.index');
        }
        else {
            $address = new Address();
            $address->country = $validated['country'];
            $address->city = $validated['city'];
            $address->street = $validated['street'];
            $address->zipcode = $validated['zipcode'];
            $address->save();
            $estate = new Estate();
            $estate->name = $validated['name'];
            $estate->address_id = $address->id;
            $estate->save();
            return redirect()->route('pages.estates.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(estates $estates)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(estates $estates)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, estates $estates)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(estates $estates)
    {
        //
    }
}
