<div>
    <div class="hs-d-flex hs-justify-content-between hs-py-2" style="border-bottom: solid #B3B3B3 2px">
        <div class="hs-d-flex hs-justify-content-between hs-col-md-2">
            <a class="@if($seeBookings) hs-fw-bold @endif cursor-pointer" wire:click="showBookings">Bookings</a>
            <a class="@if(!$seeBookings) hs-fw-bold @endif cursor-pointer" wire:click="showOrders">My Products</a>
        </div>
        <div wire:ignore>
            <div style="width: 222px;">
                <select style="width: 200px;" data-hs-select='{
  "placeholder": "Select Orders Year",
  "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
  "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-primary !important dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600 hs-form-control",
  "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
  "dropdownVerticalFixedPlacement": "bottom",
  "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
  "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 primary-color dark:primary-color \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
  "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
}' name="ordersDropdown">
                    <option>6 meses</option>
                    <option>2024</option>
                    <option>2025</option>
                </select>
            </div>
        </div>
    </div>
    @if($seeBookings && $bookings)
        @foreach($orders as $order)
            @php $isExpanded = $expandedOrderId === $order->id;
            $checkedIn = false;
            $checkedOut = false;
            if ($order->status != 0 && $order->accommodation->pivot->date_in > now()){
                $checkedIn = true;
            }
            if ($order->accommodation->pivot->date_out <= now()){
                $order->status = 2;
                $order->save();
                $checkedOut = true;
            }
            @endphp
            <div class="hs-d-flex hs-justify-content-between hs-px-4 hs-py-3 hs-mt-4 hs-rounded-3 hs-bg-white"
                 style="border: solid #D9D9D9 1px; @if($isExpanded) height: 325px; @else height: 160px; @endif">
                <div class="hs-col-md-5 hs-d-flex hs-flex-column hs-justify-content-between">
                    <div class="hs-d-flex hs-justify-content-between">
                        <div class="hs-fw-bold hs-fs-5">
                            <span class="text-secondary">Order nº</span> <span class="uppercase">{{$order->id}}</span>
                        </div>
                        <div>
                            <p>{{$order->created_at}}</p>
                        </div>
                    </div>
                    <span class="text-secondary">{{$order->estate->name}}</span>
                    <div>
                        @if($order->status == 0)
                            <x-custom-badge text="Canceled" backgroundColor="#FFCACA" color="#D70000"/>
                        @elseif($order->status == 1)
                            <x-custom-badge text="In Progress" backgroundColor="#FFEBC6" color="#FFB427"/>
                        @elseif($order->status == 2)
                            <x-custom-badge text="Completed" backgroundColor="#E0EBDC" color="#437546"/>
                        @elseif($order->status == 3)
                            <x-custom-badge text="Reserved" backgroundColor="white" color="black"/>
                        @endif
                    </div>
                    @if($isExpanded)
                        <div class="hs-d-flex hs-justify-content-between">
                            <div class="relative">
                                <div class="border-l-4 border-purple-300 absolute h-28 left-4 top-2"></div>

                                <div class="flex items-center mb-4">
                                    <div
                                        class="w-8 h-8 flex items-center justify-center rounded-full bg-[#437546] text-white font-bold z-10">
                                        1
                                    </div>
                                    <div class="ml-4 flex align-items-center">
                                        <span class="font-semibold">Validated at 29-11-2024</span>
                                    </div>
                                </div>

                                <div class="flex items-center mb-4">
                                    <div
                                        class="w-8 h-8 flex items-center justify-center rounded-full bg-[@if($checkedIn) #437546 @else #5A5A5A @endif ] text-white font-bold z-10">
                                        2
                                    </div>
                                    <div class="ml-4">
                                        <span class="font-semibold">Check in</span>
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    <div
                                        class="w-8 h-8 flex items-center justify-center rounded-full bg-[@if($checkedOut) #437546 @else #5A5A5A @endif ] text-white font-bold z-10">
                                        3
                                    </div>
                                    <div class="ml-4">
                                        <span class="font-semibold">Check out</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="hs-col-md-5">
                    <div class="hs-d-flex hs-justify-content-end">
                        <a type="button" wire:click="toggleOrderDetails('{{ $order->id }}')" style="margin-left: 20px;">
                            <i class="bi @if($isExpanded) bi-dash @else bi-plus @endif hs-box-icon"></i>
                        </a>
                    </div>
                    @if($isExpanded)
                        <div class="hs-row h-[255px]">
                            <div class="hs-row">
                                <div class="hs-col-6 content-center">
                                    <p class="text-base mb-3">Estate Address</p>
                                    <p class="text-xs mb-1">{{$order->estate->name}}</p>
                                    <p class="text-xs mb-1">{{$order->estate->address->zipcode}}
                                        , {{$order->estate->address->city}}</p>
                                    <p class="text-xs mb-1">{{$order->estate->address->country}}</p>
                                </div>
                                <div class="hs-col-6 content-center">
                                    <p class="text-base mb-3">Billing Address</p>
                                    <p class="text-xs mb-1">{{$order->invoice->billing->address->street}}</p>
                                    <p class="text-xs mb-1">{{$order->invoice->billing->address->zipcode}}
                                        , {{$order->invoice->billing->address->city}}</p>
                                    <p class="text-xs mb-1">{{$order->invoice->billing->address->country}}</p>
                                </div>
                            </div>
                            <div class="hs-row">
                                <div class="hs-col-6 content-center">
                                    <p class="text-base mb-3">Order Amount</p>
                                    <p class="text-xs mb-1">{{$order->price}} €</p>
                                    <p class="text-xs mb-1">{{$order->invoice->payment_method->type}} ending
                                        in {{$order->invoice->payment_method->last4}}</p>
                                    <p class="text-xs mb-1 uppercase">{{$order->invoice->payment_method->name}}</p>
                                </div>
                                <div class="hs-col-6 content-center">
                                    <p class="text-base mb-3">Actions & Modifications</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
    @if(!$seeBookings && $orders)
        @foreach($orders as $order)
            @php
                $isExpanded = $expandedOrderId === $order->id;
                $totalQuantity = $order->products->sum(function ($product) {
                                return $product->pivot->quantity;
                });
            @endphp
            <div class="hs-d-flex hs-justify-content-between hs-px-4 hs-py-3 hs-mt-4 hs-rounded-3 hs-bg-white"
                 style="border: solid #D9D9D9 1px; @if($isExpanded) height: 350px; @else height: 160px; @endif">
                <div class="hs-col-md-5 hs-d-flex hs-flex-column hs-justify-content-between">
                    <div class="hs-d-flex hs-justify-content-between">
                        <div class="hs-fw-bold hs-fs-5">
                            <span class="text-secondary">Order nº</span> <span class="uppercase">{{$order->id}}</span>
                        </div>
                        <div>
                            <p>{{$order->created_at->format('d-m-Y')}}</p>
                        </div>
                    </div>
                    <span class="text-secondary">{{$totalQuantity}} @if($totalQuantity == 1)
                            Product
                        @else
                            Products
                        @endif ordered</span>
                    <div>
                        @if($order->status == 0)
                            <x-custom-badge text="Canceled" backgroundColor="#FFCACA" color="#D70000"/>
                        @elseif($order->status == 1 || $order->status == 2)
                            <x-custom-badge text="In Progress" backgroundColor="#FFEBC6" color="#FFB427"/>
                        @elseif($order->status == 3)
                            <x-custom-badge text="Delivered" backgroundColor="#a5bcef" color="#2563eb"/>
                        @elseif($order->status == 4)
                            <x-custom-badge text="Completed" backgroundColor="#E0EBDC" color="#437546"/>
                        @elseif($order->status == 5)
                            <x-custom-badge text="Reserved" backgroundColor="white" color="black"/>
                        @endif
                    </div>
                    @if($isExpanded)
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
                    @endif
                </div>

                <div class="hs-col-md-5">
                    <div class="hs-d-flex hs-justify-content-end">
                        <a type="button" wire:click="toggleOrderDetails('{{ $order->id }}')" style="margin-left: 20px;">
                            <i class="bi @if($isExpanded) bi-dash @else bi-plus @endif hs-box-icon"></i>
                        </a>
                    </div>
                    @if($isExpanded)
                        <div class="hs-row h-[255px]">
                            <div class="hs-row">
                                <div class="hs-col-6 content-center">
                                    <p class="text-base mb-3">Delivery Address</p>
                                    <p class="text-xs mb-1">{{$order->address->street}}</p>
                                    <p class="text-xs mb-1">{{$order->address->zipcode}}, {{$order->address->city}}</p>
                                    <p class="text-xs mb-1">{{$order->address->country}}</p>
                                </div>
                                <div class="hs-col-6 content-center">
                                    <p class="text-base mb-3">Billing Address</p>
                                    <p class="text-xs mb-1">{{$order->invoice->billing->address->street}}</p>
                                    <p class="text-xs mb-1">{{$order->invoice->billing->address->zipcode}}
                                        , {{$order->invoice->billing->address->city}}</p>
                                    <p class="text-xs mb-1">{{$order->invoice->billing->address->country}}</p>
                                </div>
                            </div>
                            <div class="hs-row">
                                <div class="hs-col-6 content-center">
                                    <p class="text-base mb-3">Order Amount</p>
                                    <p class="text-xs mb-1">{{$order->price}} €</p>
                                    <p class="text-xs mb-1">{{$order->invoice->payment_method->type->name}} ending
                                        in {{$order->invoice->payment_method->last4}}</p>
                                    <p class="text-xs mb-1 uppercase">{{$order->invoice->payment_method->name}}</p>
                                </div>
                                <div class="hs-col-6 content-center">
                                    <p class="text-base mb-3">Actions & Modifications</p>
                                    <div class="w-full">
                                        <button type="submit" class="hs-btn hs-btn-sm  bg-white"
                                                style="border: solid #D9D9D9 1px; color: black; line-height: 0.5; width: 70%">
                                            Print Invoice
                                        </button>
                                        <button type="submit" class="hs-btn hs-btn-sm  bg-white"
                                                style="border: solid #D9D9D9 1px; color: black; line-height: 0.5; width: 70%">
                                            Show Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
    @if($seeBookings && !$bookings)
        <p class="mt-10">No Bookings to show</p>
    @elseif(!$seeBookings && $orders->isEmpty())
        <p class="mt-10">No Orders to show</p>
    @endif
</div>
