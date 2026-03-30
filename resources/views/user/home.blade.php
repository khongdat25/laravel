@extends('layouts.master')

@section('title', 'Laptop Store - Thế giới Công nghệ')

@push('styles')
    {{-- Gọi file CSS dành riêng cho trang chủ --}}
    @vite('resources/css/pages/home.css')
    @vite('resources/css/layouts/footer.css')
@endpush

@section('content')
  <div class="main-container">

    <aside class="sidebar">
      <h2>Danh mục</h2>
      <ul class="category-list">
        @foreach($categories as $category)
        <li class="has-submenu">
          <a href="/san-pham?category={{ $category->id }}">{{ $category->name }} @if($brands->count() > 0)<i class="fas fa-chevron-right" style="float:right; font-size: 0.8rem; margin-top:5px;"></i>@endif</a>
          @if($brands->count() > 0)
          <div class="submenu">
            <div class="brand-grid">
              @foreach($brands as $brand)
                @php
                  // Lấy các sản phẩm thuộc danh mục và hãng này
                  $categoryBrandProducts = $brand->products->where('category_id', $category->id);
                @endphp
                @if($categoryBrandProducts->count() > 0)
                <div class="brand">
                  <strong><a href="/san-pham?category={{ $category->id }}&brand={{ $brand->id }}" style="color: inherit; text-decoration: none;">{{ $brand->name }}</a></strong>
                  <ul>
                    @foreach($categoryBrandProducts->take(4) as $prod)
                    <li><a href="/san-pham/{{ $prod->id }}" title="{{ $prod->name }}">{{ \Illuminate\Support\Str::limit($prod->name, 25) }}</a></li>
                    @endforeach
                  </ul>
                </div>
                @endif
              @endforeach
            </div>
          </div>
          @endif
        </li>
        @endforeach
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
              @if($item->mainImage)
                  <img src="{{ $item->mainImage->image_path }}" alt="{{ $item->name }}">
              @else
                  <img src="https://images.unsplash.com/photo-1603302576834-0d1a7099d69d?w=400&auto=format" alt="{{ $item->name }}">
              @endif
          </div>
          <div class="product-info">
              <h3 class="product-name" style="height: 48px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">{{ $item->name }}</h3>
              <p class="product-price">
                  @if($item->variants->count() > 0)
                      {{ number_format($item->variants->min('price')) }}₫
                  @else
                      Liên hệ
                  @endif
              </p>
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
