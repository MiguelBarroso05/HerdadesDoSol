@extends('layouts.app')

@section('content')
    <div class=" hs-mt-4 hs-rounded-3 hs-bg-white hs-p-6 m-28">
        <div class="hs-row flex justify-between" style="border-bottom: solid #B3B3B3 2px">
            <div class="hs-d-flex hs-justify-content-between hs-col-md-4">
                <div class="hs-fw-bold hs-fs-5">
                    <span class="text-secondary">Order nº</span> <span class="uppercase">{{$order->id}}</span>
                </div>
                <div>
                    <p>{{$order->created_at}}</p>
                </div>
            </div>
            <div class="hs-col-md-6 text-end">
                @if($order->status == 0)
                    <x-custom-badge text="Canceled" backgroundColor="#FFCACA" color="#D70000"/>
                @elseif($order->status == 1)
                    <x-custom-badge text="In Progress" backgroundColor="#FFEBC6" color="#FFB427"/>
                @elseif($order->status == 2)
                    <x-custom-badge text="Reserved" backgroundColor="white" color="black"/>
                @elseif($order->status == 3)
                    <x-custom-badge text="Completed" backgroundColor="#E0EBDC" color="#437546"/>
                @endif
            </div>
        </div>
        <div class="flex mt-6">
            <div class="hs-col-5 content-center">
                <p class="text-3xl mb-3">Billing Address</p>
                <p class="text-lg mb-1">{{$order->invoice->billing->address->street}}</p>
                <p class="text-lg mb-1">{{$order->invoice->billing->address->zipcode}}
                    , {{$order->invoice->billing->address->city}}</p>
                <p class="text-lg mb-1">{{$order->invoice->billing->address->country}}</p>
            </div>

            <div class="hs-col-4 content-center">
                <p class="text-3xl mb-3">Delivery Address</p>
                <p class="text-lg mb-1">{{$order->address->street}}</p>
                <p class="text-lg mb-1">{{$order->address->zipcode}}, {{$order->address->city}}</p>
                <p class="text-lg mb-1">{{$order->address->country}}</p>
            </div>

            <div class="hs-d-flex hs-justify-content-between">
                <div class="relative">
                    <div class="border-l-4 border-purple-300 absolute h-36 left-4 top-2"></div>

                    <div class="flex items-center mb-4">
                        <div
                            class="w-8 h-8 flex items-center justify-center rounded-full {{ $order->status == 1 ? 'bg-[#437546]' : 'bg-[#1E1E1E]' }} text-white font-bold z-10">
                            1
                        </div>
                        <div class="ml-4 flex align-items-center">
                                        <span
                                            class="font-semibold">Validated at {{$order->created_at->format('d-m-Y')}}</span>
                        </div>
                    </div>

                    <div class="flex items-center mb-4">
                        <div
                            class="w-8 h-8 flex items-center justify-center rounded-full {{ $order->status == 2 ? 'bg-[#437546]' : 'bg-[#1E1E1E]' }} text-white font-bold z-10">
                            2
                        </div>
                        <div class="ml-4">
                            <span class="font-semibold">Prepared</span>
                        </div>
                    </div>

                    <div class="flex items-center mb-4">
                        <div
                            class="w-8 h-8 flex items-center justify-center rounded-full {{ $order->status == 3 ? 'bg-[#437546]' : 'bg-[#1E1E1E]' }} text-white font-bold z-10">
                            3
                        </div>
                        <div class="ml-4">
                                        <span
                                            class="font-semibold">{{$order->delivered_at ? 'Issued at '. $order->delivered_at->format('d-m-Y') : 'For issuing'}}</span>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div
                            class="w-8 h-8 flex items-center justify-center rounded-full {{ $order->status == 4 ? 'bg-[#437546]' : 'bg-[#1E1E1E]' }} text-white font-bold z-10">
                            4
                        </div>
                        <div class="ml-4">
                            <span class="font-semibold">Delivered</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex">
            <div>
                <div>

                </div>
                <div class="content-center">
                    <p class="text-3xl mb-3">Order Amount</p>
                    <p class="text-lg mb-1">{{$order->price}} €</p>
                    <p class="text-lg mb-1">{{$order->invoice->payment_method->type->name}} ending
                        in {{$order->invoice->payment_method->last4}}</p>
                    <p class="text-lg mb-1 uppercase">{{$order->invoice->payment_method->name}}</p>
                </div>
            </div>
        </div>

    </div>
@endsection
