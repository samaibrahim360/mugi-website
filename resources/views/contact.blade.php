@extends('layouts.app')

@section('title', 'Contact Us - Mugi')

@section('content')
<style>
    :root {
        --bg-cream: #F4F1EA;
        --olive: #A3B18A;
        --olive-dark: #588157;
        --soft-pink: #FBB6CE;
        --hot-pink: #EF4D8D;
        --dark: #333333;
        --white: #FFFFFF;
    }

    /* Hero Section */
    .contact-hero {
        background: linear-gradient(135deg, var(--olive-dark) 0%, var(--olive) 100%);
        padding: 80px 5% 60px;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .contact-hero::before {
        content: '☕';
        position: absolute;
        font-size: 150px;
        opacity: 0.05;
        bottom: -30px;
        left: -30px;
        transform: rotate(-15deg);
        pointer-events: none;
    }

    .contact-hero::after {
        content: '♥';
        position: absolute;
        font-size: 150px;
        opacity: 0.05;
        top: -30px;
        right: -30px;
        transform: rotate(15deg);
        pointer-events: none;
        font-family: 'Abril Fatface', cursive;
    }

    .contact-hero h1 {
        font-family: 'Abril Fatface', cursive;
        font-size: 3.5rem;
        margin-bottom: 15px;
        animation: fadeInUp 0.8s ease;
    }

    .contact-hero p {
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
        opacity: 0.95;
        animation: fadeInUp 0.8s ease 0.2s backwards;
    }

    /* Contact Section */
    .contact-section {
        padding: 80px 5%;
        background: var(--white);
    }

    .contact-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 50px;
    }

    /* Contact Info */
    .contact-info {
        background: linear-gradient(135deg, var(--bg-cream) 0%, var(--white) 100%);
        padding: 40px;
        border-radius: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .contact-info h2 {
        font-family: 'Abril Fatface', cursive;
        font-size: 2rem;
        color: var(--olive-dark);
        margin-bottom: 20px;
    }

    .contact-info>p {
        color: var(--dark);
        line-height: 1.6;
        margin-bottom: 40px;
        opacity: 0.8;
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 35px;
        transition: transform 0.3s ease;
    }

    .info-item:hover {
        transform: translateX(5px);
    }

    .info-icon {
        width: 55px;
        height: 55px;
        background: var(--soft-pink);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        color: var(--olive-dark);
        transition: all 0.3s ease;
    }

    .info-item:hover .info-icon {
        background: var(--hot-pink);
        color: white;
        transform: scale(1.1);
    }

    .info-content h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--olive-dark);
        margin-bottom: 5px;
    }

    .info-content p,
    .info-content a {
        color: var(--dark);
        text-decoration: none;
        transition: color 0.3s ease;
        line-height: 1.5;
    }

    .info-content a:hover {
        color: var(--hot-pink);
    }

    /* Social Links */
    .social-links {
        margin-top: 40px;
        padding-top: 30px;
        border-top: 2px solid var(--soft-pink);
    }

    .social-links h3 {
        font-size: 1rem;
        color: var(--olive-dark);
        margin-bottom: 20px;
    }

    .social-icons {
        display: flex;
        gap: 15px;
    }

    .social-icon {
        width: 45px;
        height: 45px;
        background: var(--bg-cream);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--olive-dark);
        text-decoration: none;
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }

    .social-icon:hover {
        background: var(--hot-pink);
        color: white;
        transform: translateY(-3px);
    }

    /* Contact Form */
    .contact-form-container {
        background: var(--white);
        padding: 40px;
        border-radius: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--soft-pink);
    }

    .contact-form-container h2 {
        font-family: 'Abril Fatface', cursive;
        font-size: 2rem;
        color: var(--olive-dark);
        margin-bottom: 10px;
    }

    .contact-form-container>p {
        color: var(--dark);
        margin-bottom: 30px;
        opacity: 0.7;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--olive-dark);
        font-size: 0.9rem;
    }

    .form-group label i {
        margin-right: 8px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid var(--bg-cream);
        border-radius: 12px;
        font-family: inherit;
        transition: all 0.3s ease;
        background: var(--bg-cream);
        font-size: 0.95rem;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--hot-pink);
        background: var(--white);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 120px;
    }

    .submit-btn {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, var(--olive-dark) 0%, var(--olive) 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(88, 129, 87, 0.3);
    }

    .submit-btn:active {
        transform: translateY(0);
    }

    /* Success Message */
    .success-message {
        background: linear-gradient(135deg, var(--olive-dark) 0%, var(--olive) 100%);
        color: white;
        padding: 15px 20px;
        border-radius: 12px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 12px;
        animation: slideInDown 0.5s ease;
    }

    .success-message i {
        font-size: 1.2rem;
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Error Message */
    .error-message {
        background: #f8d7da;
        color: #721c24;
        padding: 15px 20px;
        border-radius: 12px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 12px;
        border-left: 4px solid #dc3545;
    }

    .error-message i {
        font-size: 1.2rem;
    }

    .error-list {
        margin-top: 10px;
        margin-bottom: 0;
        padding-left: 20px;
    }

    .error-list li {
        margin-bottom: 5px;
    }

    /* Map Section */
    .map-section {
        padding: 0 5% 80px;
    }

    .map-container {
        max-width: 1200px;
        margin: 0 auto;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .map-container iframe {
        width: 100%;
        height: 400px;
        display: block;
    }

    /* FAQ Section */
    .faq-section {
        padding: 80px 5%;
        background: var(--bg-cream);
    }

    .faq-grid {
        max-width: 1000px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 30px;
    }

    .faq-item {
        background: var(--white);
        padding: 25px;
        border-radius: 20px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .faq-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .faq-question {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 600;
        color: var(--olive-dark);
        font-size: 1.1rem;
    }

    .faq-question i {
        transition: transform 0.3s ease;
        color: var(--hot-pink);
    }

    .faq-item.active .faq-question i {
        transform: rotate(180deg);
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
        color: var(--dark);
        line-height: 1.6;
        margin-top: 0;
    }

    .faq-item.active .faq-answer {
        max-height: 200px;
        margin-top: 15px;
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
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }

    .fade-up.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .contact-container {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .faq-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .contact-hero h1 {
            font-size: 2.5rem;
        }

        .contact-info,
        .contact-form-container {
            padding: 30px;
        }

        .info-item {
            margin-bottom: 25px;
        }

        .map-container iframe {
            height: 300px;
        }
    }
</style>

<!-- Hero Section -->
<section class="contact-hero">
    <h1>Get in Touch</h1>
    <p>We'd love to hear from you! Whether you have a question, feedback, or just want to say hello</p>
</section>

<!-- Contact Section -->
<section class="contact-section">
    <div class="contact-container">
        <!-- Contact Info -->
        <div class="contact-info fade-up">
            <h2>Let's Connect</h2>
            <p>We're here to help and answer any questions you might have. We look forward to hearing from you!</p>

            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="info-content">
                    <h3>Visit Us</h3>
                    <p>123 Creative Street<br>Art District, City 12345<br>United States</p>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <div class="info-content">
                    <h3>Call Us</h3>
                    <p><a href="tel:+1234567890">+1 (234) 567-890</a></p>
                    <p>Mon-Fri: 9am - 6pm EST</p>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="info-content">
                    <h3>Email Us</h3>
                    <p><a href="mailto:hello@mugi.com">hello@mugi.com</a></p>
                    <p><a href="mailto:support@mugi.com">support@mugi.com</a></p>
                </div>
            </div>

            <div class="social-links">
                <h3>Follow Our Journey</h3>
                <div class="social-icons">
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-pinterest-p"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-tiktok"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="contact-form-container fade-up">
            <h2>Send a Message</h2>
            <p>We'll get back to you within 24 hours</p>

            <!-- Success Message -->
            @if(session('success'))
            <div class="success-message">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            <!-- Error Messages -->
            @if($errors->any())
            <div class="error-message">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    <strong>Please fix the following errors:</strong>
                    <ul class="error-list">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label><i class="fas fa-user"></i> Your Name *</label>
                    <input type="text" name="name" required placeholder="John Doe" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label><i class="fas fa-envelope"></i> Email Address *</label>
                    <input type="email" name="email" required placeholder="hello@example.com" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label><i class="fas fa-tag"></i> Subject *</label>
                    <select name="subject" required>
                        <option value="">Select a subject</option>
                        <option value="product" {{ old('subject') == 'product' ? 'selected' : '' }}>Product Inquiry</option>
                        <option value="order" {{ old('subject') == 'order' ? 'selected' : '' }}>Order Status</option>
                        <option value="wholesale" {{ old('subject') == 'wholesale' ? 'selected' : '' }}>Wholesale Opportunities</option>
                        <option value="feedback" {{ old('subject') == 'feedback' ? 'selected' : '' }}>Feedback</option>
                        <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-comment"></i> Message *</label>
                    <textarea name="message" required placeholder="Tell us how we can help...">{{ old('message') }}</textarea>
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i>
                    Send Message
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map-section">
    <div class="map-container fade-up">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.2219901290355!2d-74.00369368400567!3d40.71312937933048!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a316f6c7b6f%3A0x5c4f5e8b6e9d8f7a!2sNew%20York%2C%20NY!5e0!3m2!1sen!2sus!4v1700000000000!5m2!1sen!2sus"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <div class="section-header" style="text-align: center; margin-bottom: 50px;">
        <h2 style="font-family: 'Abril Fatface', cursive; font-size: 2rem; color: var(--olive-dark);">Frequently Asked Questions</h2>
        <p style="color: var(--dark); opacity: 0.7;">Quick answers to common questions</p>
    </div>

    <div class="faq-grid">
        <div class="faq-item fade-up">
            <div class="faq-question">
                How long does shipping take?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                Orders are processed within 1-2 business days. Standard shipping takes 3-7 business days within the US, and 7-14 business days for international orders.
            </div>
        </div>

        <div class="faq-item fade-up">
            <div class="faq-question">
                Can I return or exchange my mug?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                Yes! We offer 30-day returns for unused items in original packaging. Contact our support team to initiate a return or exchange.
            </div>
        </div>

        <div class="faq-item fade-up">
            <div class="faq-question">
                Do you offer wholesale pricing?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                Absolutely! We work with cafes, gift shops, and retailers. Please contact our wholesale team for custom pricing and bulk orders.
            </div>
        </div>

        <div class="faq-item fade-up">
            <div class="faq-question">
                Are your mugs dishwasher safe?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                Yes, all our ceramic mugs are dishwasher and microwave safe. However, to preserve the artwork, hand washing is recommended.
            </div>
        </div>

        <div class="faq-item fade-up">
            <div class="faq-question">
                Do you ship internationally?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                Yes! We ship worldwide. International shipping rates and delivery times vary by location. You'll see the shipping cost at checkout.
            </div>
        </div>

        <div class="faq-item fade-up">
            <div class="faq-question">
                Can I customize a mug?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                We offer custom designs for bulk orders! Contact us with your idea and quantity, and we'll work together to create something special.
            </div>
        </div>
    </div>
</section>

<script>
    const fadeElements = document.querySelectorAll('.fade-up');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1
    });

    fadeElements.forEach(el => observer.observe(el));


    document.querySelectorAll('.faq-item').forEach(item => {
        item.addEventListener('click', () => {
            item.classList.toggle('active');
        });
    });

    setTimeout(() => {
        const successMsg = document.querySelector('.success-message');
        if (successMsg) {
            successMsg.style.opacity = '0';
            setTimeout(() => {
                successMsg.style.display = 'none';
            }, 500);
        }
    }, 5000);
</script>
@endsection