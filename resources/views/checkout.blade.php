@extends('layouts.app')

@section('title', 'Checkout - Mugi')

@section('content')
<style>
    .checkout-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 5%;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
    }

    .checkout-form h2 {
        font-family: 'Abril Fatface', cursive;
        font-size: 1.8rem;
        color: var(--olive-dark);
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid var(--soft-pink);
        border-radius: 10px;
        font-family: inherit;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .order-summary {
        background: white;
        padding: 30px;
        border-radius: 20px;
        height: fit-content;
        position: sticky;
        top: 100px;
    }

    .order-summary h2 {
        font-family: 'Abril Fatface', cursive;
        font-size: 1.5rem;
        margin-bottom: 20px;
    }

    .order-item {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }

    .place-order-btn {
        width: 100%;
        padding: 15px;
        background: var(--olive-dark);
        color: white;
        border: none;
        border-radius: 50px;
        font-size: 1rem;
        cursor: pointer;
        margin-top: 20px;
    }

    @media (max-width: 768px) {
        .checkout-container {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="checkout-container">
    <div class="checkout-form">
        <h2>Contact Information</h2>
        <form action="/checkout" method="POST" id="checkoutForm">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label>First Name *</label>
                    <input type="text" name="first_name" required>
                </div>
                <div class="form-group">
                    <label>Last Name *</label>
                    <input type="text" name="last_name" required>
                </div>
            </div>

            <div class="form-group">
                <label>Email Address *</label>
                <input type="email" name="email" value="{{ auth()->user()->email }}" required>
            </div>

            <div class="form-group">
                <label>Phone Number *</label>
                <input type="tel" name="phone" required>
            </div>

            <h2 style="margin-top: 30px;">Shipping Details</h2>

            <div class="form-group">
                <label>Address *</label>
                <input type="text" name="address" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>City *</label>
                    <input type="text" name="city" required>
                </div>
                <div class="form-group">
                    <label>Postal Code *</label>
                    <input type="text" name="postal_code" required>
                </div>
            </div>
        </form>
    </div>

    <div class="order-summary">
        <h2>Order Summary</h2>
        @foreach($cartItems as $item)
        <div class="order-item">
            <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
            <span>${{ $item->product->price * $item->quantity }}</span>
        </div>
        @endforeach

        <div class="order-item" style="font-weight: bold; font-size: 1.2rem; border-top: 2px solid #ddd; margin-top: 10px; padding-top: 15px;">
            <span>Total</span>
            <span>${{ $subtotal }}</span>
        </div>

        <button type="submit" form="checkoutForm" class="place-order-btn">Place Order</button>
        <p style="font-size: 0.8rem; text-align: center; margin-top: 15px; color: #888;">
            By placing your order, you agree to our Terms of Service and Privacy Policy
        </p>
    </div>
</div>
@endsection