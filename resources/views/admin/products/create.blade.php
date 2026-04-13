@extends('layouts.admin')

@section('title', 'Thêm Sản phẩm Mới - Laptop Store Admin')

@push('styles')
    @vite('resources/css/admin/product.css')
    <style>
        .dynamic-section {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #eee;
        }
        .dynamic-row {
            background: #fff;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            position: relative;
            margin-bottom: 15px;
        }
        .remove-row-btn {
            position: absolute;
            top: -10px;
            right: -10px;
            background: red;
            color: white;
            border: none;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 10;
        }
        .add-row-btn {
            background: #28a745;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        .variant-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            background: #fff;
        }
        .variant-table th, .variant-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            font-size: 0.9rem;
        }
        .variant-table th {
            background: #f4f4f4;
        }
    </style>
@endpush

@section('content')
<div class="form-card">
    <h2><i class="fas fa-plus-circle"></i> Thêm Sản Phẩm Mới</h2>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- THÔNG TIN CHUNG -->
        <h3 style="margin: 20px 0 10px; color: #d10000; border-bottom: 2px solid #ddd; padding-bottom: 5px;">1. Thông tin chung</h3>
        <div class="row">
            <div class="form-group">
                <label>Tên sản phẩm <span style="color:red;">*</span></label>
                <input type="text" name="name" placeholder="Ví dụ: Lenovo Legion 5 Pro 2024" required>
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

        <div class="form-group">
            <label>Mô tả chi tiết sản phẩm</label>
            <textarea name="description" rows="5" placeholder="Nhập mô tả về sản phẩm..."></textarea>
        </div>

        <!-- HÌNH ẢNH SẢN PHẨM -->
        <h3 style="margin: 30px 0 10px; color: #d10000; border-bottom: 2px solid #ddd; padding-bottom: 5px;">2. Hình ảnh sản phẩm</h3>
        <div class="image-section" style="margin-top: 0;">
            <div class="upload-area" onclick="document.getElementById('fileInput').click()">
                <i class="fas fa-cloud-upload-alt" style="font-size: 40px; color: #d10000; margin-bottom: 10px;"></i>
                <p style="color: #666;">Click để chọn ảnh hoặc kéo thả ảnh vào đây</p>
                <small style="color: #999;">Hỗ trợ JPG, PNG, WebP (Ảnh đầu tiên sẽ làm ảnh đại diện)</small>
                <input type="file" id="fileInput" name="images[]" multiple accept="image/*" style="display: none;" onchange="previewImages(event)">
            </div>
            <div class="preview-container" id="previewContainer"></div>
        </div>

        <!-- CÁC PHIÊN BẢN (VARIANTS) -->
        <h3 style="margin: 30px 0 10px; color: #0049d1; border-bottom: 2px solid #ddd; padding-bottom: 5px;">3. Quản lý các phiên bản cấu hình</h3>
        <div class="dynamic-section">
            <div id="variantInputArea" class="variant-input-box" style="background: white; border: 1px dashed #0049d1; padding: 15px; border-radius: 6px;">
                <div class="row">
                    <div class="form-group">
                        <label>CPU</label>
                        <input type="text" id="vCPU" placeholder="i7-13700H">
                    </div>
                    <div class="form-group">
                        <label>RAM</label>
                        <input type="text" id="vRAM" placeholder="16GB">
                    </div>
                    <div class="form-group">
                        <label>VGA</label>
                        <input type="text" id="vVGA" placeholder="RTX 4050">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>SSD / Lưu trữ</label>
                        <input type="text" id="vSSD" placeholder="512GB">
                    </div>
                    <div class="form-group">
                        <label>Giá bán (VNĐ) <span style="color:red;">*</span></label>
                        <input type="number" id="vPrice" placeholder="25000000">
                    </div>
                    <div class="form-group">
                        <label>Kho <span style="color:red;">*</span></label>
                        <input type="number" id="vStock" value="10">
                    </div>
                </div>
                <button type="button" class="add-row-btn" onclick="addVariantToList()" style="width: 100%; font-weight: bold; background: #0049d1;">
                    <i class="fas fa-plus"></i> LƯU VÀO DANH SÁCH PHIÊN BẢN
                </button>
            </div>

            <!-- Bảng lưu trữ phiên bản -->
            <div id="variantStorage" style="margin-top: 20px;">
                <strong style="color: #555;">Danh sách phiên bản đã tạo:</strong>
                <table class="variant-table" id="variantsTable">
                    <thead>
                        <tr>
                            <th>CPU / RAM / SSD</th>
                            <th>VGA</th>
                            <th>Giá bán</th>
                            <th>Kho</th>
                            <th style="width: 50px;">Xóa</th>
                        </tr>
                    </thead>
                    <tbody id="variantsListBody">
                        <!-- Variants will be added here -->
                    </tbody>
                </table>
                <div id="variantHiddenInputs"></div>
            </div>
        </div>

        <!-- THÔNG SỐ KỸ THUẬT CỐ ĐỊNH -->
        <h3 style="margin: 30px 0 10px; color: #d10000; border-bottom: 2px solid #ddd; padding-bottom: 5px;">4. Thông số kỹ thuật cố định</h3>
        <p style="font-size: 0.9rem; color: #555; margin-bottom: 15px;">(Chọn các thông số kỹ thuật bên dưới cho máy)</p>
        
        <div class="dynamic-section" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            @php
                $fixedSpecs = [
                    'Màn hình' => ['13.3" FHD', '13.3" 2.5K Retina', '14" FHD (1920x1080)', '14" FHD+ (1920x1200)', '14" 2.2K', '14" 2.8K OLED', '14.2" Liquid Retina XDR', '15.6" FHD 144Hz', '15.6" FHD 165Hz', '16" 2.5K 165Hz', '16" 3.2K 120Hz', '17.3" QHD 240Hz'],
                    'Hệ điều hành' => ['Windows 11 Home', 'Windows 11 Pro', 'macOS Sonoma', 'macOS Ventura', 'Ubuntu / Linux', 'No OS (FreeDOS)'],
                    'Pin' => ['3-cell, 41Wh', '3-cell, 50Wh', '4-cell, 54Wh', '4-cell, 60Wh', '4-cell, 70Wh', '4-cell, 80Wh', '4-cell, 90Wh', '6-cell, 71Wh', '99.9Wh (Tối đa)'],
                    'Sạc' => ['45W Adapter', '65W USB-C', '100W USB-C', '140W MagSafe 3', '170W Slim Tip', '230W Adapter', '330W Adapter'],
                    'Cổng kết nối' => ['Đầy đủ (USB-A, C, HDMI, SD)', 'Cơ bản (2x USB-C, Jack 3.5)', 'Gaming (Lan, HDMI 2.1, 3x USB 3.2)', 'Văn phòng (HDMI, 2x USB 3.2, 1x USB-C)', 'Chỉ USB-C / Thunderbolt'],
                    'Webcam' => ['720p HD', '1080p Full HD', '1080p FHD + IR (FaceID)', '1440p Quad HD', 'Không có Webcam'],
                    'Trọng lượng' => ['Siêu nhẹ (Dưới 1kg)', 'Nhẹ (1.1kg - 1.3kg)', 'Trung bình (1.4kg - 1.6kg)', 'Hơi nặng (1.7kg - 2.0kg)', 'Nặng (Trên 2.2kg)'],
                    'Màu sắc' => ['Bạc (Silver)', 'Xám (Space Gray)', 'Đen (Black)', 'Trắng (White)', 'Xanh (Blue)', 'Vàng (Gold)'],
                    'Kích thước' => ['Siêu mỏng', 'Mỏng nhẹ', 'Trung bình', 'Hầm hố (Gaming)'],
                ];
            @endphp

            @foreach($fixedSpecs as $name => $options)
            <div class="form-group" style="margin-bottom: 0;">
                <label style="font-weight: 600; color: #444;">{{ $name }}</label>
                <select name="specs[{{ $name }}]" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="">-- Chọn {{ $name }} --</option>
                    @foreach($options as $opt)
                        <option value="{{ $opt }}">{{ $opt }}</option>
                    @endforeach
                </select>
            </div>
            @endforeach
        </div>

        <div class="btn-group" style="margin-top: 40px; border-top: 1px solid #ddd; padding-top: 20px;">
            <button type="submit" class="btn-save" style="font-size: 1.2rem; padding: 15px 40px;">
                <i class="fas fa-save"></i> ĐĂNG SẢN PHẨM
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn-cancel" style="font-size: 1.2rem; padding: 15px 40px;">Hủy</a>
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

    let variantIndex = 0;
    function addVariantToList() {
        const cpu = document.getElementById('vCPU').value;
        const ram = document.getElementById('vRAM').value;
        const vga = document.getElementById('vVGA').value;
        const ssd = document.getElementById('vSSD').value;
        const price = document.getElementById('vPrice').value;
        const stock = document.getElementById('vStock').value;

        if (!cpu || !ram || !price || !stock) {
            alert('Vui lòng nhập đầy đủ: CPU, RAM, Giá bán và Kho');
            return;
        }

        const tbody = document.getElementById('variantsListBody');
        const hiddenContainer = document.getElementById('variantHiddenInputs');
        
        const rowId = 'vRow_' + variantIndex;
        
        // Add row to table
        const tr = document.createElement('tr');
        tr.id = rowId;
        tr.innerHTML = `
            <td>${cpu} / ${ram} / ${ssd}</td>
            <td>${vga}</td>
            <td>${new Intl.NumberFormat('vi-VN').format(price)} ₫</td>
            <td>${stock}</td>
            <td>
                <button type="button" onclick="removeVariantFromList('${rowId}', ${variantIndex})" style="background:none; border:none; color:red; cursor:pointer;">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        `;
        tbody.appendChild(tr);

        // Add hidden inputs to form
        const div = document.createElement('div');
        div.id = 'vHidden_' + variantIndex;
        div.innerHTML = `
            <input type="hidden" name="variants[${variantIndex}][cpu]" value="${cpu}">
            <input type="hidden" name="variants[${variantIndex}][ram]" value="${ram}">
            <input type="hidden" name="variants[${variantIndex}][vga]" value="${vga}">
            <input type="hidden" name="variants[${variantIndex}][ssd]" value="${ssd}">
            <input type="hidden" name="variants[${variantIndex}][price]" value="${price}">
            <input type="hidden" name="variants[${variantIndex}][stock]" value="${stock}">
        `;
        hiddenContainer.appendChild(div);

        // Reset inputs
        document.getElementById('vCPU').value = '';
        document.getElementById('vRAM').value = '';
        document.getElementById('vVGA').value = '';
        document.getElementById('vSSD').value = '';
        document.getElementById('vPrice').value = '';
        document.getElementById('vStock').value = '10';

        variantIndex++;
    }

    function removeVariantFromList(rowId, index) {
        document.getElementById(rowId).remove();
        document.getElementById('vHidden_' + index).remove();
    }

    // Specs are now fixed, dynamic adding is disabled
    function addSpecRow() {
        console.log("Specs are now fixed.");
    }
</script>
@endpush