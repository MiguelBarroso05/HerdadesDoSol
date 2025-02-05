<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstateRequest;
use App\Models\Address;
use App\Models\Estate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EstateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch paginated estates, including soft-deleted ones
        $search_param = $request->query('search_estates');

        if ($search_param) {
            $estates = Estate::withTrashed()
                ->where('name', 'like', '%' . $search_param . '%')
                ->paginate(6);

            if ($estates->isEmpty()) {
                session()->flash('warning', 'Nothing to show with "' . $search_param . '".');
                return redirect()->route('estates.index');
            }
            return view('pages.estates.index', compact('estates', 'search_param'));
        } else {
            $estates = Estate::withTrashed()->paginate(6);
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
    public function store(EstateRequest $request)
    {
        try {
            $validated = $request->validated();

            $alreadyExistsAddrees = Address::where('country', $validated['country'])
                ->where('city', $validated['city'])
                ->where('street', $validated['street'])
                ->where('zipcode', $validated['zipcode'])
                ->first();

            if ($alreadyExistsAddrees) {
                $addressId = $alreadyExistsAddrees->id;
            } else {
                $address = new Address();
                $address->country = $validated['country'];
                $address->city = $validated['city'];
                $address->street = $validated['street'];
                $address->zipcode = $validated['zipcode'];
                $address->save();
                $addressId = $address->id;
            }

            $estate = new Estate();
            $estate->name = $validated['name'];
            $estate->address_id = $addressId;
            $estate->save();

            if ($request->hasFile('img')) {
                $img = $request->file('img');
                $filename = $estate->id . '_' . Str::slug($estate->name) . '.' . $img->getClientOriginalExtension();
                $url = $img->storeAs('estates', $filename, 'public');
                $estate->img = $url;
                $estate->save();
            }

            return redirect()->route('estates.index')->with('success', 'Estate created successfully.');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Error creating estate: ' . $e->getMessage());
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
    public function update(EstateRequest $request, Estate $estate)
    {
        try {
            $validated = $request->validated();

            $alreadyExistsAddrees = Address::where('country', $validated['country'])
                ->where('city', $validated['city'])
                ->where('street', $validated['street'])
                ->where('zipcode', $validated['zipcode'])
                ->first();

            if ($alreadyExistsAddrees) {
                $addressId = $alreadyExistsAddrees->id;
            } else {
                $address = new Address();
                $address->country = $validated['country'];
                $address->city = $validated['city'];
                $address->street = $validated['street'];
                $address->zipcode = $validated['zipcode'];
                $address->save();
                $addressId = $address->id;
            }
            $estate->name = $validated['name'];
            $estate->address_id = $addressId;
            $estate->save();

            if ($request->hasFile('img')) {
                $img = $request->file('img');
                $filename = $estate->id . '_' . Str::slug($estate->name) . '.' . $img->getClientOriginalExtension();
                $url = $img->storeAs('estates', $filename, 'public');
                $estate->img = $url;
                $estate->save();
            }

            return redirect()->route('estates.show', $estate)->with('success', 'Estate updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating estate: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estate $estate)
    {
        $estate->delete();
        return redirect()->route('estates.index')->with('warning', $estate->name .' in maintenance');
    }

    public function recover(string $id)
    {
        $estate = Estate::onlyTrashed()->findOrFail($id);
        $estate->restore();
        return redirect()->route('estates.index')->with('success', 'Estate working successfully');
    }
}
