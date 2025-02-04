<main class="hs-d-flex hs-flex-grow-1 hs-mt-8 hs-px-9 hs-justify-content-center hs-mb-5">
    <style>
        /* Scrollbar para navegadores WebKit (Chrome, Safari, Edge) */
        .scroll-container::-webkit-scrollbar {
            width: 8px;
            /* Largura da scrollbar */
        }

        .scroll-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            /* Cor do fundo */
            border-radius: 10px;
        }

        .scroll-container::-webkit-scrollbar-thumb {
            background: #888;
            /* Cor da barra */
            border-radius: 10px;
        }

        .scroll-container::-webkit-scrollbar-thumb:hover {
            background: #555;
            /* Cor ao passar o mouse */
        }
    </style>
    <div class="hs-w-80 hs-bg-card hs-p-5 hs-rounded-3 hs-d-flex hs-flex-row hs-justify-content-between">
        <div class="scroll-container hs-w-70 hs-pe-2" style="max-height: 580px; overflow-y: scroll;">
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
            <div class="hs-d-flex hs-flex-row hs-align-items-center">
                @if (auth()->user()->paymentMethods->count() == 0)
                    <div>
                        <p>Please add a Payment Method</p>
                        <a href="{{ route('payment-methods') }}" class="hs-btn hs-btn-primary">Add Payment Method</a>
                    </div>
                @else
                    <div
                        class="w-[240px] h-[94px] hs-rounded-3 hs-m-3 flex flex-col justify-around place-self-center bg-[#EEEEEE] hs-cursor-pointer hs-card-selected ">

                        <div class="flex flex-row items-center w-full">
                            <div class="hs-col-md-5 px-2">
                                <div
                                    class="w-[90px] h-[55px] bg-gradient-to-r from-orange-500 to-orange-700 text-white p-2 rounded shadow-lg flex flex-col justify-between">
                                    <span class="text-[5px] uppercase">{{ $selectedCard->name }}</span>
                                    <img class="w-[15px] h-auto" src="{{ asset('/imgs/pages/creditCardChip.png') }}"
                                        alt="creditCardChip" />
                                    <div class="text-[5px]">
                                        <span>**** **** **** {{ $selectedCard->last4 }}</span>
                                    </div>
                                    <div class="flex justify-between text-[5px]">
                                        <span class="content-center">**/**</span>
                                        <img class="w-[15px] h-auto"
                                            src="{{ asset($selectedCard->type->img) ?? null }}"
                                            alt="{{ $selectedCard->type->name }}Logo">
                                    </div>
                                </div>
                            </div>

                            <div class="hs-col-md-7 px-2">
                                <p class="m-0 text-sm">{{ $selectedCard->identifier ?? 'Card' }}</p>
                                <p class="m-0 text-xs">Card ending in {{ $selectedCard->last4 }}</p>
                            </div>
                        </div>

                        @if ($selectedCard->predefined == 1)
                            <div class="hs-row w-full px-2 pb-1">
                                <span class="text-xs font-bold">Predefined Payment Method <i
                                        class="bi bi-check"></i></span>
                            </div>
                        @endif
                    </div>
                    <div x-data="{ open: false }">
                        <!-- Botão para abrir o modal -->
                        <a class="hs-btn hs-btn-primary h-10 mt-1" @click="open = true">
                            Choose another payment method
                        </a>

                        <!-- Modal -->
                        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 ">
                            <div class="bg-white rounded-lg shadow-lg p-6 w-96 relative" @click.away="open = false">
                                <h2 class="text-xl font-semibold mb-4">Choose a Payment Method</h2>

                                <!-- Lista de cartões não predefined -->

                                @foreach (auth()->user()->paymentMethods->where('predefined', 0) as $card)
                                    <div class="w-[240px] h-[94px] hs-rounded-3 hs-m-3 flex flex-col justify-around place-self-center bg-[#EEEEEE] hs-cursor-pointer hs-card-selected "
                                        @click="{{ $selectedCard = $card }}">

                                        <div class="flex flex-row items-center w-full">
                                            <div class="hs-col-md-5 px-2">
                                                <div
                                                    class="w-[90px] h-[55px] bg-gradient-to-r from-orange-500 to-orange-700 text-white p-2 rounded shadow-lg flex flex-col justify-between">
                                                    <span class="text-[5px] uppercase">{{ $card->name }}</span>
                                                    <img class="w-[15px] h-auto"
                                                        src="{{ asset('/imgs/pages/creditCardChip.png') }}"
                                                        alt="creditCardChip" />
                                                    <div class="text-[5px]">
                                                        <span>**** **** **** {{ $card->last4 }}</span>
                                                    </div>
                                                    <div class="flex justify-between text-[5px]">
                                                        <span class="content-center">**/**</span>
                                                        <img class="w-[15px] h-auto"
                                                            src="{{ asset($card->type->img) ?? null }}"
                                                            alt="{{ $card->type->name }}Logo">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="hs-col-md-7 px-2">
                                                <p class="m-0 text-sm">{{ $card->identifier ?? 'Card' }}</p>
                                                <p class="m-0 text-xs">Card ending in {{ $card->last4 }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                                <!-- Botão para fechar o modal -->
                                <button class="mt-4 hs-btn hs-btn-secondary" @click="open = false">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <hr>
            @if ($billingInformation)
            <div class="hs-d-flex hs-flex-column">
                    <h6>Billing Information</h6>
                    <div class="hs-d-flex hs-flex-row">
                        <p class="hs-col-4">Name: {{ $billingInformation->name }}</p>
                        <p>Nif: {{ $billingInformation->nif ?? 'none' }}</p>
                    </div>
                    <div class="hs-d-flex hs-flex-row">
                        <p class="hs-col-4">Email: {{ $billingInformation->email }}</p>
                        <p>Phone: {{ $billingInformation->phone ?? 'none' }}</p>
                    </div>
                    @if ($billingInformation->address)
                        <h6>Address</h6>
                        <div class="hs-d-flex hs-flex-row">
                            <p class="hs-col-4">Country: {{ $billingInformation->address->country }}</p>
                            <p>Street: {{ $billingInformation->address->street }}</p>
                        </div>
                        <div class="hs-d-flex hs-flex-row">
                            <p class="hs-col-4">City: {{ $billingInformation->address->city }}</p>
                            <p>Zipcode: {{ $billingInformation->address->zipcode }}</p>
                        </div>
                    @endif
                </div>
                <hr>
                @endif
            <div class="hs-d-flex hs-flex-column">
                <h6>Address</h6>
                    <div class="hs-d-flex hs-flex-row">
                        <p class="hs-col-4">Country: {{ $address->country }} </p>
                        <p>City: {{ $address->city }}</p>
                    </div>
                    <div class="hs-d-flex hs-flex-row">
                        <p class="hs-col-4">Street: {{ $address->street }}</p>
                        <p>Zipcode: {{ $address->zipcode }}</p>
                    </div>
            </div>
        </div>
        <div>
            <div><a href="" class="hs-btn hs-btn-primary hs-w-100">Buy</a></div>
            <div id="paypal-button-container"></div>
        </div>
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

</main>
