<div>
    <form action="{{ route('products.update', $product) }}" method="POST">
        @method('PUT')
        @csrf
    <label for="name">Name</label>
    <input type="text" name="name" value="{{ $product->name }}">

    <label for="description">Description</label>
    <input type="text" name="description" value="{{ $product->description }}">
    <label for="price">Price</label>
    <input type="text" name="price" value="{{ $product->price }}">
    <select name="category_id">
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ $category->id == $product->category_id ? 'selected' : '' }}>
                {{ $category->name }}</option>
        @endforeach
    </select>
    <button type="submit">Save</button>
    </form>
</div>
