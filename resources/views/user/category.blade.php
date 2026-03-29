@extends('layouts.master')

@section('title', 'Laptop Gaming - Laptop Store')

@push('styles')
    @vite('resources/css/pages/category.css')
@endpush

@section('content')
  <div class="breadcrumb"><a href="index.html"><i class="fas fa-home"></i> Trang chủ</a> <span>/</span> Laptop Gaming</div>

  <section class="brand-section">
    <h2 class="section-title-cat">Chọn Theo Thương Hiệu</h2>
    <div class="brand-grid-6">
      @if(isset($brands) && count($brands) > 0)
          @foreach($brands as $brand)
          <a href="/san-pham?brand={{ $brand->id }}" class="brand-box">
              <i class="fas fa-laptop"></i> {{ $brand->name }}
          </a>
          @endforeach
      @endif
    </div>
  </section>

  <section class="product-section">
    <h2 class="section-title-cat">Sản Phẩm Nổi Bật</h2>
    <div class="slider-wrapper">
      <button class="slider-btn prev-btn" id="prevHotBtn"><i class="fas fa-chevron-left"></i></button>

      <div class="product-track" id="hotTrack">
        <div class="product-card">
          <span class="badge-hot">Bán chạy</span>
          <div class="product-img"><img src="https://images.unsplash.com/photo-1603302576834-0d1a7099d69d?w=400&auto=format" alt="Laptop"></div>
          <div class="product-info">
            <h3 class="product-name">Lenovo Legion 5 Pro 2024 i9-14900HX</h3>
            <p class="product-price">35.990.000₫</p>
            <button class="buy-btn">Thêm vào giỏ</button>
          </div>
        </div>
        <div class="product-card">
          <span class="badge-hot">Mới về</span>
          <div class="product-img"><img src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?w=400&auto=format" alt="Laptop"></div>
          <div class="product-info">
            <h3 class="product-name">ASUS ROG Strix G16 G614J RTX 4060</h3>
            <p class="product-price">32.450.000₫</p>
            <button class="buy-btn">Thêm vào giỏ</button>
          </div>
        </div>
        <div class="product-card">
          <div class="product-img"><img src="https://images.unsplash.com/photo-1588872657578-10efd656b5d9?w=400&auto=format" alt="Laptop"></div>
          <div class="product-info">
            <h3 class="product-name">Dell Alienware m16 R2 Ultra 7 155H</h3>
            <p class="product-price">48.200.000₫</p>
            <button class="buy-btn">Thêm vào giỏ</button>
          </div>
        </div>
        <div class="product-card">
          <span class="badge-hot">-15%</span>
          <div class="product-img"><img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=400&auto=format" alt="Laptop"></div>
          <div class="product-info">
            <h3 class="product-name">MSI Katana 15 B13VFK i7-13620H</h3>
            <p class="product-price">29.490.000₫</p>
            <button class="buy-btn">Thêm vào giỏ</button>
          </div>
        </div>
        <div class="product-card">
          <div class="product-img"><img src="https://images.unsplash.com/photo-1629131726692-1accd0c53ce0?w=400&auto=format" alt="Laptop"></div>
          <div class="product-info">
            <h3 class="product-name">Acer Predator Helios Neo 16 2024</h3>
            <p class="product-price">34.990.000₫</p>
            <button class="buy-btn">Thêm vào giỏ</button>
          </div>
        </div>
      </div>

      <button class="slider-btn next-btn" id="nextHotBtn"><i class="fas fa-chevron-right"></i></button>
    </div>
  </section>

  <div class="filter-wrapper">

    <div class="filter-dropdown">
      <div class="filter-btn-box"><i class="fas fa-filter"></i> Bộ lọc <i class="fas fa-chevron-down"></i></div>
      <div class="filter-popup">
        <div class="filter-group">
          <strong>RAM</strong>
          <label class="filter-item"><input type="checkbox"> 4GB</label>
          <label class="filter-item"><input type="checkbox"> 6GB</label>
          <label class="filter-item"><input type="checkbox"> 8GB</label>
          <label class="filter-item"><input type="checkbox"> 12GB</label>
          <label class="filter-item"><input type="checkbox"> 16GB</label>
        </div>
        <div class="filter-group">
          <strong>Ổ Cứng</strong>
          <label class="filter-item"><input type="checkbox"> 256GB SSD</label>
          <label class="filter-item"><input type="checkbox"> 512GB SSD</label>
          <label class="filter-item"><input type="checkbox"> 1TB SSD</label>
          <label class="filter-item"><input type="checkbox"> 2TB SSD</label>
        </div>
        <div class="filter-group">
          <strong>CPU</strong>
          <label class="filter-item"><input type="checkbox"> Intel Core i5</label>
          <label class="filter-item"><input type="checkbox"> Intel Core i7</label>
          <label class="filter-item"><input type="checkbox"> Intel Core i9</label>
          <label class="filter-item"><input type="checkbox"> AMD Ryzen 5</label>
          <label class="filter-item"><input type="checkbox"> AMD Ryzen 7</label>
        </div>
      </div>
    </div>

    <div class="filter-dropdown">
      <div class="filter-btn-box">Thương hiệu <i class="fas fa-chevron-down"></i></div>
      <div class="filter-popup" style="gap: 15px; flex-direction: column;">
        @if(isset($brands) && count($brands) > 0)
            @foreach($brands as $brand)
            <label class="filter-item"><input type="checkbox" name="brand[]" value="{{ $brand->id }}"> {{ $brand->name }}</label>
            @endforeach
        @endif
      </div>
    </div>

    <div class="price-filter-box">
      <div class="price-labels">
        Giá: <span id="val1">0</span>Tr - <span id="val2">200</span>Tr
      </div>
      <div class="range-slider-container">
        <div class="slider-track"></div>
        <div class="slider-track-fill"></div>
        <input type="range" min="0" max="200" value="0" id="slider-1" step="5">
        <input type="range" min="0" max="200" value="200" id="slider-2" step="5">
      </div>
    </div>
  </div>

  <section class="product-section">
    <h2 class="section-title-cat" style="font-size: 1.3rem; border-left: none; padding-left:0;">Tất cả Laptop Gaming</h2>

    <div class="product-grid">
       <div class="product-card">
          <div class="product-img"><img src="https://images.unsplash.com/photo-1603302576834-0d1a7099d69d?w=400&auto=format" alt="Laptop"></div>
          <div class="product-info"><h3 class="product-name">Lenovo LOQ 15IRX9 RTX 4050</h3><p class="product-price">25.990.000₫</p><button class="buy-btn">Thêm vào giỏ</button></div>
       </div>
       <div class="product-card">
          <div class="product-img"><img src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?w=400&auto=format" alt="Laptop"></div>
          <div class="product-info"><h3 class="product-name">ASUS TUF Gaming A15 FA507</h3><p class="product-price">22.450.000₫</p><button class="buy-btn">Thêm vào giỏ</button></div>
       </div>
       <div class="product-card">
          <div class="product-img"><img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=400&auto=format" alt="Laptop"></div>
          <div class="product-info"><h3 class="product-name">MSI Cyborg 15 A12UCX</h3><p class="product-price">18.490.000₫</p><button class="buy-btn">Thêm vào giỏ</button></div>
       </div>
       <div class="product-card">
          <div class="product-img"><img src="https://images.unsplash.com/photo-1588872657578-10efd656b5d9?w=400&auto=format" alt="Laptop"></div>
          <div class="product-info"><h3 class="product-name">HP Victus 15 Ryzen 5</h3><p class="product-price">20.200.000₫</p><button class="buy-btn">Thêm vào giỏ</button></div>
       </div>
    </div>
  </section>
@endsection

@push('scripts')
    @vite('resources/js/pages/category.js')
@endpush
