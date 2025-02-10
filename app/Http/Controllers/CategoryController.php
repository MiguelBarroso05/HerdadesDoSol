<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_param = $request->query('search_categories');

        if ($search_param) {
            $categories = Category::withoutTrashed()
                ->where('name', 'like', '%' . $search_param . '%')
                ->paginate(6)
                ->appends(['search_categories' => $search_param]);

            if ($categories->isEmpty()) {
                session()->flash('warning', 'Nothing to show with "' . $search_param . '".');
                return redirect()->route('categories.index');
            }
            return view('pages.categories.index', compact('categories', 'search_param'));

        } else {
            $categories = Category::withoutTrashed()->paginate(6);
            return view('pages.categories.index', compact('categories'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();
        try{
            $category = new Category($validated);
            $category->save();
            return redirect()->route('categories.index')->with('success', 'Category created successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'error while creating category');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('pages.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::all()->findOrFail($id);
        try{
            $category->update($request->validated());
            return redirect()->route('categories.index')->with('success', 'Category updated successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'error while updating category');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}
