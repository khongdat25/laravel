@extends('layouts.master')

@section('title', 'Đặt hàng thành công - Laptop Store')
@vite('resources/css/pages/home.css')
@vite('resources/css/layouts/footer.css')
@push('styles')
<style>
    .success-container {
        max-width: 800px;
        margin: 60px auto;
        text-align: center;
        background: white;
        padding: 50px;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .success-icon {
        width: 100px;
        height: 100px;
        background: #e8f5e9;
        color: #4caf50;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 50px;
        margin: 0 auto 25px;
    }

    .success-title {
        font-size: 28px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .success-msg {
        font-size: 16px;
        color: #666;
        margin-bottom: 30px;
    }

    .order-info {
        background: #f8f9fa;
        padding: 25px;
        border-radius: 12px;
        text-align: left;
        margin-bottom: 35px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        padding-bottom: 12px;
        border-bottom: 1px dashed #e2e8f0;
    }

    .info-row:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .info-label {
        font-weight: 600;
        color: #4a5568;
    }

    .btn-group {
        display: flex;
        gap: 15px;
        justify-content: center;
    }

    .btn {
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-primary {
        background: #d10000;
        color: white;
    }

    .btn-primary:hover {
        background: #b30000;
    }

    .btn-secondary {
        background: #edf2f7;
        color: #4a5568;
    }

    .btn-secondary:hover {
        background: #e2e8f0;
    }
</style>
@endpush

@section('content')
<div class="success-container">
    <div class="success-icon">
        <i class="fas fa-check"></i>
    </div>
    <h1 class="success-title">Đặt hàng thành công!</h1>
    <p class="success-msg">Cảm ơn bạn đã tin tưởng và mua sắm tại Laptop Store. Đơn hàng của bạn đang được xử lý.</p>

    <div class="order-info">
        <h3 style="margin-bottom: 20px; color: #2c3e50;">Thông tin đơn hàng #{{ $order->id }}</h3>
        <div class="info-row">
            <span class="info-label">Người nhận:</span>
            <span>{{ $order->name }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Số điện thoại:</span>
            <span>{{ $order->phone }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Tổng thanh toán:</span>
            <span style="color: #d10000; font-weight: 700;">{{ number_format($order->total_amount) }} ₫</span>
        </div>
        <div class="info-row">
            <span class="info-label">Phương thức thanh toán:</span>
            <span>{{ $order->paymentMethod->name }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Trạng thái:</span>
            <span class="badge" style="background: #e8f5e9; color: #4caf50; padding: 4px 10px; border-radius: 15px; font-size: 13px;">Chờ xử lý</span>
        </div>
    </div>

    <div class="btn-group">
        <a href="/" class="btn btn-primary">TIẾP TỤC MUA SẮM</a>
        <a href="/profile" class="btn btn-secondary">THEO DÕI ĐƠN HÀNG</a>
    </div>
</div>
@endsection
