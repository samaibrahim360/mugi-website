@extends('layouts.app')

@section('title', 'Your Cart - Mugi')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<style>
    body {
        background-color: #F4F1EA;
        font-family: 'Inter', sans-serif;
    }

    h1,
    h2,
    h3,
    .font-serif {
        font-family: 'Abril Fatface', cursive;
    }

    .bg-card {
        background-color: #FFF9F3;
    }

    .text-retro-red {
        color: #588157;
    }

    .bg-accent-red {
        background-color: #588157;
    }

    .bg-accent-pink {
        background-color: #F8B4B4;
    }

    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
</style>

<div class="min-h-screen p-4 md:p-8 max-w-7xl mx-auto">

    <h1 class="text-7xl md:text-8xl text-retro-red font-serif italic mb-12">Cart</h1>

    <div id="cart-container">
        @if($cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            <div class="lg:col-span-2">
                <div class="hidden md:grid grid-cols-4 text-retro-red font-bold px-8 mb-6 opacity-60 text-sm uppercase tracking-widest">
                    <div>Product</div>
                    <div class="text-center">Quantity</div>
                    <div class="text-center">Total</div>
                    <div class="text-right">Remove</div>
                </div>

                <div class="space-y-4" id="cart-items-list">
                    @php $grandTotal = 0; @endphp
                    @foreach($cartItems as $item)
                    @php
                    $itemTotal = $item->product->price * $item->quantity;
                    $grandTotal += $itemTotal;
                    @endphp
                    <div class="cart-item bg-card rounded-[35px] p-4 pr-8 flex flex-wrap md:flex-nowrap items-center justify-between transition-transform hover:scale-[1.01]" data-id="{{ $item->id }}">
                        <div class="flex items-center space-x-6 w-full md:w-1/4 mb-4 md:mb-0">
                            <div class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center shadow-sm overflow-hidden">
                                @if($item->product->image)
                                <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover" alt="{{ $item->product->name }}">
                                @else
                                <img src="https://via.placeholder.com/150" class="w-full h-full object-cover opacity-20" alt="No image">
                                @endif
                            </div>
                            <div>
                                <h3 class="text-xl font-serif text-retro-red">{{ $item->product->name }}</h3>
                                <p class="text-xs text-retro-red/60 leading-tight">Object Ref: #{{ $item->product->id }}</p>
                                <p class="text-sm text-retro-red font-bold">${{ number_format($item->product->price, 2) }}</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-center space-x-4 w-1/3 md:w-1/4">
                            <button onclick="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})" class="qty-btn w-6 h-6 bg-accent-red text-white rounded-full flex items-center justify-center text-sm hover:brightness-110">-</button>
                            <span class="item-qty text-retro-red font-bold px-2" data-id="{{ $item->id }}">{{ $item->quantity }}</span>
                            <button onclick="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})" class="qty-btn w-6 h-6 bg-accent-red text-white rounded-full flex items-center justify-center text-sm hover:brightness-110">+</button>
                        </div>

                        <div class="text-center w-1/3 md:w-1/4 text-2xl font-serif text-retro-red item-total" data-id="{{ $item->id }}">
                            ${{ number_format($itemTotal, 2) }}
                        </div>

                        <div class="w-1/3 md:w-1/4 flex justify-end">
                            <button onclick="removeFromCart({{ $item->id }})" class="remove-btn w-10 h-10 bg-white border border-retro-red/10 rounded-full flex items-center justify-center text-retro-red hover:bg-red-50 hover:text-red-500 transition-colors shadow-sm">
                                🗑
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-card rounded-[40px] p-8 h-fit shadow-sm border border-retro-red/5" id="order-summary">
                <h2 class="text-3xl font-serif text-retro-red text-center mb-8">Order Summary</h2>

                <div class="space-y-4 text-retro-red text-lg font-serif">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span id="subtotal">${{ number_format($grandTotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between opacity-60 text-base">
                        <span>Shipping</span>
                        <span>Free</span>
                    </div>
                </div>

                <div class="border-t border-retro-red/10 my-8 pt-6 flex justify-between items-baseline">
                    <span class="text-2xl font-serif text-retro-red">Total</span>
                    <span id="total" class="text-4xl font-serif text-retro-red">${{ number_format($grandTotal, 2) }}</span>
                </div>

                <p class="text-[11px] text-center text-retro-red/60 leading-tight mb-8 italic">
                    Secure checkout powered by HobbyKits.<br>All items are eligible for 30-day returns.
                </p>

                <a href="/checkout" class="block w-full bg-accent-red text-white text-center font-bold py-4 rounded-full text-lg hover:opacity-90 transition-all shadow-lg">
                    Proceed to Checkout
                </a>
            </div>
        </div>
        @else
        <div id="empty-cart" class="py-20 text-center bg-card rounded-[40px] border-2 border-dashed border-retro-red/10">
            <h3 class="text-4xl font-serif text-retro-red/40 italic">Your cart is empty</h3>
            <p class="text-retro-red/60 mt-4 mb-8">Ready to find something unique?</p>
            <a href="/products" class="bg-accent-red text-white px-10 py-4 rounded-full font-bold hover:brightness-110 transition shadow-md">Browse Collection</a>
        </div>
        @endif
    </div>

    <section class="mt-32">
        <h2 class="text-6xl font-serif text-retro-red italic mb-12">You might like</h2>

        <div class="flex overflow-x-auto pb-8 gap-8 no-scrollbar">
            @foreach($suggestedProducts as $product)
            <div class="min-w-[280px] flex-shrink-0 group">
                <a href="/product/{{ $product->id }}" class="block">
                    <div class="bg-white rounded-[35px] p-3 h-[280px] relative flex items-center justify-center transition-transform group-hover:-translate-y-2 shadow-sm border border-retro-red/5 overflow-hidden cursor-pointer">

                        <button onclick="event.preventDefault(); event.stopPropagation(); addToWishlist({{ $product->id }})"
                            class="absolute top-5 right-5 w-8 h-8 bg-white/80 backdrop-blur-sm rounded-full flex items-center justify-center text-retro-red z-10 cursor-pointer hover:bg-accent-pink hover:text-white transition-colors shadow-sm">
                            ♥
                        </button>

                        @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="rounded-[35px] w-full h-full object-cover" alt="{{ $product->name }}">
                        @else
                        <img src="https://via.placeholder.com/400" class="w-full h-full object-cover opacity-20" alt="No image">
                        @endif
                    </div>
                </a>

                <div class="mt-6 flex justify-between items-start px-2">
                    <div>
                        <a href="/product/{{ $product->id }}" class="hover:opacity-70 transition">
                            <h3 class="text-lg font-serif text-retro-red">{{ $product->name }} — ${{ number_format($product->price, 2) }}</h3>
                        </a>
                        <p class="text-retro-red/60 text-xs italic">{{ Str::limit($product->description, 35) }}</p>
                    </div>
                    <button onclick="addToCart({{ $product->id }})" class="w-10 h-10 bg-accent-red rounded-full flex items-center justify-center text-white shadow-md hover:scale-110 transition-transform">
                        🛒
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </section>
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

    function updateCartTotals() {
        let newSubtotal = 0;
        const items = document.querySelectorAll('.cart-item');

        items.forEach(item => {
            const priceText = item.querySelector('.text-retro-red.font-bold').textContent.replace('$', '');
            const price = parseFloat(priceText);
            const quantity = parseInt(item.querySelector('.item-qty').textContent);
            const total = price * quantity;
            newSubtotal += total;

            item.querySelector('.item-total').textContent = '$' + total.toFixed(2);
        });

        document.getElementById('subtotal').textContent = '$' + newSubtotal.toFixed(2);
        document.getElementById('total').textContent = '$' + newSubtotal.toFixed(2);
    }

    function updateQuantity(cartId, newQuantity) {
        if (newQuantity < 1) return;

        fetch(`/cart/${cartId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ quantity: newQuantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const qtyElement = document.querySelector(`.item-qty[data-id="${cartId}"]`);
                if (qtyElement) {
                    qtyElement.textContent = newQuantity;
                }
                updateCartTotals();
                updateCartCount();
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function removeFromCart(cartId) {
        if (!confirm('Remove this item from your cart?')) return;

        fetch(`/cart/${cartId}`, {
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
                const itemElement = document.querySelector(`.cart-item[data-id="${cartId}"]`);
                if (itemElement) {
                    itemElement.remove();
                }
                updateCartCount();

                const remainingItems = document.querySelectorAll('.cart-item');
                if (remainingItems.length === 0) {
                    const cartContainer = document.getElementById('cart-container');
                    if (cartContainer) {
                        cartContainer.innerHTML = `
                            <div class="py-20 text-center bg-card rounded-[40px] border-2 border-dashed border-retro-red/10">
                                <h3 class="text-4xl font-serif text-retro-red/40 italic">Your cart is empty</h3>
                                <p class="text-retro-red/60 mt-4 mb-8">Ready to find something unique?</p>
                                <a href="/products" class="bg-accent-red text-white px-10 py-4 rounded-full font-bold hover:brightness-110 transition shadow-md">Browse Collection</a>
                            </div>
                        `;
                    }
                } else {
                    updateCartTotals();
                }
                showToast('Item removed from cart', 'success', 'Removed!');
            } else {
                showToast(data.message || 'Failed to remove item', 'error', 'Error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Error removing from cart', 'error', 'Oops!');
        });
    }

    function addToCart(productId) {
        fetch('/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ product_id: productId, quantity: 1 })
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
            body: JSON.stringify({ product_id: productId })
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