<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mugi')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Cherry+Bomb+One&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            padding-top: 80px;
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-cream);
            color: var(--dark);
            overflow-x: hidden;
        }

        /* --- NAVIGATION --- */
        .custom-nav {
            background-color: var(--bg-cream);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            padding: 12px 5%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        /* Left side - Logo */
        .nav-left {
            flex: 0 0 auto;
        }

        .navbar-brand-custom {
            width: 100px;
            height: 45px;
            background-color: #FBB6CE;
            color: var(--olive-dark);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Cherry Bomb One', cursive;
            font-size: 1.5rem;
            font-style: italic;
            text-decoration: none;
        }

        .navbar-brand-custom:hover {
            color: var(--olive-dark);
        }

        /* Center - Navigation Menu (Desktop) */
        .nav-center {
            flex: 1;
            display: flex;
            justify-content: center;
        }

        /* Custom navbar toggler - only visible on mobile */
        .navbar-toggler {
            border: none;
            background: var(--soft-pink);
            padding: 8px 12px;
            border-radius: 50px;
        }

        .navbar-toggler:focus {
            box-shadow: none;
            outline: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(88, 129, 87, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Desktop Navigation Menu */
        .nav-pill-menu {
            display: flex;
            background-color: var(--soft-pink);
            padding: 6px;
            border-radius: 50px;
            list-style: none;
            gap: 5px;
            margin: 0;
        }

        .nav-pill-menu li {
            display: flex;
        }

        .nav-pill-menu a {
            text-decoration: none;
            color: var(--olive-dark);
            font-size: 0.95rem;
            font-weight: 600;
            padding: 10px 22px;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .nav-pill-menu a.active {
            background-color: var(--olive-dark);
            color: var(--white);
        }

        .nav-pill-menu a:hover:not(.active) {
            background-color: rgba(255, 255, 255, 0.3);
        }

        /* Right side - Action Icons */
        .nav-right {
            flex: 0 0 auto;
        }

        .nav-action-icons {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .icon-circle {
            width: 45px;
            height: 45px;
            background-color: var(--soft-pink);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            font-size: 1.1rem;
            text-decoration: none;
            color: var(--olive-dark);
            transition: 0.3s;
        }

        .icon-circle:hover {
            background-color: var(--olive-dark);
            color: white;
            transform: scale(1.05);
        }

        .icon-circle.active {
            background-color: var(--olive-dark);
            color: white;
        }

        .icon-circle.cart {
            position: relative;
        }

        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--hot-pink);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Mobile Navigation - Hidden on desktop, shown on mobile */
        .mobile-nav {
            display: none;
        }

        /* Mobile menu adjustments */
        @media (max-width: 991px) {
            body {
                padding-top: 70px;
            }

            .nav-center {
                display: none;
            }

            .navbar-toggler {
                display: block;
            }

            .mobile-nav {
                display: block;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: var(--bg-cream);
                padding: 20px;
                border-radius: 30px;
                margin-top: 10px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                z-index: 1000;
            }

            .mobile-nav .nav-pill-menu {
                background-color: transparent;
                flex-direction: column;
                gap: 10px;
                padding: 0;
            }

            .mobile-nav .nav-pill-menu li {
                width: 100%;
            }

            .mobile-nav .nav-pill-menu a {
                display: block;
                text-align: center;
                background-color: var(--soft-pink);
            }

            .mobile-nav.collapse:not(.show) {
                display: none;
            }

            .mobile-nav.collapse.show {
                display: block;
            }
        }

        @media (min-width: 992px) {
            .navbar-toggler {
                display: none;
            }

            .mobile-nav {
                display: none !important;
            }
        }

        @media (max-width: 576px) {
            .icon-circle {
                width: 38px;
                height: 38px;
                font-size: 0.9rem;
            }

            .nav-action-icons {
                gap: 8px;
            }
        }

        /* --- ALERTS --- */
        .alert {
            padding: 15px;
            margin: 20px 5%;
            border-radius: 10px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* --- FOOTER CSS --- */
        footer {
            background-color: var(--olive-dark);
            color: white;
            padding: 60px 8% 40px;
            width: 100%;
            border-radius: 60px 60px 0 0;
            position: relative;
            margin-top: 80px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .footer-logo {
            font-family: 'Abril Fatface', serif;
            font-size: 3rem;
            line-height: 1;
        }

        .link-group h4 {
            font-weight: 600;
            margin-bottom: 25px;
            font-size: 1.1rem;
            color: white;
        }

        .link-group ul {
            list-style: none;
            padding: 0;
        }

        .link-group ul li {
            margin-bottom: 12px;
        }

        .link-group ul li a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: 0.3s;
            font-size: 0.95rem;
        }

        .link-group ul li a:hover {
            color: white;
            padding-left: 5px;
        }

        .newsletter-box h4 {
            font-weight: 600;
            margin-bottom: 25px;
        }

        .input-wrapper {
            position: relative;
            border-bottom: 1px solid rgba(255, 255, 255, 0.4);
            display: flex;
            align-items: center;
            padding-bottom: 8px;
        }

        .input-wrapper input {
            background: transparent;
            border: none;
            color: white;
            width: 100%;
            outline: none;
            font-size: 1rem;
        }

        .input-wrapper input::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .arrow-btn {
            background: transparent;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .arrow-btn:hover {
            transform: translateX(5px);
        }

        .footer-bottom {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.85rem;
            opacity: 0.6;
            text-align: center;
        }

        /* Custom Toast Notifications */
        .toast-notification {
            position: fixed;
            top: 100px;
            right: 20px;
            z-index: 9999;
        }

        @media (max-width: 768px) {
            .toast-notification {
                left: 20px;
                right: 20px;
                top: 80px;
            }
        }

        @media (max-width: 992px) {
            .footer-content {
                grid-template-columns: repeat(2, 1fr);
                gap: 30px;
            }
        }

        @media (max-width: 576px) {
            .footer-content {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 30px;
            }

            .link-group ul {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .input-wrapper {
                max-width: 300px;
                margin: 0 auto;
            }

            footer {
                padding: 50px 5% 30px;
            }
        }
    </style>
</head>

<body>
    <!-- Toast Notification Container -->
    <div id="toast-container" class="toast-notification"></div>
    
    <!-- Centered Navbar -->
    <nav class="custom-nav">
        <div class="nav-container">
            <div class="nav-left">
                <a href="/" class="navbar-brand-custom">Mugi</a>
            </div>

            <div class="nav-center">
                <ul class="nav-pill-menu">
                    <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                    <li><a href="/products" class="{{ request()->is('products*') ? 'active' : '' }}">Mugs</a></li>
                    <li><a href="/about" class="{{ request()->is('about') ? 'active' : '' }}">About</a></li>
                    <li><a href="/contact" class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a></li>
                </ul>
            </div>

            <div class="nav-right">
                <div class="nav-action-icons">
                    <a href="/products?search=" class="icon-circle {{ request()->has('search') ? 'active' : '' }}">
                        <i class="fas fa-search"></i>
                    </a>
                    @auth
                    <a href="/wishlist" class="icon-circle {{ request()->is('wishlist') ? 'active' : '' }}">
                        <i class="far fa-heart"></i>
                    </a>
                    <a href="/cart" class="icon-circle cart {{ request()->is('cart') ? 'active' : '' }}" id="cart-icon">
                        <i class="fas fa-shopping-bag"></i>
                        <span class="cart-count" id="cart-count">
                            @auth
                            {{ \App\Models\Cart::where('user_id', auth()->id())->count() }}
                            @else
                            0
                            @endauth
                        </span>
                    </a>
                    <div class="icon-circle" onclick="document.getElementById('logout-form').submit()" style="cursor: pointer;">
                        <i class="fas fa-user"></i>
                    </div>
                    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @else
                    <a href="/login" class="icon-circle {{ request()->is('login') ? 'active' : '' }}">
                        <i class="fas fa-user"></i>
                    </a>
                    @endauth
                </div>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse mobile-nav" id="mobileMenu">
            <ul class="nav-pill-menu">
                <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                <li><a href="/products" class="{{ request()->is('products*') ? 'active' : '' }}">Mugs</a></li>
                <li><a href="/about" class="{{ request()->is('about') ? 'active' : '' }}">About</a></li>
                <li><a href="/contact" class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a></li>
            </ul>
        </div>
    </nav>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
    @endif

    @yield('content')

    <footer>
        <div class="footer-content">
            <div class="footer-logo">Mugi</div>

            <div class="link-group">
                <h4>Links</h4>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/products">Mugs</a></li>
                    <li><a href="/about">About</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ul>
            </div>

            <div class="link-group">
                <h4>Follow Our Journey</h4>
                <ul>
                    <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
                    <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
                    <li><a href="#"><i class="fab fa-pinterest-p"></i> pinterest</a></li>
                    <li><a href="#"><i class="fab fa-tiktok"></i> tiktok</a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i> twitter</a></li>
                </ul>
            </div>

            <div class="newsletter-box">
                <h4>More ideas, More Mugi.</h4>
                <form action="#" method="POST">
                    @csrf
                    <div class="input-wrapper">
                        <input type="email" name="email" placeholder="Email" required>
                        <button type="submit" class="arrow-btn"><i class="fas fa-arrow-right"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="footer-bottom">
            <p>© 2026 Mugi. All creative rights reserved.</p>
        </div>
    </footer>

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

        // Custom Toast Notification System
        function showToast(message, type = 'success', title = '') {
            const container = document.getElementById('toast-container');
            if (!container) {
                console.error('Toast container not found!');
                return;
            }

            const toastId = 'toast-' + Date.now();
            const icon = type === 'success' ? '✓' : '✕';
            const defaultTitle = type === 'success' ? 'Success!' : 'Error!';
            const bgColor = type === 'success' ? '#588157' : '#EF4D8D';
            
            const toast = document.createElement('div');
            toast.id = toastId;
            toast.style.cssText = `
                background: white;
                border-radius: 20px;
                padding: 16px 24px;
                margin-bottom: 12px;
                display: flex;
                align-items: center;
                gap: 12px;
                box-shadow: 0 10px 25px rgba(0,0,0,0.15);
                min-width: 280px;
                max-width: 380px;
                border-left: 4px solid ${bgColor};
                animation: slideIn 0.3s ease;
                position: relative;
            `;
            
            toast.innerHTML = `
                <div style="width: 32px; height: 32px; border-radius: 50%; background: ${bgColor}; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">${icon}</div>
                <div style="flex: 1;">
                    <div style="font-weight: 600; font-size: 0.9rem; margin-bottom: 2px; color: #333;">${title || defaultTitle}</div>
                    <div style="font-size: 0.8rem; color: #666;">${message}</div>
                </div>
                <button onclick="closeToast('${toastId}')" style="background: none; border: none; font-size: 1rem; color: #999; cursor: pointer; padding: 5px;">✕</button>
            `;
            
            container.appendChild(toast);
            
            setTimeout(() => {
                closeToast(toastId);
            }, 3000);
        }

        function closeToast(toastId) {
            const toast = document.getElementById(toastId);
            if (toast) {
                toast.style.animation = 'slideOut 0.3s ease forwards';
                setTimeout(() => {
                    if (toast && toast.remove) {
                        toast.remove();
                    }
                }, 300);
            }
        }

        // Add animations
        const styleSheet = document.createElement('style');
        styleSheet.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            @keyframes slideOut {
                to {
                    transform: translateX(100%);
                    opacity: 0;
                    visibility: hidden;
                }
            }
        `;
        document.head.appendChild(styleSheet);
    </script>
    
    <!-- Bootstrap JS for toggler functionality -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>