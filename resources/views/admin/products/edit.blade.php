@extends('layouts.admin')

@section('title', 'Chỉnh sửa Sản phẩm - Laptop Store Admin')

@push('styles')
    @vite('resources/css/admin/product.css')
@endpush

@section('content')
<div class="form-card">
    <h2><i class="fas fa-edit"></i> Chỉnh Sửa Sản Phẩm</h2>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="form-group">
                <label>Tên sản phẩm <span style="color:red;">*</span></label>
                <input type="text" name="name" value="{{ $product->name }}" required>
            </div>

            <div class="form-group">
                <label>Thương hiệu <span style="color:red;">*</span></label>
                <select name="brand_id" required>
                    <option value="">Chọn thương hiệu</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Danh mục <span style="color:red;">*</span></label>
            <select name="category_id" required>
                <option value="">Chọn danh mục</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="form-group">
                <label>Giá bán (VNĐ) <span style="color:red;">*</span></label>
                <input type="number" name="price" value="{{ $product->price }}" required>
            </div>
            <div class="form-group">
                <label>Giá gốc (VNĐ)</label>
                <input type="number" name="original_price" value="{{ $product->original_price ?? $product->price * 1.1 }}">
            </div>
        </div>

        <!-- ==================== UPLOAD HÌNH ẢNH ==================== -->
        <div class="image-section">
            <div class="image-title"><i class="fas fa-image"></i> Hình ảnh sản phẩm</div>
            
            <div class="upload-area" onclick="document.getElementById('fileInput').click()">
                <i class="fas fa-cloud-upload-alt" style="font-size: 40px; color: #d10000; margin-bottom: 10px;"></i>
                <p style="color: #666;">Click để thêm ảnh mới hoặc kéo thả</p>
                <input type="file" id="fileInput" name="images[]" multiple accept="image/*" style="display: none;" onchange="previewImages(event)">
            </div>

            <div class="preview-container" id="previewContainer">
                <!-- Hiển thị ảnh hiện tại nếu có logic (ví dụ dùng $product->images) -->
                @if($product->image)
                <div class="preview-item">
                    <img src="{{ $product->image }}" alt="product">
                    <button type="button" class="remove-btn" onclick="this.parentElement.remove()">×</button>
                </div>
                @endif
            </div>
        </div>

        <!-- ==================== THÔNG SỐ KỸ THUẬT ==================== -->
        <div class="attributes">
            <div class="attribute-title"><i class="fas fa-microchip"></i> Thông số kỹ thuật</div>
            
            <div class="row">
                <div class="form-group">
                    <label>Card đồ họa (VGA)</label>
                    <input type="text" name="vga" value="{{ $product->vga }}">
                </div>
                <div class="form-group">
                    <label>CPU / Chip</label>
                    <input type="text" name="cpu" value="{{ $product->cpu }}">
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label>RAM (GB)</label>
                    <input type="text" name="ram" value="{{ $product->ram }}">
                </div>
                <div class="form-group">
                    <label>ROM / Ổ cứng</label>
                    <input type="text" name="ssd" value="{{ $product->ssd }}">
                </div>
            </div>

            <div class="form-group">
                <label>Màn hình</label>
                <input type="text" name="screen" value="{{ $product->screen }}">
            </div>

            <div class="form-group">
                <label>Hệ điều hành</label>
                <input type="text" name="os" value="{{ $product->os }}">
            </div>
        </div>

        <div class="form-group">
            <label>Mô tả chi tiết sản phẩm</label>
            <textarea name="description" rows="6">{{ $product->description }}</textarea>
        </div>

        <div class="btn-group">
            <button type="submit" class="btn-save">
                <i class="fas fa-save"></i> Cập nhật sản phẩm
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn-cancel">Hủy</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function previewImages(event) {
        const container = document.getElementById('previewContainer');
        const files = event.target.files;

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (!file.type.startsWith('image/')) continue;

            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'preview-item';
                div.innerHTML = `
                    <img src="${e.target.result}" alt="preview">
                    <button class="remove-btn" onclick="this.parentElement.remove()">×</button>
                `;
                container.appendChild(div);
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush