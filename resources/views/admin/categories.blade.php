@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
<div class="admin-section">
    <h2><i class="fas fa-plus-circle"></i> Add New Category</h2>
    <form action="/admin/categories" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
            <div>
                <div class="form-group">
                    <label><i class="fas fa-tag"></i> Category Name *</label>
                    <input type="text" name="name" required placeholder="e.g., Coffee Mugs">
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label><i class="fas fa-link"></i> Slug *</label>
                    <input type="text" name="slug" required placeholder="e.g., coffee-mugs">
                    <small style="color: #888; font-size: 0.7rem;">URL-friendly name for the category</small>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label><i class="fas fa-image"></i> Category Image</label>
            <input type="file" name="image" accept="image/*">
            <small style="color: #888;">Recommended: JPG, PNG, or WEBP, max 2MB</small>
        </div>
        <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Add Category</button>
    </form>
</div>

<div class="admin-section">
    <h2><i class="fas fa-list"></i> All Categories</h2>
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Products</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>
                        @if($category->image)
                            <img src="{{ asset('storage/'.$category->image) }}" width="45" height="45" style="object-fit:cover; border-radius:8px;">
                        @else
                            <span style="color: #888;"><i class="fas fa-image"></i> No image</span>
                        @endif
                    </td>
                    <td><strong>{{ $category->name }}</strong></td>
                    <td><code>{{ $category->slug }}</code></td>
                    <td>{{ $category->products()->count() }}</td>
                    <td>
                        <form action="/admin/categories/{{ $category->id }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-small" style="background: var(--hot-pink);" onclick="return confirm('Delete this category? Products will be unassigned.')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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