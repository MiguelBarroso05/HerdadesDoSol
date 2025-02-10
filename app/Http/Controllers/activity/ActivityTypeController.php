<?php

namespace App\Http\Controllers\activity;

use App\Http\Controllers\Controller;
use App\Http\Requests\activity\ActivityTypeRequest;
use App\Models\activity\ActivityType;
use Illuminate\Http\Request;

class ActivityTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_param = $request->query('search_activity_types');

        if ($search_param) {

            $activity_types = ActivityType::withoutTrashed()
                ->where('name', 'like', '%' . $search_param . '%')
                ->paginate(6);

            if ($activity_types->isEmpty()){
                session()->flash('warning', 'Nothing to show with "' . $search_param . '".');
                return redirect()->route('activity_types.index');
            }
            return view('pages.activity_types.activity_types', compact('activity_types', 'search_param'));
        }
        else{
            $activity_types = ActivityType::withoutTrashed()->paginate(6);
            return view('pages.activity_types.activity_types', compact('activity_types'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.activity_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActivityTypeRequest $request)
    {
        $validated = $request->validated();
        try{
            $activity_type = new ActivityType($validated);
            $activity_type->save();
            return redirect()->route('activity_types.index')->with('success', 'Activity Type created successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'error while creating activity type');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ActivityType $activity_type)
    {
        return view('pages.activity_types.show', ['activity_type' => $activity_type]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ActivityType $activity_type)
    {
        return view('pages.activity_types.edit', ['activity_type' => $activity_type]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ActivityTypeRequest $request, $id)
    {
        $activity_type = ActivityType::all()->findOrFail($id);
        try{
            $activity_type->update($request->validated());
            return redirect()->route('activity_types.index')->with('success', 'Activity Type updated successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'error while updating the activity type');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ActivityType $activity_type)
    {
        $activity_type->delete();
        return redirect()->route('activity_types.index')->with('success', 'Activity Type deleted successfully');
    }
}
