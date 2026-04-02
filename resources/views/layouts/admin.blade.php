<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-cream: #F4F1EA;
            --olive: #A3B18A;
            --olive-dark: #588157;
            --soft-pink: #FBB6CE;
            --hot-pink: #EF4D8D;
            --dark: #333333;
            --white: #FFFFFF;
            --border: #e0d6cc;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-cream);
            color: var(--dark);
        }
        
        .admin-wrapper { display: flex; min-height: 100vh; }
        
        /* Sidebar */
        .admin-sidebar {
            width: 280px;
            background: var(--olive-dark);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: all 0.3s;
            z-index: 1000;
        }
        
        .admin-sidebar h2 {
            font-family: 'Abril Fatface', cursive;
            text-align: center;
            padding: 30px 0;
            font-size: 1.5rem;
            letter-spacing: 1px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            color: var(--soft-pink);
        }
        
        .admin-sidebar ul { list-style: none; padding: 20px 0; }
        
        .admin-sidebar li a {
            display: block;
            padding: 12px 25px;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .admin-sidebar li a i { width: 25px; margin-right: 12px; }
        
        .admin-sidebar li a:hover,
        .admin-sidebar li a.active {
            background: var(--soft-pink);
            color: var(--olive-dark);
            padding-left: 30px;
        }
        
        .admin-sidebar button {
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            color: rgba(255,255,255,0.85);
            padding: 12px 25px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .admin-sidebar button i { width: 25px; margin-right: 12px; }
        
        .admin-sidebar button:hover {
            background: var(--soft-pink);
            color: var(--olive-dark);
            padding-left: 30px;
        }
        
        /* Content */
        .admin-content {
            flex: 1;
            margin-left: 280px;
            padding: 30px;
        }
        
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
        }
        
        .admin-header h1 {
            font-family: 'Abril Fatface', cursive;
            font-size: 1.5rem;
            margin: 0;
            color: var(--olive-dark);
        }
        
        .admin-header i { color: var(--olive-dark); margin-right: 5px; }
        
        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: var(--white);
            padding: 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border: 1px solid var(--border);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            background: var(--soft-pink);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--olive-dark);
        }
        
        .stat-info h3 { 
            font-size: 1.8rem; 
            margin: 0; 
            font-weight: 600;
            color: var(--olive-dark);
        }
        
        .stat-info p { 
            margin: 0; 
            color: var(--dark);
            font-size: 0.85rem;
            opacity: 0.7;
        }
        
        /* Tables */
        .admin-section {
            background: var(--white);
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 30px;
            border: 1px solid var(--border);
        }
        
        .admin-section h2 {
            font-size: 1.2rem;
            margin-bottom: 20px;
            font-weight: 600;
            color: var(--olive-dark);
        }
        
        .table-responsive {
            overflow-x: auto;
        }
        
        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .admin-table th,
        .admin-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }
        
        .admin-table th {
            background: var(--bg-cream);
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            color: var(--olive-dark);
        }
        
        .admin-table tr:hover {
            background: rgba(251, 182, 206, 0.05);
        }
        
        /* Forms */
        .form-group { margin-bottom: 20px; }
        .form-group label { 
            display: block; 
            margin-bottom: 8px; 
            font-weight: 600; 
            font-size: 0.85rem;
            color: var(--dark);
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-family: inherit;
            transition: border-color 0.3s;
        }
        
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--olive-dark);
        }
        
        .btn-primary {
            background: var(--olive-dark);
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
            font-weight: 500;
        }
        
        .btn-primary:hover { 
            background: var(--olive);
        }
        
        .btn-small {
            background: var(--olive-dark);
            color: white;
            border: none;
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .btn-small:hover {
            background: var(--olive);
        }
        
        .btn-danger {
            background: var(--hot-pink);
        }
        
        .btn-danger:hover {
            background: #d43f7a;
        }
        
        /* Status Badges */
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-block;
        }
        
        .status-pending {
            background: #ffc107;
            color: #000;
        }
        
        .status-processing {
            background: #17a2b8;
            color: white;
        }
        
        .status-completed {
            background: #28a745;
            color: white;
        }
        
        .status-cancelled {
            background: #dc3545;
            color: white;
        }
        
        /* Mobile */
        .mobile-menu-btn {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1100;
            background: var(--olive-dark);
            color: white;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 12px;
            cursor: pointer;
            font-size: 1.2rem;
        }
        
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }
        
        @media (max-width: 992px) {
            .admin-sidebar {
                transform: translateX(-100%);
                position: fixed;
            }
            .admin-sidebar.open { transform: translateX(0); }
            .admin-content { margin-left: 0; padding: 80px 20px 20px; }
            .mobile-menu-btn { display: block; }
            .sidebar-overlay.open { display: block; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }
        
        @media (max-width: 576px) {
            .stats-grid { grid-template-columns: 1fr; }
        }
        
        /* Alert */
        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #28a745;
        }
        
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #dc3545;
        }
        
        /* Pagination */
        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 5px;
        }
        
        .pagination a, .pagination span {
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            text-decoration: none;
            color: var(--olive-dark);
        }
        
        .pagination .active span {
            background: var(--olive-dark);
            color: white;
            border-color: var(--olive-dark);
        }
    </style>
</head>
<body>
    <button class="mobile-menu-btn" id="mobileMenuBtn"><i class="fas fa-bars"></i></button>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <div class="admin-wrapper">
        <div class="admin-sidebar" id="adminSidebar">
            <h2>Mugi<br>Admin</h2>
            <ul>
                <li><a href="/admin/dashboard" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fas fa-chart-line"></i> Dashboard</a></li>
                <li><a href="/admin/products" class="{{ request()->routeIs('admin.products') ? 'active' : '' }}"><i class="fas fa-box"></i> Products</a></li>
                <li><a href="/admin/orders" class="{{ request()->routeIs('admin.orders') ? 'active' : '' }}"><i class="fas fa-shopping-cart"></i> Orders</a></li>
                <li><a href="/admin/categories" class="{{ request()->routeIs('admin.categories') ? 'active' : '' }}"><i class="fas fa-tags"></i> Categories</a></li>
                <li><a href="/"><i class="fas fa-store"></i> View Store</a></li>
                <li>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        
        <div class="admin-content">
            <div class="admin-header">
                <h1>@yield('title')</h1>
                <div><i class="fas fa-user-circle"></i> {{ auth()->user()->name }}</div>
            </div>
            
            @if(session('success'))
                <div class="alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert-error">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif
            
            @if($errors->any())
                <div class="alert-error">
                    <strong><i class="fas fa-exclamation-triangle"></i> Errors:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            @yield('content')
        </div>
    </div>
    
    <script>
        const mobileBtn = document.getElementById('mobileMenuBtn');
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        
        function toggleSidebar() {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('open');
        }
        
        if (mobileBtn) mobileBtn.addEventListener('click', toggleSidebar);
        if (overlay) overlay.addEventListener('click', toggleSidebar);
        
        window.addEventListener('resize', () => {
            if (window.innerWidth > 992) {
                sidebar.classList.remove('open');
                overlay.classList.remove('open');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>