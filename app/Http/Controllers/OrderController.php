<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
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
        dd($request);
        $request->validate([
            'user' => 'required',
            'address' => 'required',
            'billingInformation' => 'required',
            'paymentMethod' => 'required',
            'total' => 'required',
            'products' => 'required'
        ]);
        $order = new Order();
        $invoice = new Invoice();
        $invoice->billing_id = $request->billingInformation;
        $invoice->payment_method_id = $request->paymentMethod;
        $invoice->payment_date = now();
        $invoice->save();
        $order->user_id = $request->user;
        $order->address_id = $request->address;
        $order->price = $request->total;
        $order->invoice_id = $invoice->id;
        $order->save();
        if (!empty($request->products)) {
            foreach ($request->products as $product) {
                $order->products()->attach($product['product'], ['quantity' => $product['quantity']]);
            }
        }
        redirect()->route('orders.index')->with('success', 'Order made successfully.\nWe will contact you soon.'); 
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|min:1|max:3'
        ]);

        $order->status = $request->status;
        $order->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
    }
}
