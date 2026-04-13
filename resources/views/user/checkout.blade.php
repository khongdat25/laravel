@extends('layouts.master')

@section('title', 'Thanh toán - Laptop Store')

@push('styles')
@vite('resources/css/layouts/header.css')
@vite('resources/css/layouts/footer.css')
<style>
    .checkout-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 30px;
    }

    .checkout-section {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }

    .section-title {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 25px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #2c3e50;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #4a5568;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 15px;
        transition: border-color 0.2s;
    }

    .form-control:focus {
        outline: none;
        border-color: #d10000;
        box-shadow: 0 0 0 3px rgba(209, 0, 0, 0.1);
    }

    .order-summary-item {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #f0f0f0;
    }

    .item-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 6px;
    }

    .item-info {
        flex: 1;
    }

    .item-name {
        font-weight: 500;
        font-size: 14px;
        margin-bottom: 4px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .item-price {
        color: #d10000;
        font-weight: 600;
        font-size: 14px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        color: #4a5568;
    }

    .total-row {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px solid #f0f0f0;
        font-size: 18px;
        font-weight: 700;
        color: #2c3e50;
    }

    .payment-methods {
        margin-top: 25px;
    }

    .payment-option {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 15px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        margin-bottom: 10px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .payment-option:hover {
        border-color: #cbd5e0;
    }

    .payment-option input[type="radio"] {
        width: 18px;
        height: 18px;
        accent-color: #d10000;
    }

    .payment-option.active {
        border-color: #d10000;
        background: rgba(209, 0, 0, 0.02);
    }

    .btn-place-order {
        width: 100%;
        background: #d10000;
        color: white;
        border: none;
        padding: 16px;
        border-radius: 10px;
        font-size: 17px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 20px;
        transition: background 0.3s;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    .btn-place-order:hover {
        background: #b30000;
    }

    @media (max-width: 768px) {
        .checkout-container {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="checkout-container">
    {{-- Form thông tin giao hàng --}}
    <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
        @csrf
        <div class="checkout-section">
            <h2 class="section-title">
                <i class="fas fa-truck"></i> Thông tin giao hàng
            </h2>

            <div class="form-group">
                <label>Họ và tên</label>
                <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
            </div>

            <div class="form-group">
                <label>Số điện thoại</label>
                <input type="text" name="phone" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Địa chỉ nhận hàng</label>
                <textarea name="address" class="form-control" rows="3" required placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành phố..."></textarea>
            </div>

            <div class="form-group">
                <label>Ghi chú (tùy chọn)</label>
                <textarea name="note" class="form-control" rows="2" placeholder="Lưu ý cho người giao hàng..."></textarea>
            </div>
        </div>

        <div class="checkout-section" style="margin-top: 30px;">
            <h2 class="section-title">
                <i class="fas fa-wallet"></i> Phương thức thanh toán
            </h2>
            <div class="payment-methods">
                @foreach($paymentMethods as $method)
                <label class="payment-option {{ $loop->first ? 'active' : '' }}">
                    <input type="radio" name="payment_method_id" value="{{ $method->id }}" {{ $loop->first ? 'checked' : '' }}>
                    <span>{{ $method->name }}</span>
                </label>
                @endforeach
            </div>
        </div>
    </form>

    {{-- Tóm tắt đơn hàng --}}
    <div class="order-summary">
        <div class="checkout-section" style="position: sticky; top: 20px;">
            <h2 class="section-title">
                <i class="fas fa-shopping-cart"></i> Giỏ hàng của bạn
            </h2>

            <div class="order-items-list" style="max-height: 400px; overflow-y: auto; margin-bottom: 20px;">
                @foreach($cartItems as $item)
                <div class="order-summary-item">
                    @if($item->productVariant->product->mainImage)
                        <img src="{{ asset('storage/' . $item->productVariant->product->mainImage->image_path) }}" class="item-img">
                    @else
                        <img src="https://via.placeholder.com/60" class="item-img">
                    @endif
                    <div class="item-info">
                        <div class="item-name">{{ $item->productVariant->product->name }} (x{{ $item->quantity }})</div>
                        <div class="item-price">{{ number_format($item->productVariant->price) }} ₫</div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="summary-details">
                <div class="summary-row">
                    <span>Tạm tính</span>
                    <span>{{ number_format($totalAmount) }} ₫</span>
                </div>
                <div class="summary-row">
                    <span>Phí vận chuyển</span>
                    <span>Miễn phí</span>
                </div>
                <div class="total-row summary-row">
                    <span>Tổng thanh toán</span>
                    <span>{{ number_format($totalAmount) }} ₫</span>
                </div>
            </div>

            <button type="submit" form="checkout-form" class="btn-place-order">
                XÁC NHẬN ĐẶT HÀNG <i class="fas fa-arrow-right"></i>
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Xử lý active class cho phương thức thanh toán
    document.querySelectorAll('.payment-option').forEach(option => {
        option.addEventListener('click', function() {
            document.querySelectorAll('.payment-option').forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>
@endpush
