<?php

namespace App\Http\Controllers\accommodation;

use App\Http\Controllers\Controller;
use App\Http\Requests\accommodation\AccommodationRequest;
use App\Models\accommodation\Accommodation;
use App\Models\accommodation\AccommodationType;

class AccommodationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if  (auth()->user() && auth()->user()->hasRole('admin')) {
        $accommodations = Accommodation::with('accommodation_types')->paginate(8);
        return view('pages.accommodations.accommodations', compact('accommodations'));

        }
        $accommodations = AccommodationType::all();
        return view('pages.client.accommodations.index', compact('accommodations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $accommodation_types = AccommodationType::withoutTrashed()->get();
        return view('pages.accommodations.create', compact('accommodation_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccommodationRequest $request)
    {
        $validated = $request->validated();

        try{
            $accommodation = new Accommodation($validated);
            $accommodation->save();
            return redirect()->route('accommodations.index')->with('success', 'accommodation created successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Accommodation $accommodation)
    {
        return view('pages.accommodations.show', ['accommodation' => $accommodation]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Accommodation $accommodation)
    {
        $accommodation_types = AccommodationType::withoutTrashed()->get();
        return view('pages.accommodations.edit', compact('accommodation','accommodation_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccommodationRequest $request, $id)
    {
        $accommodation = Accommodation::all()->findOrFail($id);
        try{
            $accommodation->update($request->validated());
            return redirect()->route('accommodations.index')->with('success', 'accommodation updated successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accommodation $accommodation)
    {
        $accommodation->delete();
        return redirect()->route('accommodations.index');
    }
}
