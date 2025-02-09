<x-custom-alert type="warning" :session="session('warning')" />
<x-custom-alert type="success" :session="session('success')" />
<x-custom-alert type="error" :session="session('error')" />
<div class="hs-mt-10 hs-flex-grow-1">
    <a href="{{route('products.index')}}" class="hs-bg-card hs-rounded-3 hs-py-1 hs-px-3" style="position: fixed;top: 145px;left: 350px;"><i class="bi bi-arrow-left"></i></a>
    <div class="hs-d-flex hs-flex-row justify-center">

        <!-- Coluna da Imagem -->
        <div class="hs-col-md-3 ">
            <div class=" hs-rounded hs-d-flex hs-justify-content-end hs-px-3">
                <img src="{{$product->image ? asset('storage/' . $product->image) : asset('/imgs/users/no-image.png') }}" alt="Nome do Produto" class="img-fluid hs-rounded"
                    style="max-height: 480px; object-fit: contain">
            </div>
        </div>

        <!-- Coluna de Informações -->
        <div class="hs-col-md-5 hs-p-5 hs- hs-bg-card hs-rounded hs-d-flex hs-flex-column hs-justify-content-between"
            style="max-height: 480px;">
            <div>
                <div class="hs-d-flex hs-align-items-center hs-flex-row mb-3">
                    <h3 class="me-3 mb-0">{{ $product->name }}</h3>
                    @if ($product->stock == 0)
                    <span class="!text-red-400">Out of stock</span>
                    @elseif ($product->stock <= 20)
                    <span class="!text-orange-400">Last units</span>
                    @else
                    <span class="!text-green-400">In stock</span>
                    @endif
                </div>
                <div class="product-details mt-4">
                    <h5>Product Details:</h5>
                    <ul class="list-unstyled">
                        <li><strong>Estate:</strong> {{ $product->estate->name }}</li>
                        <li><strong>Category:</strong> {{ $product->category->name }}</li>
                    </ul>
                </div>
                <div class="mb-4"
                    style="max-height: 110px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 10; -webkit-box-orient: vertical;">
                    <p class="text-muted">{{ $product->description }}
                    </p>
                </div>
            </div>

            <form action="" method="POST">
                @csrf

                <div class="quantity-selector hs-d-flex hs-flex-row hs-align-items-end justify-between">
                    <h3 class="text-primary m-0 me-3">{{ $product->price }}€</h3>
                    <div class="hs-d-flex hs-flex-row justify-end ">

                        <div class=" {{ $product->stock == 0 ? '!hidden' : ''}} hs-form-group hs-me-3 hs-m-0 hs-w-30">
                            <label for="quantity" class="form-label">Quantity:</label>
                            <livewire:NumberInput wire:model="quantity" class="form-control " :max="8" :name="'quantity'">
                        </div>
                        <div class="hs-align-self-end">
                            <button {{ $product->stock == 0 ? 'disabled' : ''}} wire:click="addToCart" type="button" class="hs-btn hs-btn-primary hs-mb-0 hs-h-50">
                                    <i class="bi bi-cart-plus me-2"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
