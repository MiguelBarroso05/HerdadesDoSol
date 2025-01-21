<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validated();
        $orderProduct = new OrderProduct();
        $orderProduct->fill($request->all());
        $orderProduct->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderProduct $orderProduct)
    {
        $request->validated();
        $orderProduct->fill($request->all());
        $orderProduct->update();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderProduct $orderProduct)
    {
        $orderProduct->delete();
    }
}
