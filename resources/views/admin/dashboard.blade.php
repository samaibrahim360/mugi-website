@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-box"></i></div>
        <div class="stat-info">
            <h3>{{ $totalProducts }}</h3>
            <p>Total Products</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-shopping-cart"></i></div>
        <div class="stat-info">
            <h3>{{ $totalOrders }}</h3>
            <p>Total Orders</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-users"></i></div>
        <div class="stat-info">
            <h3>{{ $totalUsers }}</h3>
            <p>Total Users</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-dollar-sign"></i></div>
        <div class="stat-info">
            <h3>${{ number_format($totalRevenue, 2) }}</h3>
            <p>Total Revenue</p>
        </div>
    </div>
</div>

<div class="admin-section">
    <h2><i class="fas fa-clock"></i> Recent Orders</h2>
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                <tr>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>${{ number_format($order->total_amount, 2) }}</td>
                    <td>
                        <span class="status-badge status-{{ $order->status }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center">No orders yet</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="admin-section">
    <h2><i class="fas fa-exclamation-triangle"></i> Low Stock Alert</h2>
    @if($lowStockProducts->count() > 0)
    <div class="table-responsive">
        <table class="admin-table">
            <thead><tr><th>Product</th><th>Stock</th><th>Action</th></tr></thead>
            <tbody>
                @foreach($lowStockProducts as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td style="color: var(--hot-pink); font-weight: 600;">{{ $product->stock }}</td>
                    <td><a href="/admin/products" class="btn-small"><i class="fas fa-edit"></i> Update Stock</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p><i class="fas fa-check-circle" style="color: #28a745;"></i> All products have sufficient stock</p>
    @endif
</div>
@endsection