<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Estate;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('pages.products.index', compact('products'));
    }

    public function adminIndex(Request $request)
    {

        $search_param = $request->query('search_products');

        $query = Product::query();

        if ($search_param) {
            $query->where('name', 'like', '%' . $search_param . '%');
        }

        $products = $query->paginate(10);
        $products->appends(['search_products' => $search_param]);

        return view('pages.products.admin.index', compact('products', 'search_param'));
    }

    public function adminCreate()
    {
        $categories = Category::all();
        $estates = Estate::all();
        return view('pages.products.admin.create', compact('categories', 'estates'));
    }

    public function adminStore(Request $request)
    {
        try {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'category_id' => 'required',
            'estate_id' => 'required',
        ]);
        }catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        $product->estate_id = $request->estate_id;
        if ($request->hasFile('image')) {
            $file = request()->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $url = $file->storeAs('products', $filename, 'public');
            $product->image = $url;
        }
        $product->save();
        return redirect()->route('products.admin.index')->with('success', 'Product created successfully.');
    }

    public function adminEdit(Product $product)
    {
        $categories = Category::all();
        $estates = Estate::all();
        return view('pages.products.admin.edit', compact('product', 'categories', 'estates'));
    }

    public function adminUpdate(Request $request, Product $product)
    {
        try {
            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'price' => 'required',
                'stock' => 'required',
                'estate_id' => 'required',
                'category_id' => 'required',
            ]);
        }catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
        $product->fill($request->all());
        $product->save();
        return redirect()->route('products.admin.index');
    }

    public function adminDestroy(Product $product){
        $product->delete();
        return redirect()->route('products.admin.index');
    }

    public function adminShow(Product $product){
        return view('pages.products.admin.show', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $estates = Estate::all();
        return view('pages.products.create', compact('categories', 'estates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public
    function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'category_id' => 'required',
            'estates_id' => 'required',
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $this->storeimage($request, $product);
        $product->save();
    }

    public
    function storeimage($request, $product)
    {
        if ($request->hasFile('image')) {
            $file = request()->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $url = $file->storeAs('products', $filename, 'public');
            $product->image = $url;
        }
    }

    /**
     * Display the specified resource.
     */
    public
    function show(Product $product)
    {
        return view('pages.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public
    function edit(Product $product)
    {
        $categories = Category::all();
        return view('pages.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public
    function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',

        ]);
        $product->fill($request->all());
        $this->storeimage($request, $product);
        $product->save();
        return redirect()->route('pages.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public
    function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('pages.products.index');
    }
}
