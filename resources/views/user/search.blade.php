@extends('layouts.master')

@section('title', 'Tìm kiếm: ' . $search . ' - Laptop Store')

@push('styles')
    {{-- Dùng chung CSS với trang chủ để có giao diện Grid sản phẩm đẹp --}}
    @vite('resources/css/layouts/footer.css')
    @vite('resources/css/pages/home.css')
@endpush

@section('content')
<div class="container" style="max-width: 1200px; margin: 0 auto; padding: 40px 20px;">
    
    <div class="section-header" style="margin-bottom: 30px; border-bottom: 2px solid #eee; padding-bottom: 15px;">
        <h2 style="font-size: 1.5rem; color: #333;">
            <i class="fas fa-search" style="color: #d10000; margin-right: 10px;"></i>
            KẾT QUẢ TÌM KIẾM: <span style="color: #d10000;">"{{ $search }}"</span>
        </h2>
        <p style="color: #666; margin-top: 10px;">Tìm thấy <strong>{{ $products->total() }}</strong> sản phẩm phù hợp</p>
    </div>

    @if($products->isEmpty())
        <div style="text-align: center; padding: 60px 0; background: #f9f9f9; border-radius: 8px;">
            <i class="fas fa-box-open" style="font-size: 4rem; color: #ccc; margin-bottom: 20px; display: block;"></i>
            <h3 style="color: #888;">Rất tiếc, không tìm thấy sản phẩm nào!</h3>
            <p style="color: #999; margin-top: 10px;">Hãy thử lại với từ khóa khác như "Lenovo", "Legion", "MacBook"...</p>
            <a href="/" style="display: inline-block; margin-top: 20px; color: #d10000; text-decoration: underline;">Quay lại trang chủ</a>
        </div>
    @else
        <div class="product-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 25px;">
            @foreach($products as $item)
                @php
                    $p = $item->product;
                    $vAttrs = [];
                    foreach($item->attributeValues as $av) {
                        $vAttrs[$av->attribute->name] = $av->value;
                    }
                    $vName = $p->name . ' - ' . ($vAttrs['RAM'] ?? '') . ' / ' . ($vAttrs['SSD'] ?? '');
                @endphp
                <div class="product-card" style="background: #fff; border-radius: 8px; border: 1px solid #eee; overflow: hidden; transition: 0.3s; height: 100%;">
                    <div class="product-img" style="aspect-ratio: 1/1; overflow: hidden; background: #f5f5f5;">
                        @if($p->mainImage)
                            <img src="{{ asset('storage/' . $p->mainImage->image_path) }}" alt="{{ $vName }}" style="width: 100%; height: 100%; object-fit: contain;">
                        @else
                            <img src="https://images.unsplash.com/photo-1603302576834-0d1a7099d69d?w=400&auto=format" alt="{{ $vName }}" style="width: 100%; height: 100%; object-fit: contain;">
                        @endif
                    </div>
                    <div class="product-info" style="padding: 15px;">
                        <h3 class="product-name" style="font-size: 0.95rem; font-weight: 600; color: #333; height: 48px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; margin-bottom: 10px;" title="{{ $vName }}">
                            {{ $vName }}
                        </h3>
                        <p class="product-price" style="font-size: 1.1rem; color: #d10000; font-weight: 700; margin-bottom: 15px;">
                            {{ number_format($item->price) }}₫
                        </p>
                        <a href="/san-pham/{{ $p->id }}?v={{ $item->id }}" style="text-decoration: none;">
                            <button class="buy-btn" style="width: 100%; padding: 10px; background: #000; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-weight: 600; transition: 0.2s;">
                                Xem chi tiết
                            </button>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Phân trang --}}
        <div class="pagination-container" style="margin-top: 50px; display: flex; justify-content: center;">
            {{ $products->links() }}
        </div>
    @endif

</div>
@endsection
