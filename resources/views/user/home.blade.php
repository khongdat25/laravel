@extends('layouts.master')

@section('title', 'Laptop Store - Thế giới Công nghệ')

@push('styles')
    {{-- Gọi file CSS dành riêng cho trang chủ --}}
    @vite('resources/css/pages/home.css')
@endpush

@section('content')
  <div class="main-container">

    <aside class="sidebar">
      <h2>Danh mục</h2>
      <ul class="category-list">

        <li class="has-submenu">
          <a href="/san-pham">Laptop Gaming <i class="fas fa-chevron-right" style="float:right; font-size: 0.8rem; margin-top:5px;"></i></a>
          <div class="submenu">
            <div class="brand-grid">
              <div class="brand"><strong>ASUS</strong><ul><li><a href="#">ROG Strix G16</a></li><li><a href="#">TUF Gaming A15</a></li><li><a href="#">ROG Zephyrus</a></li></ul></div>
              <div class="brand"><strong>Lenovo</strong><ul><li><a href="#">Legion 5 Pro</a></li><li><a href="#">IdeaPad Gaming</a></li><li><a href="#">LOQ Series</a></li></ul></div>
              <div class="brand"><strong>MSI</strong><ul><li><a href="#">Katana 15</a></li><li><a href="#">Cyborg 15</a></li><li><a href="#">Titan GT</a></li></ul></div>
              <div class="brand"><strong>Gigabyte</strong><ul><li><a href="#">Aorus 15X</a></li><li><a href="#">G5 KF</a></li><li><a href="#">Aero 16</a></li></ul></div>
              <div class="brand"><strong>Dell</strong><ul><li><a href="#">Alienware m16</a></li><li><a href="#">Alienware x14</a></li><li><a href="#">Dell G15 / G16</a></li></ul></div>
              <div class="brand"><strong>HP</strong><ul><li><a href="#">Omen 16</a></li><li><a href="#">Victus 15</a></li><li><a href="#">Victus 16</a></li></ul></div>
            </div>
          </div>
        </li>

        <li class="has-submenu">
          <a href="/admin/categories">Laptop Văn phòng <i class="fas fa-chevron-right" style="float:right; font-size: 0.8rem; margin-top:5px;"></i></a>
          <div class="submenu">
            <div class="brand-grid">
              <div class="brand"><strong>ASUS</strong><ul><li><a href="#">ZenBook Series</a></li><li><a href="#">VivoBook Series</a></li><li><a href="#">ExpertBook</a></li></ul></div>
              <div class="brand"><strong>Lenovo</strong><ul><li><a href="#">ThinkPad Series</a></li><li><a href="#">IdeaPad Slim</a></li><li><a href="#">ThinkBook</a></li></ul></div>
              <div class="brand"><strong>Dell</strong><ul><li><a href="#">Inspiron Series</a></li><li><a href="#">Vostro Series</a></li><li><a href="#">Latitude</a></li></ul></div>
              <div class="brand"><strong>HP</strong><ul><li><a href="#">Pavilion Series</a></li><li><a href="#">Envy Series</a></li><li><a href="#">ProBook</a></li></ul></div>
              <div class="brand"><strong>Acer</strong><ul><li><a href="#">Swift Series</a></li><li><a href="#">Aspire Series</a></li></ul></div>
              <div class="brand"><strong>MSI</strong><ul><li><a href="#">Modern Series</a></li><li><a href="#">Prestige Series</a></li></ul></div>
            </div>
          </div>
        </li>

        <li class="has-submenu">
          <a href="#">MacBook <i class="fas fa-chevron-right" style="float:right; font-size: 0.8rem; margin-top:5px;"></i></a>
          <div class="submenu">
            <div class="brand-grid">
              <div class="brand"><strong>MacBook Air</strong><ul><li><a href="#">MacBook Air M1</a></li><li><a href="#">MacBook Air M2</a></li><li><a href="#">MacBook Air M3</a></li></ul></div>
              <div class="brand"><strong>MacBook Pro 14"</strong><ul><li><a href="#">MacBook Pro M3</a></li><li><a href="#">MacBook Pro M3 Pro</a></li><li><a href="#">MacBook Pro M3 Max</a></li></ul></div>
              <div class="brand"><strong>MacBook Pro 16"</strong><ul><li><a href="#">MacBook Pro M3 Pro</a></li><li><a href="#">MacBook Pro M3 Max</a></li></ul></div>
              <div class="brand"><strong>Mac Desktop</strong><ul><li><a href="#">iMac 24-inch</a></li><li><a href="#">Mac mini</a></li><li><a href="#">Mac Studio</a></li></ul></div>
              <div class="brand"><strong>Phụ kiện Apple</strong><ul><li><a href="#">Magic Mouse</a></li><li><a href="#">Magic Keyboard</a></li><li><a href="#">AirPods</a></li></ul></div>
            </div>
          </div>
        </li>

        <li class="has-submenu">
          <a href="#">Laptop Đồ họa <i class="fas fa-chevron-right" style="float:right; font-size: 0.8rem; margin-top:5px;"></i></a>
          <div class="submenu">
            <div class="brand-grid">
              <div class="brand"><strong>Dell</strong><ul><li><a href="#">Dell XPS Series</a></li><li><a href="#">Dell Precision</a></li></ul></div>
              <div class="brand"><strong>ASUS</strong><ul><li><a href="#">ProArt Studiobook</a></li><li><a href="#">ZenBook Pro</a></li></ul></div>
              <div class="brand"><strong>Lenovo</strong><ul><li><a href="#">ThinkPad P Series</a></li><li><a href="#">Yoga Pro</a></li></ul></div>
              <div class="brand"><strong>HP</strong><ul><li><a href="#">ZBook Series</a></li><li><a href="#">Envy x360</a></li></ul></div>
              <div class="brand"><strong>Acer</strong><ul><li><a href="#">ConceptD Series</a></li></ul></div>
              <div class="brand"><strong>Apple</strong><ul><li><a href="#">MacBook Pro M-Series</a></li></ul></div>
            </div>
          </div>
        </li>

        <li class="has-submenu">
          <a href="#">Phụ kiện <i class="fas fa-chevron-right" style="float:right; font-size: 0.8rem; margin-top:5px;"></i></a>
          <div class="submenu">
            <div class="brand-grid">
              <div class="brand"><strong>Chuột máy tính</strong><ul><li><a href="#">Logitech</a></li><li><a href="#">Razer</a></li><li><a href="#">Corsair</a></li></ul></div>
              <div class="brand"><strong>Bàn phím</strong><ul><li><a href="#">Bàn phím cơ Akko</a></li><li><a href="#">Keychron</a></li><li><a href="#">DareU</a></li></ul></div>
              <div class="brand"><strong>Tai nghe</strong><ul><li><a href="#">Sony</a></li><li><a href="#">HyperX</a></li><li><a href="#">JBL</a></li></ul></div>
              <div class="brand"><strong>Balo - Túi xách</strong><ul><li><a href="#">Túi chống sốc</a></li><li><a href="#">Balo Laptop</a></li></ul></div>
              <div class="brand"><strong>Cổng chuyển đổi</strong><ul><li><a href="#">Hub UGREEN</a></li><li><a href="#">Hub Baseus</a></li></ul></div>
              <div class="brand"><strong>Khác</strong><ul><li><a href="#">Đế tản nhiệt</a></li><li><a href="#">Lót chuột</a></li></ul></div>
            </div>
          </div>
        </li>
      </ul>
    </aside>

    <section class="slider-section">
      <div class="slider">
        <div class="slides" id="slides">
          <div class="slide"><img src="{{ asset('Image/banner1.png') }}" alt="Banner 1"></div>
          <div class="slide"><img src="https://images.unsplash.com/photo-1611078489935-0cb4c2497a00?w=900&auto=format" alt="Banner 2"></div>
          <div class="slide"><img src="https://images.unsplash.com/photo-1588872657578-10efd656b5d9?w=900&auto=format" alt="Banner 3"></div>
          <div class="slide"><img src="https://images.unsplash.com/photo-1593642632559-0c6d3fc62b89?w=900&auto=format" alt="Banner 4"></div>
        </div>
      </div>
    </section>

    <aside class="right-banner">
      <img src="https://images.unsplash.com/photo-1588109273901-15e94e39e6d3?w=400&auto=format&fit=crop&q=80" alt="Ads">
    </aside>
  </div>

  <section class="best-selling-section">
    <div class="section-header">
      <div class="header-left">
        <h2 class="section-title"><i class="fas fa-fire"></i> SẢN PHẨM BÁN CHẠY</h2>
      </div>
      <div class="header-right">
        <ul class="sub-categories">
          <li><a href="#" class="active">tất cả</a></li>
          <li><a href="#">Laptop Văn Phòng</a></li>
          <li><a href="#">Laptop Văn Phòng</a></li>
          <li><a href="#">MacBook</a></li>
        </ul>
      </div>
    </div>

    <div class="product-grid">
      @foreach($bestSellingProducts as $item)
      <div class="product-card">
          <div class="product-img">
              @if($item->image)
                  <img src="{{ $item->image }}" alt="{{ $item->name }}">
              @else
                  <img src="https://images.unsplash.com/photo-1603302576834-0d1a7099d69d?w=400&auto=format" alt="{{ $item->name }}">
              @endif
          </div>
          <div class="product-info">
              <h3 class="product-name" style="height: 48px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">{{ $item->name }}</h3>
              <p class="product-price">{{ number_format($item->price) }}₫</p>
              <a href="/san-pham/{{ $item->id }}" style="text-decoration: none;"><button class="buy-btn" style="width: 100%;">Xem chi tiết</button></a>
          </div>
      </div>
      @endforeach
    </div>
  </section>

  <section class="ad-banner-full">
    <img src="{{ asset('Image/banner1.png') }}" alt="Siêu sale giảm giá cho sinh viên">
  </section>

  <section class="best-gaming-section">
    <div class="section-header">
      <div class="header-left">
        <h2 class="section-title"><i class="fas fa-fire"></i> SẢN PHẨM GAMING</h2>
      </div>
      <div class="header-right">
        <ul class="sub-categories">
          <li><a href="#" class="active">tất cả</a></li>
          <li><a href="#">LENOVO</a></li>
          <li><a href="#">ASUS</a></li>
          <li><a href="#">Dell</a></li>
          <li><a href="#">ACER</a></li>
          <li><a href="#">MSI</a></li>
          <li><a href="#">GIGABYTE</a></li>
        </ul>
      </div>
    </div>

    <div class="product-grid">
      <div class="product-card">
        <div class="product-img"><img src="https://images.unsplash.com/photo-1603302576834-0d1a7099d69d?w=400&auto=format" alt="Laptop"></div>
        <div class="product-info">
          <h3 class="product-name">Lenovo Legion 5 Pro 2024 i9-14900HX</h3>
          <p class="product-price">35.990.000₫</p>
          <button class="buy-btn">Mua ngay</button>
        </div>
      </div>
      <div class="product-card">
        <div class="product-img"><img src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?w=400&auto=format" alt="Laptop"></div>
        <div class="product-info">
          <h3 class="product-name">ASUS ROG Strix G16 G614J RTX 4060</h3>
          <p class="product-price">32.450.000₫</p>
          <button class="buy-btn">Mua ngay</button>
        </div>
      </div>
      <div class="product-card">
        <div class="product-img"><img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=400&auto=format" alt="Laptop"></div>
        <div class="product-info">
          <h3 class="product-name">MacBook Air M3 13 inch 2024 - 16GB RAM</h3>
          <p class="product-price">27.890.000₫</p>
          <button class="buy-btn">Mua ngay</button>
        </div>
      </div>
      <div class="product-card">
        <div class="product-img"><img src="https://images.unsplash.com/photo-1588872657578-10efd656b5d9?w=400&auto=format" alt="Laptop"></div>
        <div class="product-info">
          <h3 class="product-name">Dell XPS 13 9340 Core Ultra 7 2024</h3>
          <p class="product-price">42.100.000₫</p>
          <button class="buy-btn">Mua ngay</button>
        </div>
      </div>
    </div>
  </section>

  <section class="product-section">
    <div class="section-header">
      <div class="header-left">
        <h2 class="section-title title-news"><i class="far fa-newspaper"></i> TIN TỨC CÔNG NGHỆ</h2>
      </div>
      <div class="header-right">
        <a href="#" style="color: #007bff; text-decoration: none; font-weight: 500;">Xem tất cả <i class="fas fa-angle-right"></i></a>
      </div>
    </div>

    <div class="news-grid">
      <div class="news-card">
        <div class="news-img">
          <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&auto=format&fit=crop" alt="Tin tức 1">
        </div>
        <div class="news-info">
          <h3 class="news-title">Intel ra mắt vi xử lý Core Ultra thế hệ mới, tích hợp NPU xử lý AI cực mạnh</h3>
          <p class="news-date"><i class="far fa-clock"></i> 12 Tháng 3, 2026</p>
        </div>
      </div>
      <div class="news-card">
        <div class="news-img">
          <img src="https://images.unsplash.com/photo-1531297484001-80022131f5a1?w=600&auto=format&fit=crop" alt="Tin tức 2">
        </div>
        <div class="news-info">
          <h3 class="news-title">Đánh giá chi tiết MacBook Pro M4: Sức mạnh vượt trội, pin dùng liên tục 22 giờ</h3>
          <p class="news-date"><i class="far fa-clock"></i> 10 Tháng 3, 2026</p>
        </div>
      </div>
      <div class="news-card">
        <div class="news-img">
          <img src="https://images.unsplash.com/photo-1542393545-10f5cde2c810?w=600&auto=format&fit=crop" alt="Tin tức 3">
        </div>
        <div class="news-info">
          <h3 class="news-title">Top 5 Laptop Gaming đáng mua nhất dành cho sinh viên IT năm 2026</h3>
          <p class="news-date"><i class="far fa-clock"></i> 08 Tháng 3, 2026</p>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
    {{-- Gọi file JS dành riêng cho trang chủ --}}
    @vite('resources/js/pages/home.js')
@endpush
