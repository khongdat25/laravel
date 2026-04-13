@extends('layouts.master')

@section('title', 'Trang cá nhân - Laptop Store')
@vite('resources/css/pages/home.css')
@vite('resources/css/layouts/footer.css')
@push('styles')
<style>
    .profile-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 350px 1fr;
        gap: 30px;
    }

    .profile-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        text-align: center;
        height: fit-content;
    }

    .avatar-wrapper {
        position: relative;
        width: 150px;
        height: 150px;
        margin: 0 auto 20px;
    }

    .avatar-image {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #f0f0f0;
        transition: border-color 0.3s;
    }

    .avatar-upload-label {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background: #d10000;
        color: white;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        transition: transform 0.2s;
    }

    .avatar-upload-label:hover {
        transform: scale(1.1);
    }

    .user-name {
        font-size: 24px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 5px;
    }

    .user-email {
        color: #7f8c8d;
        font-size: 14px;
        margin-bottom: 25px;
    }

    .profile-nav {
        text-align: left;
        border-top: 1px solid #f0f0f0;
        padding-top: 20px;
    }

    .nav-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 15px;
        color: #34495e;
        text-decoration: none;
        border-radius: 8px;
        margin-bottom: 5px;
        transition: all 0.2s;
    }

    .nav-item:hover, .nav-item.active {
        background: #f8f9fa;
        color: #d10000;
    }

    .info-section {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 20px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Order Table Styles */
    .order-table {
        width: 100%;
        border-collapse: collapse;
    }

    .order-table th {
        text-align: left;
        padding: 15px;
        color: #7f8c8d;
        font-weight: 500;
        border-bottom: 2px solid #f8f9fa;
        font-size: 14px;
    }

    .order-table td {
        padding: 15px;
        border-bottom: 1px solid #f8f9fa;
        vertical-align: middle;
    }

    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-pending { background: #fff4e5; color: #ff9800; }
    .status-paid { background: #e8f5e9; color: #4caf50; }
    .status-unpaid { background: #ffebee; color: #f44336; }

    .btn-save {
        background: #d10000;
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
    }

    .btn-save:hover {
        background: #b30000;
    }

    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; margin-bottom: 8px; font-weight: 500; }
    .form-control {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    @media (max-width: 992px) {
        .profile-container { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<div class="profile-container">
    {{-- Cột trái: Thông tin cơ bản & Avatar --}}
    <div class="profile-card">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="avatar-form">
            @csrf
            @method('PATCH')
            <div class="avatar-wrapper">
                @php
                    $avatarPath = $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=d10000&color=fff';
                @endphp
                <img src="{{ $avatarPath }}" class="avatar-image" id="avatar-preview">
                <label for="avatar-input" class="avatar-upload-label">
                    <i class="fas fa-camera"></i>
                </label>
                <input type="file" name="avatar" id="avatar-input" style="display: none;" onchange="previewImage(this)">
            </div>
            {{-- Thêm hidden input cho name/email để tránh lỗi validation nếu form này submit --}}
            <input type="hidden" name="name" value="{{ $user->name }}">
            <input type="hidden" name="email" value="{{ $user->email }}">
        </form>

        <h3 class="user-name">{{ $user->name }}</h3>
        <p class="user-email">{{ $user->email }}</p>

        <div class="profile-nav">
            <a href="{{ route('profile.index') }}" class="nav-item active">
                <i class="fas fa-th-large"></i> Tổng quan & Đơn hàng
            </a>
            <a href="{{ route('profile.edit') }}" class="nav-item">
                <i class="fas fa-user-edit"></i> Chỉnh sửa thông tin
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="nav-item" style="color: #f44336;" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Đăng xuất
                </a>
            </form>
        </div>
        
        <button type="submit" form="avatar-form" class="btn-save" style="margin-top: 20px; width: 100%; display: none;" id="save-avatar-btn">
            Cập nhật ảnh đại diện
        </button>
    </div>

    {{-- Cột phải: Chi tiết --}}
    <div class="profile-content">
        {{-- Phần Lịch sử Đơn hàng --}}
        <div class="info-section">
            <h2 class="section-title"><i class="fas fa-box"></i> Lịch sử đơn hàng</h2>
            <div style="overflow-x: auto;">
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Ngày đặt</th>
                            <th>Sản phẩm</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td style="font-weight: 600;">#{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div style="font-size: 13px; color: #666;">
                                    @foreach($order->items as $item)
                                        {{ $item->productVariant->product->name }} (x{{ $item->quantity }})<br>
                                    @endforeach
                                </div>
                            </td>
                            <td style="color: #d10000; font-weight: 600;">{{ number_format($order->total_amount) }} ₫</td>
                            <td>
                                <span class="status-badge status-{{ $order->payment_status }}">
                                    {{ $order->payment_status == 'paid' ? 'Đã thanh toán' : ($order->payment_status == 'unpaid' ? 'Chưa thanh toán' : $order->payment_status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 40px; color: #999;">
                                <i class="fas fa-shopping-bag" style="font-size: 40px; margin-bottom: 10px; display: block;"></i>
                                Bạn chưa có đơn hàng nào.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Phần Thông tin Nhanh --}}
        <div class="info-section">
            <h2 class="section-title"><i class="fas fa-info-circle"></i> Thông tin tài khoản</h2>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label>Họ và tên</label>
                    <p style="padding: 10px 15px; background: #f8f9fa; border-radius: 8px;">{{ $user->name }}</p>
                </div>
                <div class="form-group">
                    <label>Địa chỉ Email</label>
                    <p style="padding: 10px 15px; background: #f8f9fa; border-radius: 8px;">{{ $user->email }}</p>
                </div>
                <div class="form-group">
                    <label>Ngày tham gia</label>
                    <p style="padding: 10px 15px; background: #f8f9fa; border-radius: 8px;">{{ $user->created_at->format('d/m/Y') }}</p>
                </div>
                <div class="form-group">
                    <label>Tổng chi tiêu</label>
                    <p style="padding: 10px 15px; background: #f8f9fa; border-radius: 8px; color: #d10000; font-weight: 700;">
                        {{ number_format($orders->sum('total_amount')) }} ₫
                    </p>
                </div>
            </div>
            <a href="{{ route('profile.edit') }}" style="color: #d10000; text-decoration: none; font-weight: 600; font-size: 14px;">
                Chỉnh sửa thông tin chi tiết →
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar-preview').src = e.target.result;
                document.getElementById('save-avatar-btn').style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
