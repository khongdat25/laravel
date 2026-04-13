@extends('layouts.master')

@section('title', 'Chi tiết sản phẩm - Laptop Store')

@push('styles')
    @vite('resources/css/layouts/header.css')
    @vite('resources/css/layouts/footer.css')
    @vite('resources/css/pages/detail.css')
@endpush

@section('content')
  <div class="breadcrumb">
    <a href="/"><i class="fas fa-home"></i> Trang chủ</a> 
    <span>/</span> 
    @if($product->category)
        <a href="/san-pham?category={{ $product->category->id }}">{{ $product->category->name }}</a> 
        <span>/</span> 
    @endif
    <span>{{ $product->name }}</span>
  </div>

  <div class="product-detail-container">
    <!-- Ảnh sản phẩm -->
    <div class="product-images">
      @if($product->mainImage)
        <img id="mainImg" src="{{ asset('storage/' . $product->mainImage->image_path) }}" alt="{{ $product->name }}" class="main-image">
      @else
        <img id="mainImg" src="https://images.unsplash.com/photo-1603302576834-0d1a7099d69d?w=800&auto=format" alt="{{ $product->name }}" class="main-image">
      @endif
      <div class="thumbnails">
        @if($product->images->count() > 0)
            @foreach($product->images as $index => $image)
                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->name }} {{ $index }}" class="thumbnail {{ $index == 0 ? 'active' : '' }}" onclick="changeImage(this)">
            @endforeach
        @elseif($product->mainImage)
            <img src="{{ asset('storage/' . $product->mainImage->image_path) }}" alt="{{ $product->name }} main" class="thumbnail active" onclick="changeImage(this)">
        @endif
      </div>
    </div>

    <!-- Thông tin sản phẩm -->
    <div class="product-info">
      <h1 class="product-title">{{ $product->name }}</h1>
      
      <!-- Rating -->
      <div style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
          <span style="color: #ff9800; font-size: 1.2rem;">⭐⭐⭐⭐⭐</span>
          <span style="color: #666;">({{ number_format(rand(50, 500)) }} đánh giá)</span>
      </div>

      <div class="price">
        @if($selectedVariant)
            @php
                $vAtt = [];
                foreach($selectedVariant->attributeValues as $av) {
                    $vAtt[$av->attribute->name] = $av->value;
                }
                // Thêm cấu hình vào sau tên máy cho rõ ràng
                $vFullName = $product->name . ' - ' . ($vAtt['CPU'] ?? '') . ' / ' . ($vAtt['RAM'] ?? '') . ' / ' . ($vAtt['SSD'] ?? '');
            @endphp
            <span id="currentPrice">{{ number_format($selectedVariant->price) }} ₫</span>
            @if($selectedVariant->original_price > $selectedVariant->price)
                <span class="old-price">{{ number_format($selectedVariant->original_price) }} ₫</span>
            @endif
            <div style="font-size: 0.9rem; color: #666; margin-top: 5px;">
                Tình trạng: <strong>{{ $selectedVariant->stock > 0 ? 'Còn hàng' : 'Hết hàng' }}</strong> ({{ $selectedVariant->stock }} sản phẩm)
            </div>
            
            <div style="margin-top: 15px; padding: 10px; background: #f8f9fa; border-radius: 6px; font-size: 0.9rem;">
                <strong>Cấu hình chi tiết:</strong>
                <ul style="margin: 5px 0 0 15px; padding: 0;">
                    <li>CPU: {{ $vAtt['CPU'] ?? 'Theo máy' }}</li>
                    <li>RAM: {{ $vAtt['RAM'] ?? 'Theo máy' }}</li>
                    <li>VGA: {{ $vAtt['VGA'] ?? 'Bản chuẩn' }}</li>
                    <li>SSD: {{ $vAtt['SSD'] ?? 'Theo máy' }}</li>
                </ul>
            </div>
        @else
            Liên hệ
        @endif
      </div>
      <div class="description">{!! $product->description !!}</div>

        @if($product->brand)
          <strong><i class="fas fa-tag" style="width: 20px; color: #d10000;"></i> Thương hiệu:</strong> {{ $product->brand->name }}<br>
        @endif

      <!-- Delivery Info -->
      <div style="padding: 15px; background: #e8f5e9; border-radius: 8px; border-left: 4px solid #4caf50; font-size: 0.95rem;">
          <p style="margin: 5px 0;"><strong>✓ Giao hàng miễn phí</strong> cho đơn hàng trên 10 triệu</p>
          <p style="margin: 5px 0;"><strong>✓ Bảo hành</strong> 12 tháng chính hãng</p>
          <p style="margin: 5px 0;"><strong>✓ Hỗ trợ 24/7</strong> sau bán hàng</p>
      </div>

      @if($selectedVariant)
      <form action="{{ route('cart.add') }}" method="POST">
        @csrf
        <input type="hidden" name="variant_id" value="{{ $selectedVariant->id }}">
        <input type="hidden" name="quantity" value="1" min="1">
        <div class="buttons">
          <button type="submit" class="btn buy-now"><i class="fas fa-shopping-bag"></i> Mua ngay</button>
          <button type="submit" class="btn add-cart"><i class="fas fa-cart-plus"></i> Thêm vào giỏ</button>
        </div>
      </form>
      @else
      <div class="buttons">
        <button class="btn add-cart" disabled style="background: #ccc; cursor: not-allowed;">Hết hàng</button>
      </div>
      @endif
    </div>
  </div>

  <!-- Thông số kỹ thuật -->
  <div class="details">
    <h2 class="details-section-title">Thông số kỹ thuật chi tiết</h2>
    <table class="specs-table">
        @php $hasSpec = false; @endphp
        
        <!-- Thông số của phiên bản hiện tại -->
        @if($selectedVariant)
            @php 
                $vAt = [];
                foreach($selectedVariant->attributeValues as $av) {
                    $vAt[$av->attribute->name] = $av->value;
                }
                $hasSpec = true;
            @endphp
            <tr>
                <th>Vi xử lý (CPU)</th>
                <td>{{ $vAt['CPU'] ?? 'Theo máy' }}</td>
            </tr>
            <tr>
                <th>Bộ nhớ RAM</th>
                <td>{{ $vAt['RAM'] ?? 'Theo máy' }}</td>
            </tr>
            <tr>
                <th>Card đồ họa (VGA)</th>
                <td>{{ $vAt['VGA'] ?? 'Bản chuẩn' }}</td>
            </tr>
            <tr>
                <th>Ổ cứng (SSD)</th>
                <td>{{ $vAt['SSD'] ?? 'Theo máy' }}</td>
            </tr>
        @endif

        <!-- Thông số tĩnh từ product_specifications -->
        @if($product->specifications->count() > 0)
            @foreach($product->specifications as $spec)
                @php $hasSpec = true; @endphp
                <tr>
                    <th>{{ $spec->name }}</th>
                    <td>{{ $spec->value }}</td>
                </tr>
            @endforeach
        @endif
        
        @if($product->brand)
            @php $hasSpec = true; @endphp
            <tr>
                <th>Thương hiệu</th>
                <td>{{ $product->brand->name }}</td>
            </tr>
        @endif
        
        @if(!$hasSpec)
            <tr><td colspan="2" style="text-align: center; padding: 20px; color: #888;">Thông số kỹ thuật đang được cập nhật...</td></tr>
        @endif
    </table>
  </div>

  <!-- Hỏi đáp kiểu bình luận -->
  <div class="comments">
    <h2 class="details-section-title">Hỏi đáp & Bình luận</h2>

    <div class="comment">
      <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100" alt="User" class="comment-avatar">
      <div class="comment-content">
        <div class="comment-header">
          <span class="comment-author">Nguyễn Văn A</span>
          <span class="comment-time">2 ngày trước</span>
        </div>
        <div class="comment-text">Máy này chạy Final Cut Pro mượt không anh em? Có lag khi render 4K không?</div>
      </div>
    </div>

    <div class="comment">
      <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100" alt="User" class="comment-avatar">
      <div class="comment-content">
        <div class="comment-header">
          <span class="comment-author">Lê Thị B</span>
          <span class="comment-time">1 ngày trước</span>
        </div>
        <div class="comment-text">Mình đang dùng M3 Pro, nâng cấp lên M4 Pro thấy khác biệt rõ nhất là tốc độ export video nhanh hơn ~30%. Rất đáng nâng cấp nếu bạn edit nhiều!</div>
      </div>
    </div>

    <div class="comment">
      <img src="https://images.unsplash.com/photo-1552058544-f2b08422138a?w=100" alt="User" class="comment-avatar">
      <div class="comment-content">
        <div class="comment-header">
          <span class="comment-author">Trần Văn C</span>
          <span class="comment-time">3 giờ trước</span>
        </div>
        <div class="comment-text">Có chương trình trade-in cũ lấy mới không shop? Máy M2 Pro của mình còn zin 95%.</div>
      </div>
    </div>

    <div class="comment">
      <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100" alt="User" class="comment-avatar">
      <div class="comment-content">
        <div class="comment-header">
          <span class="comment-author" style="color: #d10000;">LaptopStore Support</span>
          <span class="comment-time">Vừa trả lời</span>
        </div>
        <div class="comment-text">Chào anh Trần Văn C, hiện shop có chương trình trade-in, anh gửi ảnh máy + hóa đơn cũ để bên em báo giá hỗ trợ nhé! Hotline 1800 1234 hoặc inbox fanpage để được tư vấn chi tiết ạ.</div>
      </div>
    </div>
  </div>

  <!-- Sản phẩm tương tự -->
  <div class="similar-products">
    <h2 class="similar-products-title">Sản phẩm tương tự</h2>
    <div class="detail-product-grid">
      @foreach($similarProducts as $simProduct)
      <div class="detail-product-card">
        @if($simProduct->mainImage)
            <img src="{{ asset('storage/' . $simProduct->mainImage->image_path) }}" alt="{{ $simProduct->name }}" class="detail-product-img">
        @else
            <img src="https://images.unsplash.com/photo-1603302576834-0d1a7099d69d?w=400&auto=format" alt="{{ $simProduct->name }}" class="detail-product-img">
        @endif
        <div class="detail-product-info">
          <div class="detail-product-name">{{ $simProduct->name }}</div>
          <div class="detail-product-price">
            @if($simProduct->variants->count() > 0)
                {{ number_format($simProduct->variants->min('price')) }} ₫
            @else
                Liên hệ
            @endif
          </div>
          <a href="/san-pham/{{ $simProduct->id }}" class="btn-detail">Xem chi tiết</a>
        </div>
      </div>
      @endforeach
      @if($similarProducts->isEmpty())
        <p style="grid-column: 1/-1; text-align: center; color: #888;">Chưa có sản phẩm tương tự.</p>
      @endif
    </div>
  </div>
@endsection

@push('scripts')
    @vite('resources/js/pages/detail.js')
    <script>
        function changeImage(img) {
            document.getElementById('mainImg').src = img.src;
            document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
            img.classList.add('active');
        }
        document.querySelector('.add-cart').closest('form').addEventListener('submit', function(e){
          e.preventDefault();
          let formData = new FormData(this);
          //AJAX
          fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
              'X-Requested-With': 'XMLHttpRequest',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
          })
          .then(response => {
            if(!response.ok && response.status != 401){
              throw new Error('có lỗi xảy ra ');
            }
            return response.json();
          })
          .then(data => {
            if(data.success){
              document.getElementById('cart-count').textContent = data.totalCount;
              alert(data.message);
            }else {
              alert(data.message);
              if(data.message == 'Bạn cần đăng nhập mới được thêm vào giỏ hàng'){
                window.location.href = '/login';
              }
            }
          })
          .catch(error => console.log('Error:', error));
          
        });
            
    </script>
@endpush
