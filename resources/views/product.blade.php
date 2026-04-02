@extends('layouts.app')

@section('title', 'Products - Mugi')

@section('content')
<style>
    /* --- HERO & FILTERS --- */
    .products-hero {
        text-align: center;
        padding: 100px 20px 40px;
    }

    .products-hero h1 {
        font-family: 'Abril Fatface', cursive;
        font-size: clamp(2.5rem, 6vw, 4rem);
        color: var(--olive-dark);
        line-height: 1.1;
        margin-bottom: 30px;
    }

    .search-bar-container {
        display: flex;
        justify-content: center;
        margin-bottom: 30px;
    }

    .search-bar-container input {
        width: 100%;
        max-width: 400px;
        padding: 15px 25px;
        border-radius: 50px;
        border: 1px solid #eee;
        background: #f9f9f9;
        outline: none;
        transition: 0.3s;
    }

    .search-bar-container input:focus {
        border-color: var(--soft-pink);
        background: white;
    }

    .filters {
        display: flex;
        justify-content: center;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 50px;
    }

    .filter-pill {
        padding: 10px 25px;
        border-radius: 50px;
        border: 1px solid #ddd;
        background: white;
        cursor: pointer;
        text-decoration: none;
        color: #555;
        font-size: 0.9rem;
        transition: 0.3s;
    }

    .filter-pill.active,
    .filter-pill:hover {
        background: var(--olive-dark);
        color: white;
        border-color: var(--olive-dark);
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 40px;
        padding: 0 5% 80px;
    }

    .product-card:hover {
        transform: translateY(-10px);
    }

    .product-card {
        background: white;
        border-radius: 35px;
        padding: 15px;
        overflow: hidden;
        transition: transform 0.4s ease;
        border: 1px solid #f0f0f0;
    }

    .card-image {
        position: relative;
        width: 100%;
        aspect-ratio: 1 / 1;
        overflow: hidden;
        background-color: #f9f9f9;
        border-radius: 35px;
    }

    .card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .wishlist-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        background: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        z-index: 10;
    }

    .card-info {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 20px 5px 10px;
    }

    .card-info .text-wrap {
        flex: 1;
    }

    .card-info h3 {
        margin: 0;
        font-size: 1.25rem;
        color: #333;
        font-family: 'Abril Fatface', serif;
    }

    .card-info p {
        margin: 5px 0 0;
        font-size: 0.9rem;
        color: #888;
        line-height: 1.4;
    }

    .add-btn {
        background: #333;
        color: white;
        border: none;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 1.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.3s;
        margin-left: 15px;
    }

    .add-btn:hover {
        background: var(--soft-pink);
        transform: rotate(15deg);
    }

    .pagination-wrapper {
        padding: 40px 0;
        display: flex;
        justify-content: center;
    }
</style>

<section class="products-hero">
    <h1>A collection of {{ $products->total() }}<br>unique Mugs</h1>

    <form action="/products" method="GET" class="search-bar-container">
        <input type="text" name="search" placeholder="Product search..." value="{{ request('search') }}">
    </form>

    <div class="filters">
        <a href="/products" class="filter-pill {{ !request('category') ? 'active' : '' }}">All</a>
        @foreach($categories as $category)
        <a href="/products?category={{ $category->id }}"
            class="filter-pill {{ request('category') == $category->id ? 'active' : '' }}">
            {{ $category->name }}
        </a>
        @endforeach
    </div>
</section>

<section class="product-grid">
    @forelse($products as $index => $product)
    <div class="product-card">
        <div class="card-image">
            @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            @else
            <img src="https://via.placeholder.com/300" alt="Placeholder">
            @endif

            @auth
            <button class="wishlist-btn" onclick="addToWishlist({{ $product->id }})"><i class="far fa-heart"></i></button>
            @endauth
        </div>

        <div class="card-info">
            <div class="text-wrap">
                <a href="/product/{{ $product->id }}" style="text-decoration: none; color: inherit;">
                    <h3>{{ $product->name }} ${{ $product->price }}</h3>
                </a>
                <p>{{ Str::limit($product->description, 60) }}</p>
            </div>

            @auth
            <button class="add-btn" onclick="addToCart({{ $product->id }})">🛒</button>
            @else
            <a href="/login" class="add-btn" style="text-decoration: none;">👤</a>
            @endauth
        </div>
    </div>
    @empty
    <div style="text-align: center; grid-column: 1/-1; padding: 100px 0;">
        <h3>No unique objects found.</h3>
        <p>Try a different search or category.</p>
    </div>
    @endforelse
</section>

<div class="pagination-wrapper">
    {{ $products->withQueryString()->links() }}
</div>

<script>
    function addToCart(productId) {
        fetch('/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: 1
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

    function addToWishlist(productId) {
        @auth
        fetch('/wishlist/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                product_id: productId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('Added to wishlist!', 'success', 'Saved!');
            } else {
                showToast(data.message || 'Already in wishlist!', 'error', 'Notice');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Error adding to wishlist', 'error', 'Oops!');
        });
        @else
        showToast('Please login to add items to wishlist', 'error', 'Login Required');
        setTimeout(() => {
            window.location.href = '/login';
        }, 1500);
        @endauth
    }
</script>
@endsection