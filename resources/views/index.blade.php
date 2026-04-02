@extends('layouts.app')

@section('title', 'Mugi - Create Your Happy Moment')

@section('content')

<section class="hero">
    <div class="hero-blob"></div>
    <div class="hero-container">
        <div class="hero-title-container">
            <h1 class="hero-title">
                Bright <br>
                <span>Mug</span> <br>
                Mood

            </h1>

            <p class="hero-subtitle"> Bright colors, cozy drinks, and happy moments </p>

            <a href="/products" class="btn-explore">Explore Mugs</a>
        </div>

        <div class="hero-image-wrapper">
            <img src="https://i.pinimg.com/736x/52/43/85/5243855e3ce8ee59f171b5f8f70fe4fd.jpg" alt="Creative Hobby Kit" class="hero-main-img">
            <div class="image-accent"></div>
        </div>
    </div>
</section>

<style>
    /* Layout Styles */
    .hero-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
        gap: 50px;
    }

    .hero-title-container {
        flex: 1;
        z-index: 2;
    }

    .hero-image-wrapper {
        flex: 1;
        position: relative;
        display: flex;
        justify-content: center;
        z-index: 2;
    }

    .hero-main-img {
        width: 100%;
        max-width: 500px;
        height: auto;
        border-radius: 40px 100px 40px 100px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        object-fit: cover;
        animation: float 6s ease-in-out infinite;
    }

    .image-accent {
        position: absolute;
        width: 110%;
        height: 110%;
        background: #fdf5e6;
        z-index: -1;
        border-radius: 50%;
        filter: blur(40px);
        opacity: 0.6;
    }

    .btn-explore {
        display: inline-block;
        padding: 15px 45px;
        border: 2px solid var(--olive-dark);
        color: var(--olive-dark);
        text-decoration: none;
        font-family: 'Cherry Bomb One', cursive;
        border-radius: 50px;
        font-size: 1.2rem;
        transition: 0.3s;
        background: transparent;
    }

    .btn-explore:hover {
        background: var(--olive-dark);
        color: white;
        transform: scale(1.05);
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
    }

    @media (max-width: 768px) {
        .hero-container {
            flex-direction: column;
            text-align: center;
        }
        .hero-main-img {
            max-width: 80%;
        }
    }
</style>

<section class="how-it-works">
    <h2 class="how-header">How It Works</h2>
    <div class="step-wrapper">
        <div class="step-item">
            <div class="step-pill">1. Choose Mug</div>
            <p class="step-text">Pick your favorite Mug from our hand-picked collection.</p>
        </div>
        <div class="step-item">
            <div class="step-pill">2. Delivery</div>
            <p class="step-text">We ship everything you need directly to your home.</p>
        </div>
        <div class="step-item">
            <div class="step-pill">3. Enjoy</div>
            <p class="step-text">Unbox and enjoy the tactile experience of making.</p>
        </div>
    </div>
</section>

<section class="featured-kits">
    <div class="slider-header">
        <h2>Featured Mugs</h2>
    </div>

    <div class="slider-viewport">
        <div class="slider-track" id="sliderTrack">
            @foreach($featuredProducts as $product)
            <div class="product-card">
                <div class="card-visuals">
                    <button class="fav-btn" onclick="addToWishlist({{ $product->id }})"><i class="far fa-heart"></i></button>

                    @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    @else
                    <img src="https://via.placeholder.com/400" alt="{{ $product->name }}">
                    @endif

                    <button class="cart-icon-btn" onclick="addToCart({{ $product->id }})">🛒</button>
                </div>

                <div class="card-details">
                    <a href="/product/{{ $product->id }}" style="text-decoration: none; color: inherit;">
                        <h3>{{ $product->name }} <span class="price-tag">{{ $product->price }}$</span></h3>
                    </a>
                    <p style="font-size: 0.8rem; color: #888;">{{ Str::limit($product->description, 50) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="slider-footer">
        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>
        <a href="/products" class="show-more-btn">Show more</a>
    </div>
</section>

<div class="container catalog">
    <h2 class="catalog-header">Categories</h2>

    <div class="grid">
        @foreach($categories as $category)
        <div class="product-card">
            <div class="img-frame">
                @if($category->image)
                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">
                @else
                @if($category->products->first() && $category->products->first()->image)
                <img src="{{ asset('storage/' . $category->products->first()->image) }}" alt="{{ $category->name }}">
                @else
                <img src="https://via.placeholder.com/300x300?text={{ urlencode($category->name) }}" alt="{{ $category->name }}">
                @endif
                @endif
            </div>

            <h3>{{ strtoupper($category->name) }}</h3>
            <p>Explore our {{ $category->name }} collection</p>

            <a href="/products?category={{ $category->id }}" class="btn-select">SELECT</a>
        </div>
        @endforeach
    </div>
</div>

<section class="testimonials">
    <h2 class="testimonials-header">WHAT OUR CUSTOMERS SAY </h2>
    
    <div id="testimonialFormContainer" style="display: none; max-width: 600px; margin: 0 auto 60px;">
        <div style="background: white; padding: 30px; border-radius: 30px; position: relative;">
            <button id="closeFormBtn" style="position: absolute; top: 15px; right: 20px; background: none; border: none; font-size: 24px; cursor: pointer; color: #888;">✕</button>

            <h3 style="font-family: 'Cherry Bomb One'; color: var(--olive-dark); text-align: center; margin-bottom: 20px;">
                Share Your Experience
            </h3>

            <form id="testimonialForm">
                @csrf
                <div style="margin-bottom: 15px;">
                    <input type="text" name="name" id="testimonialName" placeholder="Your Name" required
                        style="width: 100%; padding: 12px; border: 2px solid var(--soft-pink); border-radius: 50px;">
                </div>

                <div style="margin-bottom: 15px;">
                    <input type="email" name="email" id="testimonialEmail" placeholder="Your Email (optional)"
                        style="width: 100%; padding: 12px; border: 2px solid var(--soft-pink); border-radius: 50px;">
                </div>

                <div style="margin-bottom: 15px;">
                    <div id="ratingStars" style="display: flex; gap: 5px; margin-bottom: 10px; justify-content: center;">
                        <span data-rating="1" class="star">★</span>
                        <span data-rating="2" class="star">★</span>
                        <span data-rating="3" class="star">★</span>
                        <span data-rating="4" class="star">★</span>
                        <span data-rating="5" class="star">★</span>
                    </div>
                    <input type="hidden" name="rating" id="ratingValue" value="5">
                </div>

                <div style="margin-bottom: 20px;">
                    <textarea name="message" id="testimonialMessage" placeholder="Share your experience..." rows="4" required
                        style="width: 100%; padding: 12px; border: 2px solid var(--soft-pink); border-radius: 20px;"></textarea>
                </div>

                <button type="submit" style="width: 100%; padding: 12px; background: var(--olive-dark); color: white; border: none; border-radius: 50px; font-weight: bold; cursor: pointer;">
                    Submit Review
                </button>
            </form>
        </div>
    </div>

    <div id="testimonialsContainer" class="testimonial-track">
        @foreach($testimonials as $testimonial)
        <div class="testimonial-card">
            <div class="quote-icon">“</div>
            <div class="stars" style="margin-bottom: 10px;">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= $testimonial->rating)
                    <span style="color: #FFD700;">★</span>
                    @else
                    <span style="color: #ddd;">★</span>
                    @endif
                @endfor
            </div>
            <p class="testimonial-text">{{ $testimonial->message }}</p>
            <div class="user-info">
                @if($testimonial->avatar)
                <img src="{{ $testimonial->avatar }}" class="user-img" alt="{{ $testimonial->name }}">
                @else
                <img src="https://i.pravatar.cc/100?u={{ $testimonial->id }}" class="user-img" alt="{{ $testimonial->name }}">
                @endif
                <div>
                    <div class="user-name">{{ $testimonial->name }}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div style="text-align: center; margin-top: 60px;">
        <button id="openFormBtn" class="show-more-btn" style="background: var(--olive-dark); font-size: 1.1rem;">
            Share Your Experience
        </button>
    </div>
</section>

<style>
    .hero {
        position: relative;
        padding: 80px 5%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        min-height: 80vh;
    }

    .hero-blob {
        position: absolute;
        right: -10%;
        top: 0;
        width: 60%;
        height: 100%;
        background-color: var(--olive);
        border-radius: 50% 20% 60% 30% / 30% 40% 70% 50%;
        opacity: 0.4;
        z-index: -1;
    }

    .hero-title-container {
        max-width: 900px;
        z-index: 2;
    }

    .hero-title {
        font-family: 'Abril Fatface', cursive;
        font-size: 6rem;
        line-height: 0.9;
        color: var(--dark);
        text-transform: uppercase;
        position: relative;
    }

    .hero-title span {
        color: var(--soft-pink);
        position: relative;
    }

    .hero-subtitle {
        font-size: 1.1rem;
        margin: 30px 0;
        max-width: 500px;
        line-height: 1.6;
        opacity: 0.8;
    }

    .how-it-works {
        padding: 40px 5%;
        max-width: 1200px;
        margin: 0 auto;
        overflow: hidden;
    }

    .how-header {
        font-family: 'Cherry Bomb One', cursive;
        color: var(--olive-dark);
        font-size: 2.5rem;
        text-align: left;
        margin-bottom: 40px;
    }

    .step-wrapper {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        position: relative;
        padding-top: 20px;
    }

    .step-item {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        position: relative;
    }

    .step-pill {
        padding: 12px 25px;
        border-radius: 50px;
        font-family: 'Cherry Bomb One', cursive;
        font-size: 1.2rem;
        margin-bottom: 15px;
        width: 100%;
        z-index: 2;
        transition: transform 0.3s ease;
    }

    .step-item:nth-child(1) .step-pill {
        background-color: var(--olive);
        color: white;
    }

    .step-item:nth-child(2) .step-pill {
        border: 3px solid var(--soft-pink);
        color: var(--soft-pink);
        background: white;
    }

    .step-item:nth-child(3) .step-pill {
        background-color: var(--soft-pink);
        color: white;
    }

    .step-text {
        font-size: 0.85rem;
        line-height: 1.4;
        opacity: 0.8;
        max-width: 200px;
    }

    .featured-kits {
        padding: 80px 5%;
        background-color: var(--bg-cream);
        font-family: 'Poppins', sans-serif;
    }

    .slider-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto 30px;
    }

    .slider-header h2 {
        font-family: 'Cherry Bomb One', cursive;
        font-size: 2.5rem;
        color: var(--olive-dark);
        font-style: italic;
    }

    .slider-viewport {
        overflow: hidden;
        max-width: 1200px;
        margin: 0 auto;
    }

    .slider-track {
        display: flex;
        gap: 20px;
        transition: transform 0.5s ease-in-out;
    }

    .product-card {
        min-width: calc((100% - 40px) / 3);
        background: white;
        border-radius: 20px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .card-visuals {
        height: 280px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin: 0;
    }

    .card-visuals img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
        border-radius: 35px;
    }

    .fav-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        background: white;
        color: var(--olive-dark);
        border: none;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .cart-icon-btn {
        position: absolute;
        bottom: 15px;
        right: 15px;
        background: white;
        color: var(--olive-dark);
        border: none;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        cursor: pointer;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card-details {
        padding: 15px 20px 20px;
    }

    .card-details h3 {
        font-size: 1.1rem;
        color: var(--dark);
        margin-bottom: 5px;
    }

    .card-details .price-tag {
        font-weight: bold;
        color: var(--dark);
    }

    .slider-footer {
        max-width: 1200px;
        margin: 40px auto 0;
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .progress-container {
        flex-grow: 1;
        height: 4px;
        background: #e0e0e0;
        border-radius: 10px;
        position: relative;
    }

    .progress-bar {
        position: absolute;
        height: 100%;
        width: 33%;
        background: var(--soft-pink);
        border-radius: 10px;
        transition: width 0.3s ease;
    }

    .show-more-btn {
        background: var(--soft-pink);
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 50px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }

    .catalog {
        padding: 80px 5%;
        background-color: transparent;
    }

    .catalog-header {
        font-family: 'Cherry Bomb One', cursive;
        color: var(--soft-pink);
        font-size: 3rem;
        margin-bottom: 40px;
        text-align: left;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 40px;
    }

    .product-card {
        background: transparent;
        transition: transform 0.3s ease;
    }

    .product-card:hover {
        transform: translateY(-10px);
    }

    .img-frame {
        position: relative;
        border: 3px solid var(--soft-pink);
        border-radius: 40px;
        padding: 12px;
        background: var(--white);
        margin-bottom: 20px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
    }

    .img-frame img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 30px;
        display: block;
    }

    .product-card h3 {
        color: var(--olive-dark);
        font-family: 'Cherry Bomb One', cursive;
        font-size: 1.5rem;
        margin-bottom: 8px;
    }

    .product-card p {
        color: var(--olive-dark);
        font-size: 1rem;
        opacity: 0.8;
        margin-bottom: 20px;
    }

    .btn-select {
        display: inline-block;
        width: 140px;
        padding: 12px;
        border: 2px solid var(--olive-dark);
        border-radius: 50px;
        text-align: center;
        color: var(--olive-dark);
        text-decoration: none;
        font-family: 'Cherry Bomb One', cursive;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .btn-select:hover {
        background: var(--soft-pink);
        color: white;
    }

    .testimonials {
        padding: 60px 5%;
        background-color: var(--bg-cream);
        overflow: hidden;
    }

    .testimonials-header {
        font-family: 'Cherry Bomb One', cursive;
        color: var(--olive-dark);
        font-size: 2.5rem;
        text-align: center;
        margin-bottom: 40px;
    }

    .testimonial-track {
        display: flex;
        gap: 30px;
        padding: 20px 0;
        overflow-x: auto;
        scrollbar-width: none;
    }

    .testimonial-track::-webkit-scrollbar {
        display: none;
    }

    .testimonial-card {
        min-width: 300px;
        padding: 30px;
        background: var(--white);
        border: 2px solid var(--soft-pink);
        position: relative;
        transition: transform 0.3s ease;
    }

    .testimonial-card:nth-child(1) {
        border-radius: 40% 60% 50% 50% / 60% 40% 60% 40%;
    }

    .testimonial-card:nth-child(2) {
        border-radius: 60% 40% 40% 60% / 40% 60% 40% 60%;
    }

    .testimonial-card:nth-child(3) {
        border-radius: 50% 50% 60% 40% / 50% 50% 40% 60%;
    }

    .testimonial-card:hover {
        transform: scale(1.05) rotate(2deg);
    }

    .quote-icon {
        font-size: 2rem;
        color: var(--hot-pink);
        font-family: 'Abril Fatface';
        line-height: 1;
    }

    .testimonial-text {
        font-size: 0.9rem;
        line-height: 1.5;
        margin: 15px 0;
        font-style: italic;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        border: 2px solid var(--hot-pink);
        object-fit: cover;
    }

    .user-name {
        font-family: 'Cherry Bomb One';
        font-size: 0.9rem;
        color: var(--dark);
    }

    .stars {
        color: #FFD700;
        font-size: 0.8rem;
    }

    .star {
        font-size: 24px;
        cursor: pointer;
        transition: transform 0.2s;
        color: #ddd;
    }

    .star:hover {
        transform: scale(1.2);
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 3.5rem;
        }

        .step-wrapper {
            flex-direction: column;
            align-items: center;
            gap: 30px;
        }

        .product-card {
            min-width: 85%;
        }
    }
</style>

<script>
    let currentSlide = 0;
    const track = document.getElementById('sliderTrack');
    const cards = document.querySelectorAll('.product-card');
    const totalCards = cards.length;
    const cardsPerView = 3;
    const progressBar = document.getElementById('progressBar');

    function updateSlider() {
        if (cards.length === 0) return;
        const cardWidth = cards[0].offsetWidth + 20;
        track.style.transform = `translateX(-${currentSlide * cardWidth}px)`;
        const progress = ((currentSlide + 1) / Math.ceil(totalCards / cardsPerView)) * 100;
        if (progressBar) progressBar.style.width = `${progress}%`;
    }

    function nextSlide() {
        const maxSlide = Math.ceil(totalCards / cardsPerView) - 1;
        if (currentSlide < maxSlide) {
            currentSlide++;
            updateSlider();
        }
    }

    setInterval(nextSlide, 5000);

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

    const openFormBtn = document.getElementById('openFormBtn');
    const formContainer = document.getElementById('testimonialFormContainer');
    const closeFormBtn = document.getElementById('closeFormBtn');

    if (openFormBtn && formContainer) {
        openFormBtn.addEventListener('click', () => {
            formContainer.style.display = 'block';
            formContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
    }

    if (closeFormBtn && formContainer) {
        closeFormBtn.addEventListener('click', () => {
            formContainer.style.display = 'none';
        });
    }

    document.addEventListener('click', function(event) {
        if (formContainer && formContainer.style.display === 'block') {
            if (!formContainer.contains(event.target) && event.target !== openFormBtn) {
                formContainer.style.display = 'none';
            }
        }
    });

    let selectedRating = 5;
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('ratingValue');

    if (stars.length) {
        stars.forEach(star => {
            star.addEventListener('click', function() {
                selectedRating = parseInt(this.dataset.rating);
                if (ratingInput) ratingInput.value = selectedRating;

                stars.forEach(s => {
                    if (parseInt(s.dataset.rating) <= selectedRating) {
                        s.style.color = '#FFD700';
                    } else {
                        s.style.color = '#ddd';
                    }
                });
            });
        });

        stars.forEach(s => {
            if (parseInt(s.dataset.rating) <= 5) {
                s.style.color = '#FFD700';
            }
        });
    }

    const testimonialForm = document.getElementById('testimonialForm');
    if (testimonialForm) {
        testimonialForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = {
                name: document.getElementById('testimonialName').value,
                email: document.getElementById('testimonialEmail').value,
                message: document.getElementById('testimonialMessage').value,
                rating: parseInt(document.getElementById('ratingValue').value)
            };

            try {
                const response = await fetch('/testimonials', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });

                const data = await response.json();

                if (data.success) {
                    showToast('Thank you for your review!', 'success', 'Review Submitted!');
                    testimonialForm.reset();
                    addTestimonialToDOM(data.testimonial);
                    if (formContainer) formContainer.style.display = 'none';

                    selectedRating = 5;
                    if (ratingInput) ratingInput.value = 5;
                    stars.forEach(s => {
                        if (parseInt(s.dataset.rating) <= 5) {
                            s.style.color = '#FFD700';
                        }
                    });
                } else {
                    showToast(data.message || 'Error submitting review', 'error', 'Failed');
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('Error submitting review. Please try again.', 'error', 'Oops!');
            }
        });
    }

    function addTestimonialToDOM(testimonial) {
        const container = document.getElementById('testimonialsContainer');
        if (!container) return;

        const newCard = document.createElement('div');
        newCard.className = 'testimonial-card';

        let starsHtml = '';
        for (let i = 1; i <= 5; i++) {
            if (i <= testimonial.rating) {
                starsHtml += '<span style="color: #FFD700;">★</span>';
            } else {
                starsHtml += '<span style="color: #ddd;">★</span>';
            }
        }

        newCard.innerHTML = `
            <div class="quote-icon">“</div>
            <div class="stars" style="margin-bottom: 10px;">${starsHtml}</div>
            <p class="testimonial-text">${testimonial.message}</p>
            <div class="user-info">
                <img src="${testimonial.avatar || 'https://i.pravatar.cc/100?u=' + Date.now()}" class="user-img">
                <div>
                    <div class="user-name">${testimonial.name}</div>
                </div>
            </div>
        `;

        container.insertBefore(newCard, container.firstChild);
    }

    async function loadMoreTestimonials() {
        try {
            const response = await fetch('/testimonials');
            const testimonials = await response.json();

            const container = document.getElementById('testimonialsContainer');
            if (!container) return;

            container.innerHTML = '';

            testimonials.forEach(testimonial => {
                let starsHtml = '';
                for (let i = 1; i <= 5; i++) {
                    if (i <= testimonial.rating) {
                        starsHtml += '<span style="color: #FFD700;">★</span>';
                    } else {
                        starsHtml += '<span style="color: #ddd;">★</span>';
                    }
                }

                const card = document.createElement('div');
                card.className = 'testimonial-card';
                card.innerHTML = `
                    <div class="quote-icon">“</div>
                    <div class="stars" style="margin-bottom: 10px;">${starsHtml}</div>
                    <p class="testimonial-text">${testimonial.message}</p>
                    <div class="user-info">
                        <img src="${testimonial.avatar || 'https://i.pravatar.cc/100?u=' + testimonial.id}" class="user-img">
                        <div>
                            <div class="user-name">${testimonial.name}</div>
                        </div>
                    </div>
                `;
                container.appendChild(card);
            });
        } catch (error) {
            console.error('Error loading testimonials:', error);
        }
    }
</script>
@endsection