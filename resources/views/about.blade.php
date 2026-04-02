@extends('layouts.app')

@section('title', 'About Us - Mugi')

@section('content')
<style>
    :root {
        --bg-cream: #F4F1EA;
        --olive: #A3B18A;
        --olive-dark: #588157;
        --soft-pink: #FBB6CE;
        --dark: #333333;
        --white: #FFFFFF;
    }

    /* Hero Section */
    .about-hero {
        background: linear-gradient(135deg, var(--olive-dark) 0%, var(--olive) 100%);
        padding: 100px 5% 80px;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .about-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
        background-size: 50px 50px;
        animation: moveBackground 20s linear infinite;
        pointer-events: none;
    }

    @keyframes moveBackground {
        0% {
            transform: translate(0, 0);
        }
        100% {
            transform: translate(50px, 50px);
        }
    }

    .about-hero h1 {
        font-family: 'Abril Fatface', cursive;
        font-size: 4rem;
        margin-bottom: 20px;
        animation: fadeInUp 0.8s ease;
    }

    .about-hero p {
        font-size: 1.2rem;
        max-width: 600px;
        margin: 0 auto;
        opacity: 0.95;
        animation: fadeInUp 0.8s ease 0.2s backwards;
    }

    /* Story Section */
    .story-section {
        padding: 80px 5%;
        background: var(--white);
    }

    .story-grid {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
    }

    .story-content h2 {
        font-family: 'Abril Fatface', cursive;
        font-size: 2.5rem;
        color: var(--olive-dark);
        margin-bottom: 20px;
        position: relative;
    }

    .story-content h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 3px;
        background: var(--soft-pink);
        border-radius: 2px;
    }

    .story-content p {
        color: var(--dark);
        line-height: 1.8;
        margin-bottom: 20px;
        font-size: 1.05rem;
    }

    .story-image {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }

    .story-image img {
        width: 100%;
        height: auto;
        transition: transform 0.5s ease;
    }

    .story-image:hover img {
        transform: scale(1.05);
    }

    /* Values Section */
    .values-section {
        padding: 80px 5%;
        background: var(--bg-cream);
    }

    .section-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .section-header h2 {
        font-family: 'Abril Fatface', cursive;
        font-size: 2.5rem;
        color: var(--olive-dark);
        margin-bottom: 15px;
    }

    .section-header p {
        color: var(--dark);
        font-size: 1.1rem;
        opacity: 0.8;
    }

    .values-grid {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
    }

    .value-card {
        background: var(--white);
        padding: 40px 30px;
        border-radius: 20px;
        text-align: center;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        position: relative;
        overflow: hidden;
    }

    .value-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: var(--soft-pink);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .value-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }

    .value-card:hover::before {
        transform: scaleX(1);
    }

    .value-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--soft-pink) 0%, var(--hot-pink) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        font-size: 2rem;
        color: white;
    }

    .value-card h3 {
        font-size: 1.5rem;
        color: var(--olive-dark);
        margin-bottom: 15px;
    }

    .value-card p {
        color: var(--dark);
        line-height: 1.6;
        opacity: 0.8;
    }

    /* CTA Section */
    .cta-section {
        padding: 80px 5%;
        background: linear-gradient(135deg, var(--olive-dark) 0%, var(--olive) 100%);
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '♥';
        position: absolute;
        font-size: 200px;
        opacity: 0.05;
        bottom: -50px;
        right: -50px;
        font-family: 'Abril Fatface', cursive;
        pointer-events: none;
    }

    .cta-section h2 {
        font-family: 'Abril Fatface', cursive;
        font-size: 2.5rem;
        margin-bottom: 20px;
        position: relative;
    }

    .cta-section p {
        font-size: 1.1rem;
        margin-bottom: 30px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        opacity: 0.95;
    }

    .cta-button {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 30px;
        background: var(--white);
        color: var(--olive-dark);
        text-decoration: none;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .cta-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        color: var(--hot-pink);
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-up {
        animation: fadeInUp 0.8s ease forwards;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .about-hero h1 {
            font-size: 2.5rem;
        }
        
        .story-grid {
            grid-template-columns: 1fr;
            gap: 40px;
        }
        
        .story-content h2 {
            font-size: 2rem;
        }
        
        .section-header h2 {
            font-size: 2rem;
        }
        
        .team-image {
            width: 150px;
            height: 150px;
        }
    }
</style>

<!-- Hero Section -->
<section class="about-hero">
    <h1>Our Story</h1>
    <p>Creating beautiful moments, one mug at a time</p>
</section>

<!-- Story Section -->
<section class="story-section">
    <div class="story-grid">
        <div class="story-content fade-up">
            <h2>Every Mug Tells a Story</h2>
            <p>Mugi was born from a simple idea: that the vessel you drink from should bring you joy. Founded in 2024 by a group of design enthusiasts, we set out to create mugs that aren't just functional, but truly special.</p>
            <p>Our name "Mugi" comes from the Japanese word for "rye" - representing growth, warmth, and the simple pleasures in life. Each piece in our collection is thoughtfully designed to bring a moment of beauty to your daily routine.</p>
            <p>From our hands to yours, we pour love, creativity, and attention to detail into every mug. Because we believe that even the smallest moments deserve to be celebrated.</p>
        </div>
        <div class="story-image fade-up">
            <img src="https://i.pinimg.com/736x/61/c3/2d/61c32d26e1d432fd4777e6d7f358ca79.jpg" alt="Ceramic mugs collection">
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="values-section">
    <div class="section-header">
        <h2>What We Stand For</h2>
        <p>Our values guide everything we create</p>
    </div>
    <div class="values-grid">
        <div class="value-card fade-up">
            <div class="value-icon">
                <i class="fas fa-heart"></i>
            </div>
            <h3>Handcrafted with Love</h3>
            <p>Each piece is carefully crafted by skilled artisans who pour their heart into every detail.</p>
        </div>
        
        <div class="value-card fade-up">
            <div class="value-icon">
                <i class="fas fa-leaf"></i>
            </div>
            <h3>Sustainable Materials</h3>
            <p>We use eco-friendly materials and processes to minimize our environmental impact.</p>
        </div>
        
        <div class="value-card fade-up">
            <div class="value-icon">
                <i class="fas fa-palette"></i>
            </div>
            <h3>Unique Designs</h3>
            <p>Every design is original, inspired by art, nature, and the beauty of everyday life.</p>
        </div>
        
        <div class="value-card fade-up">
            <div class="value-icon">
                <i class="fas fa-smile"></i>
            </div>
            <h3>Customer Happiness</h3>
            <p>Your satisfaction is our priority. We're here to make your experience magical.</p>
        </div>
    </div>
</section>
<!-- CTA Section -->
<section class="cta-section">
    <h2>Join Our Journey</h2>
    <p>Be part of our story. Follow us on social media and get inspired by our latest creations, behind-the-scenes moments, and special offers.</p>
    <a href="/products" class="cta-button">
        <i class="fas fa-mug-hot"></i>
        Explore Our Collection
        <i class="fas fa-arrow-right"></i>
    </a>
</section>

<script>
    const fadeElements = document.querySelectorAll('.fade-up');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    
    fadeElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
        observer.observe(el);
    });
</script>
@endsection