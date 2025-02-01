<div>
    @if (count($cartItems) > 0)
        @foreach ($cartItems as $productId => $item)
            <x-dropdown.item class="hs-justify-content-between hs-mx-2">
                <div class="hs-w-100">
                    @isset($products[$productId])
                        <div class="hs-d-flex gap-3 hs-align-items-start">
                            <div class="hs-w-100">
                                <div class="hs-d-flex hs-justify-content-between ">
                                    <h6 class="hs-mb-1">{{ Str::limit($products[$productId]->name, 15) }}</h6>
                                    <small class="hs-text-muted">{{ $item['quantity'] }}x</small>
                                </div>
                                <div class="hs-d-flex hs-justify-content-between hs-align-items-center">
                                    <small class="hs-text-muted">
                                        {{ number_format($products[$productId]->price, 2, ',', '.') }}€
                                    </small>
                                    <strong>
                                        {{ number_format($products[$productId]->price * $item['quantity'], 2, ',', '.') }}€
                                    </strong>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="hs-hs-text-warning hs-small">
                            <i class="bi bi-exclamation-triangle"></i> Produto indisponível
                        </div>
                    @endisset
                </div>
                @if (!$loop->last)
                    <hr class="hs-dropdown-divider hs-my-2">
                @endif
            </x-dropdown.item>
        @endforeach
        <x-dropdown.item class="hs-justify-content-between hs-mx-2">
            <div class="hs-mt-3 hs-pt-2 hs-border-top">
                <div class="hs-d-flex hs-justify-content-between hs-fw-bold hs-mb-2">
                    <span>Total:</span>
                    <span>
                        @php
                            $total = 0;
                            foreach ($cartItems as $productId => $item) {
                                $productPrice = $products[$productId]->price ?? 0;
                                $quantity = $item['quantity'] ?? 0;
                                $total += $productPrice * $quantity;
                            }
                        @endphp

                        {{ number_format($total, 2, ',', '.') }}€
                </div>
                <a href="" class="hs-btn hs-btn-primary hs-w-100">
                    Finalizar Compra
                </a>
            </div>
        @else
            <div class="hs-dropdown-item-text hs-text-center hs-py-3">
                <i class="bi bi-cart-x hs-fs-4 hs-text-muted"></i>
                <p class="hs-mb-0 hs-text-muted">Carrinho vazio</p>
            </div>
    @endif
    </x-dropdown.item>

</div>
