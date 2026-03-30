@extends('layouts.admin')

@section('title', 'Quản lý Sản phẩm - Laptop Store Admin')

@push('styles')
    @vite('resources/css/admin/product.css')
@endpush

@section('content')
<div class="topbar">
    <h2><i class="fas fa-box"></i> Quản lý Sản phẩm</h2>
    <a href="{{ route('admin.products.create') }}" class="btn-add">
        <i class="fas fa-plus"></i> Thêm sản phẩm mới
    </a>
</div>

<!-- Toolbar -->
<form method="GET" action="{{ route('admin.products.index') }}" class="toolbar">
    <div style="display: flex; gap: 10px; align-items: center; flex: 1;">
        <input type="text" name="search" class="search-box" placeholder="Tìm kiếm theo tên sản phẩm..." value="{{ request('search') }}">
        <button type="submit" class="btn-add" style="background: var(--primary-color); padding: 10px 15px;">
            <i class="fas fa-search"></i>
        </button>
    </div>

    <select name="category" class="filter-select" onchange="this.form.submit()">
        <option value="">Tất cả danh mục</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>

    <select name="brand" class="filter-select" onchange="this.form.submit()">
        <option value="">Tất cả thương hiệu</option>
        @foreach($brands as $brand)
            <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                {{ $brand->name }}
            </option>
        @endforeach
    </select>
    
    @if(request()->anyFilled(['search', 'category', 'brand']))
        <a href="{{ route('admin.products.index') }}" class="btn-add" style="background: #666; font-size: 0.8rem;" title="Xóa bộ lọc">
            <i class="fas fa-times"></i>
        </a>
    @endif
</form>

<!-- Product Table -->
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th width="70">Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Thương hiệu</th>
                <th>Giá bán</th>
                <th>Giá gốc</th>
                <th>Tồn kho</th>
                <th width="140">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>
                    @if($product->mainImage)
                        <img src="{{ $product->mainImage->image_path }}" class="product-img" alt="{{ $product->name }}">
                    @else
                        <img src="https://images.unsplash.com/photo-1603302576834-0d1a7099d69d?w=80" class="product-img" alt="no-image">
                    @endif
                </td>
                <td><strong>{{ $product->name }}</strong><br><small>#SP00{{ $product->id }}</small></td>
                <td>{{ $product->category->name ?? 'N/A' }}</td>
                <td>{{ $product->brand->name ?? 'N/A' }}</td>
                <td class="price">
                    @if($product->variants->count() > 0)
                        {{ number_format($product->variants->min('price')) }} ₫
                    @else
                        Liên hệ
                    @endif
                </td>
                <td style="color:#999; font-size: 0.85rem;">
                    {{ $product->variants->count() }} cấu hình
                </td>
                <td>
                    @php $totalStock = $product->variants->sum('stock'); @endphp
                    <span class="stock {{ $totalStock > 0 ? 'stock-in' : 'stock-out' }}">
                        {{ $totalStock }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="action-btn btn-edit" title="Sửa"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn btn-delete" title="Xóa" onclick="return confirm('Xóa sản phẩm này?')"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="pagination">
    {{ $products->links() }}
</div>
@endsection