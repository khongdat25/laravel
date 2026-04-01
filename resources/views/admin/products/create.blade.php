@extends('layouts.admin')

@section('title', 'Thêm Sản phẩm Mới - Laptop Store Admin')

@push('styles')
    @vite('resources/css/admin/product.css')
@endpush

@section('content')
<div class="form-card">
    <h2><i class="fas fa-plus-circle"></i> Thêm Sản Phẩm Mới</h2>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="form-group">
                <label>Tên sản phẩm <span style="color:red;">*</span></label>
                <input type="text" name="name" placeholder="Lenovo Legion 5 Pro 2024 i9-14900HX" required>
            </div>

            <div class="form-group">
                <label>Thương hiệu <span style="color:red;">*</span></label>
                <select name="brand_id" required>
                    <option value="">Chọn thương hiệu</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Danh mục <span style="color:red;">*</span></label>
            <select name="category_id" required>
                <option value="">Chọn danh mục</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="form-group">
                <label>Giá bán (VNĐ) <span style="color:red;">*</span></label>
                <input type="number" name="price" placeholder="35990000" required>
            </div>
            <div class="form-group">
                <label>Giá gốc (VNĐ)</label>
                <input type="number" name="original_price" placeholder="38990000">
            </div>
            <div class="form-group">
                <label>Số lượng kho <span style="color:red;">*</span></label>
                <input type="number" name="stock" placeholder="10" required>
            </div>
        </div>

        <!-- ==================== UPLOAD HÌNH ẢNH ==================== -->
        <div class="image-section">
            <div class="image-title"><i class="fas fa-image"></i> Hình ảnh sản phẩm</div>
            
            <div class="upload-area" onclick="document.getElementById('fileInput').click()">
                <i class="fas fa-cloud-upload-alt" style="font-size: 40px; color: #d10000; margin-bottom: 10px;"></i>
                <p style="color: #666;">Click để chọn ảnh hoặc kéo thả ảnh vào đây</p>
                <small style="color: #999;">Hỗ trợ JPG, PNG, WebP (Tối đa 10 ảnh)</small>
                <input type="file" id="fileInput" name="images[]" multiple accept="image/*" style="display: none;" onchange="previewImages(event)">
            </div>

            <div class="preview-container" id="previewContainer"></div>
        </div>

        <!-- ==================== THÔNG SỐ KỸ THUẬT (Text Input) ==================== -->
        <div class="attributes">
            <div class="attribute-title"><i class="fas fa-microchip"></i> Thông số kỹ thuật</div>
            
            <div class="row">
                <div class="form-group">
                    <label>Card đồ họa (VGA)</label>
                    <input type="text" name="vga" placeholder="RTX 4060 8GB">
                </div>
                <div class="form-group">
                    <label>CPU / Chip</label>
                    <input type="text" name="cpu" placeholder="Intel Core i9-14900HX">
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label>RAM (GB)</label>
                    <input type="text" name="ram" placeholder="16GB DDR5">
                </div>
                <div class="form-group">
                    <label>ROM / Ổ cứng</label>
                    <input type="text" name="ssd" placeholder="1TB SSD NVMe">
                </div>
            </div>

            <div class="form-group">
                <label>Màn hình</label>
                <input type="text" name="screen" placeholder="16 inch, 2.5K, 165Hz">
            </div>

            <div class="form-group">
                <label>Hệ điều hành</label>
                <input type="text" name="os" placeholder="Windows 11 Home">
            </div>
        </div>

        <div class="form-group">
            <label>Mô tả chi tiết sản phẩm</label>
            <textarea name="description" rows="6" placeholder="Nhập mô tả đầy đủ về sản phẩm..."></textarea>
        </div>

        <div class="btn-group">
            <button type="submit" class="btn-save">
                <i class="fas fa-save"></i> Lưu sản phẩm
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