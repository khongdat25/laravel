@extends('layouts.master')

@section('title', 'Chi tiết sản phẩm - Laptop Store')

@push('styles')
    @vite('resources/css/pages/detail.css')
@endpush

@section('content')
  <div class="breadcrumb">
    <a href="/"><i class="fas fa-home"></i> Trang chủ</a> 
    <span>/</span> 
    <a href="/san-pham">Laptop Gaming</a> 
    <span>/</span> 
    <span>MacBook Pro 14" M4 Pro</span>
  </div>

  <div class="product-detail-container">
    <!-- Ảnh sản phẩm -->
    <div class="product-images">
      <img id="mainImg" src="https://reviewed-com-res.cloudinary.com/image/fetch/s--Tdfd_mAt--/b_white,c_limit,cs_srgb,f_auto,fl_progressive.strip_profile,g_center,h_668,q_auto,w_1187/https://reviewed-production.s3.amazonaws.com/1707514980229/AppleMacBookPro14M3ReviewFrontRight2.jpg" alt="MacBook Pro 14 M4 Pro" class="main-image">
      <div class="thumbnails">
        <img src="https://reviewed-com-res.cloudinary.com/image/fetch/s--Tdfd_mAt--/b_white,c_limit,cs_srgb,f_auto,fl_progressive.strip_profile,g_center,h_668,q_auto,w_1187/https://reviewed-production.s3.amazonaws.com/1707514980229/AppleMacBookPro14M3ReviewFrontRight2.jpg" alt="Front" class="thumbnail active" onclick="changeImage(this)">
        <img src="https://support.apple.com/library/APPLE/APPLECARE_ALLGEOS/SP850/macbook-pro-14-in-m4-pro-m4-max-202410-gallery1.jpg" alt="Side" class="thumbnail" onclick="changeImage(this)">
        <img src="https://support.apple.com/library/APPLE/APPLECARE_ALLGEOS/SP850/macbook-pro-14-in-m4-pro-m4-max-202410-gallery2.jpg" alt="Keyboard" class="thumbnail" onclick="changeImage(this)">
        <img src="https://support.apple.com/library/APPLE/APPLECARE_ALLGEOS/SP850/macbook-pro-14-in-m4-pro-m4-max-202410-gallery3.jpg" alt="Ports" class="thumbnail" onclick="changeImage(this)">
      </div>
    </div>

    <!-- Thông tin sản phẩm -->
    <div class="product-info">
      <h1 class="product-title">MacBook Pro 14" M4 Pro (2025) - 24GB RAM / 1TB SSD</h1>
      
      <!-- Rating -->
      <div style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
          <span style="color: #ff9800; font-size: 1.2rem;">⭐⭐⭐⭐⭐</span>
          <span style="color: #666;">(128 đánh giá)</span>
      </div>

      <div class="price">59.990.000 ₫ <span class="old-price">62.990.000 ₫</span></div>
      <p class="description">Siêu phẩm sáng tạo với chip M4 Pro mạnh mẽ, màn Liquid Retina XDR 120Hz, pin trâu lên đến 22 giờ. Hoàn hảo cho edit video, code, thiết kế đồ họa chuyên nghiệp.</p>

      <div style="margin:20px 0; line-height: 1.8; color: #444;">
        <strong><i class="fas fa-palette" style="width: 20px; color: #d10000;"></i> Màu sắc:</strong> Space Black / Silver<br>
        <strong><i class="fas fa-shield-alt" style="width: 20px; color: #d10000;"></i> Bảo hành:</strong> 12 tháng chính hãng Apple Việt Nam<br>
        <strong><i class="fas fa-box" style="width: 20px; color: #d10000;"></i> Tình trạng:</strong> Mới 100% - Full Box
      </div>

      <!-- Delivery Info -->
      <div style="padding: 15px; background: #e8f5e9; border-radius: 8px; border-left: 4px solid #4caf50; font-size: 0.95rem;">
          <p style="margin: 5px 0;"><strong>✓ Giao hàng miễn phí</strong> cho đơn hàng trên 10 triệu</p>
          <p style="margin: 5px 0;"><strong>✓ Bảo hành</strong> 12 tháng chính hãng</p>
          <p style="margin: 5px 0;"><strong>✓ Hỗ trợ 24/7</strong> sau bán hàng</p>
      </div>

      <div class="buttons">
        <button class="btn buy-now"><i class="fas fa-shopping-bag"></i> Mua ngay</button>
        <button class="btn add-cart"><i class="fas fa-cart-plus"></i> Thêm vào giỏ</button>
      </div>
    </div>
  </div>

  <!-- Thông số kỹ thuật -->
  <div class="details">
    <h2 class="details-section-title">Thông số kỹ thuật chi tiết</h2>
    <table>
      <tr><th>Chip</th><td>Apple M4 Pro (14-core CPU: 10 performance + 4 efficiency, 20-core GPU, 16-core Neural Engine)</td></tr>
      <tr><th>RAM</th><td>24GB unified memory</td></tr>
      <tr><th>Lưu trữ</th><td>1TB SSD</td></tr>
      <tr><th>Màn hình</th><td>14.2-inch Liquid Retina XDR, 3024x1964, 120Hz ProMotion</td></tr>
      <tr><th>Pin</th><td>Lên đến 22 giờ xem video</td></tr>
      <tr><th>Cổng</th><td>3x Thunderbolt 5, HDMI, SDXC, MagSafe 3</td></tr>
      <tr><th>Trọng lượng</th><td>1.60 kg</td></tr>
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
      <div class="detail-product-card">
        <img src="https://i.rtings.com/assets/products/achdBcky/apple-macbook-pro-16-m3-2023/design-medium.jpg?format=auto" alt="MacBook Pro 16 M4 Max" class="detail-product-img">
        <div class="detail-product-info">
          <div class="detail-product-name">MacBook Pro 16" M4 Max 48GB/1TB</div>
          <div class="detail-product-price">89.990.000 ₫</div>
          <a href="#" class="btn-detail">Xem chi tiết</a>
        </div>
      </div>

      <div class="detail-product-card">
        <img src="https://images.unsplash.com/photo-1611078489935-0cb4c2497a00?w=500" alt="ASUS Zenbook Pro" class="detail-product-img">
        <div class="detail-product-info">
          <div class="detail-product-name">ASUS Zenbook Pro 14 OLED (Intel Ultra 9)</div>
          <div class="detail-product-price">45.990.000 ₫</div>
          <a href="#" class="btn-detail">Xem chi tiết</a>
        </div>
      </div>

      <div class="detail-product-card">
        <img src="https://i.dell.com/is/image/DellContent/content/dam/ss2/product-images/dell-client-products/notebooks/dell-premium/da14250/media-gallery/platinum/touch/notebook-dell-premium-da14250t-sl-gallery-1.psd?fmt=png-alpha&pscan=auto&scl=1&hei=804&wid=1086&qlt=100,1&resMode=sharp2&size=1086,804&chrss=full" alt="Dell XPS 14" class="detail-product-img">
        <div class="detail-product-info">
          <div class="detail-product-name">Dell XPS 14 2026 (Intel Core Ultra 7)</div>
          <div class="detail-product-price">48.990.000 ₫</div>
          <a href="#" class="btn-detail">Xem chi tiết</a>
        </div>
      </div>

      <div class="detail-product-card">
        <img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=500" alt="MacBook Air M5" class="detail-product-img">
        <div class="detail-product-info">
          <div class="detail-product-name">MacBook Air 15" M5 16GB/512GB</div>
          <div class="detail-product-price">34.990.000 ₫</div>
          <a href="#" class="btn-detail">Xem chi tiết</a>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
    @vite('resources/js/pages/detail.js')
@endpush
