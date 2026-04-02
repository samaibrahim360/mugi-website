@extends('layouts.app')

@section('title', 'My Wishlist - Mugi')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<style>
    .font-serif {
        font-family: 'Abril Fatface', cursive;
    }

    .font-inter {
        font-family: 'Inter', sans-serif;
    }

    .bg-main {
        background-color: #F4F1EA;
    }

    .bg-card-beige {
        background-color: #FFF9F3;
    }

    .text-retro-green {
        color: #588157;
    }

    .bg-accent-green {
        background-color: #588157;
    }

    .bg-accent-pink {
        background-color: #FBB6CE;
    }

    .bg-accent-blue {
        background-color: #A3C1D4;
    }
</style>

<div class="bg-main min-h-screen p-4 md:p-8 font-inter">
    <div class="max-w-6xl mx-auto border-[1.5px] border-retro-green/10 rounded-[40px] p-6 md:p-10">

        <div class="flex flex-col md:flex-row justify-between items-center md:items-end mb-12 gap-6 text-center md:text-left">
            <div>
                <h1 class="text-6xl md:text-8xl text-retro-green font-serif italic">Wishlist</h1>
                <p class="text-retro-green/60 mt-2">
                    @if($wishlistItems->count() > 0)
                    You have {{ $wishlistItems->count() }} items saved for later
                    @else
                    Your wishlist is currently empty
                    @endif
                </p>
            </div>
            @if($wishlistItems->count() > 0)
            <a href="/cart" class="text-retro-green font-bold border-b-2 border-retro-green/20 pb-1 hover:border-retro-green transition">
                Go to cart
            </a>
            @endif
        </div>

        @if($wishlistItems->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
            $bgStyles = ['bg-card-beige', 'bg-accent-blue/30', 'bg-accent-pink/30'];
            @endphp

            @foreach($wishlistItems as $index => $item)
            <div class="group" data-id="{{ $item->id }}">
                <div class="{{ $bgStyles[$index % 3] }} rounded-[40px] p-8 relative flex flex-col items-center justify-center h-[350px] transition-transform hover:-translate-y-2 duration-300">

                    <button onclick="removeFromWishlist({{ $item->id }})" class="absolute top-6 right-6 text-retro-green text-xl opacity-40 hover:opacity-100 transition-opacity">
                        ✕
                    </button>

                    @if($item->product->image)
                    <img src="{{ asset('storage/' . $item->product->image) }}" class="max-h-48 drop-shadow-2xl object-contain" alt="{{ $item->product->name }}">
                    @else
                    <img src="https://via.placeholder.com/300" class="max-h-48 opacity-20" alt="No image">
                    @endif

                    <button onclick="addToCart({{ $item->product->id }})" class="absolute bottom-6 bg-accent-green text-white px-8 py-3 rounded-full font-bold opacity-0 group-hover:opacity-100 transition-opacity shadow-lg">
                        Move to Cart
                    </button>
                </div>

                <div class="mt-4 flex justify-between items-start px-2">
                    <div>
                        <a href="/product/{{ $item->product->id }}" class="hover:opacity-70 transition">
                            <h3 class="text-xl font-serif text-retro-green">{{ $item->product->name }}</h3>
                        </a>
                        <p class="text-retro-green/60 text-sm italic">{{ Str::limit($item->product->description, 35) }}</p>
                    </div>
                    <span class="text-2xl font-serif text-retro-green">${{ $item->product->price }}</span>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="py-20 text-center">
            <h3 class="text-3xl font-serif text-retro-green/40">No items found</h3>
            <p class="text-retro-green/60 mt-2">Start adding objects you love to see them here.</p>
        </div>
        @endif

        <div class="mt-20 text-center">
            <p class="text-retro-green/40 text-sm italic">Items stay in your wishlist for 30 days</p>
            <div class="mt-8 flex justify-center space-x-4">
                <a href="/products" class="bg-accent-pink text-retro-green px-10 py-4 rounded-full font-bold hover:brightness-105 transition no-underline">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    function updateCartCount() {
        fetch('/cart/count', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            const countElement = document.getElementById('cart-count');
            if (countElement) {
                if (data.count > 0) {
                    countElement.textContent = data.count;
                    countElement.style.display = 'flex';
                } else {
                    countElement.style.display = 'none';
                }
            }
        })
        .catch(error => console.error('Error updating cart count:', error));
    }

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
                showToast('Product moved to cart!', 'success', 'Moved!');
                location.reload();
            } else {
                showToast(data.message || 'Error adding to cart', 'error', 'Failed');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Error adding to cart', 'error', 'Oops!');
        });
    }

    function removeFromWishlist(wishlistId) {
        if (confirm('Remove from wishlist?')) {
            fetch(`/wishlist/${wishlistId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const itemElement = document.querySelector(`.group[data-id="${wishlistId}"]`);
                    if (itemElement) {
                        itemElement.remove();
                    }
                    showToast('Removed from wishlist', 'success', 'Removed!');
                    
                    const remainingItems = document.querySelectorAll('.group');
                    if (remainingItems.length === 0) {
                        location.reload();
                    }
                } else {
                    showToast(data.message || 'Failed to remove', 'error', 'Error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error removing from wishlist', 'error', 'Oops!');
            });
        }
    }
</script>
@endsection