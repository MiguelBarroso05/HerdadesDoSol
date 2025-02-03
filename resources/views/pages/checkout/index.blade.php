@php
    $total = 0;
@endphp
@extends('layouts.app')

@section('content')
    @include('layouts.navbars.guest.navbar')
    <main class="hs-d-flex hs-flex-grow-1 hs-mt-8 hs-px-9 hs-justify-content-center hs-mb-2">
        <div class="hs-w-80 hs-bg-card hs-p-5 hs-rounded-3 hs-d-flex hs-flex-row hs-justify-content-between">
            <div class="hs-w-70">
                @if (count(session('cart')) > 0 && !$isReservation)
                    <h5>Basket</h5>

                    @foreach (session('cart') as $id => $product)
                        <div class="hs-d-flex hs-flex-row hs-justify-content-between ">
                            <div class="hs-py-2">
                                <p>Name: {{ $product['name'] }} <span class="hs-text-muted">x
                                        {{ $product['quantity'] }}</span></p>
                                <p>{{ $product['price'] }}€</p>
                            </div>
                            <div>
                                <a href="{{ route('cart.remove', $id) }}"><i class="bi bi-x text-red-600 hs-fs-5"></i></a>
                            </div>
                        </div>
                        <hr>
                        @php
                            $total += $product['price'] * $product['quantity'];
                        @endphp
                    @endforeach
                @else
                    @php
                        $total = 0;
                    @endphp
                    <h5>Reservation</h5>
                    <p>
                        You have a reservation at {{ $reservation->estate->name }} from
                        {{ $reservation->entryDate }} to {{ $reservation->exitDate }} in a
                        {{ $reservation->accommodationType->name }} accommodation with a size of
                        {{ $reservation->accommodation->size }} people.
                    </p>
                    @if (count($reservation->activities) > 0)
                        <p>Activities:</p>
                        <ul>
                            @foreach ($reservation->activities as $activity)
                                <li>{{ $activity->name }}</li>
                            @endforeach
                        </ul>
                    @endif
                @endif
                <h6>Total: {{ $total }}€</h6>
                <h6>Chose a payment method</h6>
                <div class="hs-d-flex hs-flex-row">
                    @foreach (auth()->user()->paymentMethods as $card)
                        <div
                            class="w-[240px] h-[94px] hs-rounded-3 hs-m-3 flex flex-col justify-around place-self-center bg-[#EEEEEE] hs-cursor-pointer {{ $card->predefined == 1 ? 'hs-card-selected' : '' }}">

                            <div class="flex flex-row items-center w-full">
                                <div class="hs-col-md-5 px-2">
                                    <div
                                        class="w-[90px] h-[55px] bg-gradient-to-r from-orange-500 to-orange-700 text-white p-2 rounded shadow-lg flex flex-col justify-between">
                                        <span class="text-[5px] uppercase">{{ $card->name }}</span>
                                        <img class="w-[15px] h-auto" src="{{ asset('/imgs/pages/creditCardChip.png') }}"
                                            alt="creditCardChip" />
                                        <div class="text-[5px]">
                                            <span>**** **** **** {{ $card->last4 }}</span>
                                        </div>
                                        <div class="flex justify-between text-[5px]">
                                            <span class="content-center">**/**</span>
                                            <img class="w-[15px] h-auto" src="{{ asset($card->type->img) ?? null }}"
                                                alt="{{ $card->type->name }}Logo">
                                        </div>
                                    </div>
                                </div>

                                <div class="hs-col-md-7 px-2">
                                    <p class="m-0 text-sm">{{ $card->identifier ?? 'Card' }}</p>
                                    <p class="m-0 text-xs">Card ending in {{ $card->last4 }}</p>
                                </div>
                            </div>

                            @if ($card->predefined == 1)
                                <div class="hs-row w-full px-2 pb-1">
                                    <span class="text-xs font-bold">Predefined Payment Method <i
                                            class="bi bi-check"></i></span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            <div>
                <div><a href="" class="hs-btn hs-btn-primary hs-w-100">Buy</a></div>
                <div id="paypal-button-container"></div>
            </div>
    </main>

@endsection


@push('js')
    <script>
        paypal.Buttons({
            style: {
                color: 'black',
            },
            createOrder: function(data, actions) {
                // Cria uma ordem no PayPal
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{ $total }}' // Montante do pagamento
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                // Captura a ordem após a aprovação do utilizador
                return actions.order.capture().then(function(details) {
                    alert('Pagamento concluído com sucesso, ' + details.payer.name.given_name + '!');
                    console.log(details); // Detalhes do pagamento
                });
            },
            onError: function(err) {
                console.error(err);
                alert('Ocorreu um erro ao processar o pagamento.');
            }
        }).render('#paypal-button-container'); // Renderiza o botão
    </script>
@endpush
