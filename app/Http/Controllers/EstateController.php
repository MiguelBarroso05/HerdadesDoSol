<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Estate;
use Illuminate\Http\Request;

class EstateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch paginated users, including soft-deleted ones
        $search_param = $request->query('search_estates');

        if ($search_param) {
            $estates = Estate::withTrashed()
                ->where('name', 'like', '%' . $search_param . '%')
                ->paginate(8);

            if ($estates->isEmpty()) {
                session()->flash('warning_estates', 'Nothing to show with "' . $search_param . '".');
            }
            return view('pages.estates.index', compact('estates', 'search_param'));
        } else {
            $estates = Estate::withTrashed()->paginate(8);
            return view('pages.estates.index', compact('estates'));
        }
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
    public function show(int $id)
    {
        $estate = Estate::withTrashed()->findOrFail($id);
        return view('pages.estates.show', ['estate' => $estate]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $estate = Estate::withTrashed()->findOrFail($id);
        return view('pages.estates.edit', ['estate' => $estate]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estate $estates)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estate $estate)
    {
        $estate->delete();
        return redirect()->route('estates.index');
    }

    public function recover(string $id)
    {
        $estate = Estate::onlyTrashed()->findOrFail($id);
        $estate->restore();
        return redirect()->route('estates.index')->with('success', 'Estate working successfully');
    }
}
