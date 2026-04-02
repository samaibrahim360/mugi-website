@extends('layouts.admin')

@section('title', 'Products')

@section('content')
<div class="admin-section">
    <h2><i class="fas fa-plus-circle"></i> Add New Product</h2>
    <form action="/admin/products" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
            <div>
                <div class="form-group">
                    <label><i class="fas fa-box"></i> Product Name *</label>
                    <input type="text" name="name" required placeholder="e.g., Ceramic Mug">
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label>Price (e.g) *</label>
                    <input type="number" name="price" step="0.01" required placeholder="0.00">
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label><i class="fas fa-cubes"></i> Stock *</label>
                    <input type="number" name="stock" required placeholder="Quantity">
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label><i class="fas fa-tags"></i> Category</label>
                    <select name="category_id">
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label><i class="fas fa-align-left"></i> Description *</label>
            <textarea name="description" rows="4" required placeholder="Describe your product..."></textarea>
        </div>
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
            <div>
                <div class="form-group">
                    <label><i class="fas fa-image"></i> Product Image</label>
                    <input type="file" name="image" accept="image/*">
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="is_featured" value="1"> 
                        <i class="fas fa-star" style="color: gold;"></i> Featured Product
                    </label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Add Product</button>
    </form>
</div>

<div class="admin-section">
    <h2><i class="fas fa-list"></i> All Products</h2>
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Featured</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" width="45" height="45" style="object-fit:cover; border-radius:8px;">
                        @else
                            <span style="color: #888;"><i class="fas fa-image"></i> No image</span>
                        @endif
                    </td>
                    <td><strong>{{ $product->name }}</strong></td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td style="{{ $product->stock < 10 ? 'color: var(--hot-pink); font-weight: 600;' : '' }}">
                        {{ $product->stock }}
                        @if($product->stock < 10)
                            <i class="fas fa-exclamation-triangle"></i>
                        @endif
                    </td>
                    <td>{{ $product->is_featured ? ' Yes' : ' No' }}</td>
                    <td>
                        <form action="/admin/products/{{ $product->id }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-small" style="background: var(--hot-pink);" onclick="return confirm('Delete this product?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $products->links() }}
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .admin-section form > div[style*="grid-template-columns"] {
            grid-template-columns: 1fr !important;
            gap: 0 !important;
        }
    }
</style>
@endsection