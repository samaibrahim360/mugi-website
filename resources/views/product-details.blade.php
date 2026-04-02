@extends('layouts.app')

@section('title', $product->name . ' - Mugi')

@section('content')
<style>
    .product-detail-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 70px 5%;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
    }

    .product-gallery {
        background: white;
        border-radius: 40px;
        padding-right: 0px;
        padding-left: 0px;
        padding-top: 10px;
        padding-bottom: 10px;
        text-align: center;
    }

    .product-gallery img {
        max-width: 100%;
        max-height: 400px;
        object-fit: cover;
        border-radius: 40px;
    }

    .product-info-detail {
        background: white;
        padding: 30px;
        border-radius: 40px;
    }

    .product-info-detail h1 {
        font-family: 'Abril Fatface', cursive;
        font-size: 3rem;
        color: var(--olive-dark);
        margin-bottom: 10px;
    }

    .product-price-detail {
        font-size: 2.5rem;
        font-weight: bold;
        color: var(--olive-dark);
        margin: 20px 0;
    }

    .product-description {
        line-height: 1.6;
        margin: 20px 0;
        color: var(--dark);
    }

    .quantity-selector {
        display: flex;
        align-items: center;
        gap: 15px;
        margin: 30px 0;
    }

    .quantity-selector button {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: none;
        background: var(--soft-pink);
        cursor: pointer;
        font-size: 1.2rem;
    }

    .quantity-selector input {
        width: 60px;
        text-align: center;
        padding: 10px;
        border: 2px solid var(--soft-pink);
        border-radius: 10px;
    }

    .add-to-cart-btn {
        width: 100%;
        padding: 15px;
        background: var(--olive-dark);
        color: white;
        border: none;
        border-radius: 50px;
        font-size: 1.1rem;
        cursor: pointer;
        margin-top: 20px;
    }

    .related-products {
        margin-top: 100px;
        padding: 0 5%;
        margin-bottom: 100px;
    }

    .related-products h2 {
        font-family: 'Abril Fatface', cursive;
        font-size: 3rem;
        color: var(--olive-dark);
        margin-bottom: 40px;
        text-align: left;
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
    }

    .related-card {
        background: white;
        border-radius: 40px;
        padding: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        text-decoration: none;
        display: block;
        border: 1px solid rgba(0, 0, 0, 0.03);
    }

    .related-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
    }

    .related-card a {
        text-decoration: none;
        display: block;
    }

    .related-img-container {
        width: 100%;
        aspect-ratio: 1 / 1;
        overflow: hidden;
        border-radius: 30px;
        margin-bottom: 20px;
    }

    .related-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 35px;
        transition: transform 0.5s ease;
    }

    .related-card:hover img {
        transform: scale(1.1);
    }

    .related-card h3 {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 1.2rem;
        color: var(--olive-dark);
        margin: 10px 0 5px;
        padding: 0 10px;
    }

    .related-card .product-price {
        font-family: 'Abril Fatface', cursive;
        font-size: 1.5rem;
        color: var(--dark);
        padding: 0 10px 10px;
    }

    @media (max-width: 768px) {
        .product-detail-container {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="product-detail-container">
    <div class="product-gallery">
        @if($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
        @else
        <img src="https://via.placeholder.com/400" alt="{{ $product->name }}">
        @endif
    </div>

    <div class="product-info-detail">
        <h1>{{ $product->name }}</h1>
        <div class="product-price-detail">${{ $product->price }}</div>

        <div class="product-description">
            <p>{{ $product->description }}</p>
        </div>

        @if($product->stock > 0)
        <div style="color: green; margin: 10px 0;">In Stock: {{ $product->stock }} items</div>
        @else
        <div style="color: red; margin: 10px 0;">Out of Stock</div>
        @endif

        @auth
        <form action="/cart/add" method="POST" id="addToCartForm">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="quantity-selector">
                <button type="button" onclick="decrementQuantity()">-</button>
                <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}">
                <button type="button" onclick="incrementQuantity()">+</button>
            </div>
            <button type="submit" class="add-to-cart-btn" {{ $product->stock == 0 ? 'disabled' : '' }}>
                Add to Cart
            </button>
        </form>
        @else
        <a href="/login" class="add-to-cart-btn" style="display: block; text-align: center; text-decoration: none;">
            Login to Purchase
        </a>
        @endauth
    </div>
</div>

@if($relatedProducts->count() > 0)
<div class="related-products">
    <h2>You might also like</h2>
    <div class="related-grid">
        @foreach($relatedProducts as $related)
        <div class="related-card">
            <a href="/product/{{ $related->id }}">
                @if($related->image)
                <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}">
                @else
                <img src="https://via.placeholder.com/250" alt="{{ $related->name }}">
                @endif
                <h3>{{ $related->name }}</h3>
                <p class="product-price">${{ $related->price }}</p>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endif

<script>
    function addToCart(productId) {
        let quantity = document.getElementById('quantity').value;
        
        fetch('/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: parseInt(quantity)
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateCartCount();
                showToast('Product added to cart!', 'success', 'Added!');
            } else {
                showToast(data.message || 'Error adding to cart', 'error', 'Failed');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Error adding to cart', 'error', 'Oops!');
        });
    }

    function decrementQuantity() {
        let input = document.getElementById('quantity');
        if (input.value > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }

    function incrementQuantity() {
        let input = document.getElementById('quantity');
        let max = parseInt(input.getAttribute('max'));
        if (input.value < max) {
            input.value = parseInt(input.value) + 1;
        }
    }
</script>
@endsection