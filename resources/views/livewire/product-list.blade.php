<div class="hs-bg-card hs-p-4 hs-px-9 hs-rounded-3 mb-3">
    <h3>Products</h3>
    <div class="grid grid-cols-4 gap-8 ">
        @foreach ($products as $product)
            <a href="{{ route('products.show', $product->id) }}">
                <div class="group transition-all duration-300 ease-in-out transform-gpu hover:-translate-y-1"
                    style="width: 240px;">
                    <div class="overflow-hidden hs-rounded-3 shadow-sm">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('/imgs/users/no-image.png') }}"
                            alt="" width="240px"
                            class="hs-rounded-3 object-cover transition-all duration-200 ease-in-out transform-gpu group-hover:scale-105"
                            style="height: 180px">
                    </div>
                    <div class="hs-d-flex hs-justify-content-between mt-2 group-hover:text-primary">
                        <span class="transition-colors duration-300"
                            style="max-width: 150px">{{ $product->name }}</span>
                        <span class="transition-colors duration-300">{{ $product->price }}€</span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    <div class="hs-d-flex  hs-align-items-center hs-justify-content-center hs-w-100">
        {{ $products->links() }}
    </div>
</div>
