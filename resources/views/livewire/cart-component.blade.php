<div x-data="{ open: false }" class="position-relative">
    <!-- Cart Icon that toggles dropdown -->
    <i class="bi bi-cart3" style="cursor:pointer;" wire:click="toggleCart"></i>

    <!-- Dropdown content -->
    @if ($showCart)

        <div @click.away="$wire.toggleCart()" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
            class="dropdown-menu show p-2 mt-2 bg-white hs-rounded-3"
            style="min-width: 300px; right: 0; left: -174px; top: 50px; position: absolute; ">
            @if (count($cartItems) > 0)
                @foreach ($cartItems as $productId => $item)
                    <div class="hs-w-100 hs-d-flex hs-justify-content-between hs-mx-2">
                        @if (isset($products[$productId]))
                            <div class="hs-d-flex hs-w-100 hs-gap-3 hs-px-3 hs-align-items-start">
                                <div class="hs-w-100">
                                    <div class="hs-d-flex hs-justify-content-between">
                                        <h6 class="hs-mb-1">{{ Str::limit($products[$productId]['name'], 15) }}</h6>
                                        <small class="hs-text-muted">{{ $item['quantity'] }}x</small>
                                    </div>
                                    <div class="hs-d-flex hs-justify-content-between hs-align-items-center">
                                        <small class="hs-text-muted">
                                            {{ number_format($products[$productId]['price'], 2, ',', '.') }}€
                                        </small>
                                        <strong>
                                            {{ number_format($products[$productId]['price'] * $item['quantity'], 2, ',', '.') }}€
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-warning small">
                                <i class="bi bi-exclamation-triangle"></i> Produto indisponível
                            </div>
                        @endif
                    </div>
                    @if (!$loop->last)
                        <hr class="hs-dropdown-divider hs-my-2">
                    @endif
                @endforeach

                <div class="d-flex justify-content-between mx-2">
                    <div class="mt-3 pt-2 border-top hs-w-100">
                        <div class="mb-2">
                            <span>Total:</span>
                            <span>
                                @php
                                    $total = 0;
                                    foreach ($cartItems as $productId => $item) {
                                        $productPrice = $products[$productId]['price'] ?? 0;
                                        $quantity = $item['quantity'] ?? 0;
                                        $total += $productPrice * $quantity;
                                    }
                                @endphp
                                {{ number_format($total, 2, ',', '.') }}€
                            </span>
                        </div>
                        <a href="{{ route('checkout',['isReservation' => false])}}" class="hs-btn hs-btn-primary hs-w-100 text-white">
                            Checkout
                        </a>
                    </div>
                </div>
            @else
                <div class="dropdown-item text-center py-3">
                    <i class="bi bi-cart-x fs-4 text-muted"></i>
                    <p class="mb-0 text-muted">Carrinho vazio</p>
                </div>
            @endif
        </div>
    @endif

</div>
