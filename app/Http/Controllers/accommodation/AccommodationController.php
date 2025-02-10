<?php

namespace App\Http\Controllers\accommodation;

use App\Http\Controllers\Controller;
use App\Http\Requests\accommodation\AccommodationRequest;
use App\Models\accommodation\Accommodation;
use App\Models\accommodation\AccommodationType;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_param = $request->query('search_acommodations');

        if ($search_param) {
            $accommodations = Accommodation::with('accommodation_types')
                ->where('type', 'like', '%' . $search_param . '%')
                ->orWhere('size', 'like', '%' . $search_param . '%')
                ->paginate(6);

            if ($accommodations->isEmpty()){
                session()->flash('warning', 'Nothing to show with "' . $search_param . '".');
                return redirect()->route('accommodations.index');
            }
            return view('pages.accommodations.accommodations', compact('accommodations', 'search_param'));

        } else {
            $accommodations = Accommodation::with('accommodation_types')->paginate(6);
            return view('pages.accommodations.accommodations', compact('accommodations'));
        }
<<<<<<< HEAD
        $accommodations = AccommodationType::all();
        return view('pages.client.accommodations.index', compact('accommodations'));
=======
>>>>>>> 568d04d336f4b077bb1965fbb305cd58b3407950
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
