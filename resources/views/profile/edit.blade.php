@extends('layouts.master')

@section('title', 'Chỉnh sửa tài khoản - Laptop Store')
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

    .edit-section {
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
        border-bottom: 2px solid #f8f9fa;
        padding-bottom: 10px;
    }

    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; margin-bottom: 8px; font-weight: 500; color: #4a5568; }
    
    .form-control {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 15px;
    }

    .form-control:focus {
        border-color: #d10000;
        outline: none;
        box-shadow: 0 0 0 3px rgba(209, 0, 0, 0.1);
    }

    .btn-save {
        background: #d10000;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
    }

    .btn-save:hover { background: #b30000; }
    .text-danger { color: #e53e3e; font-size: 13px; margin-top: 5px; }

    @media (max-width: 992px) {
        .profile-container { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<div class="profile-container">
    {{-- Cột trái (Sidebar) --}}
    <div class="profile-card">
        <div class="avatar-wrapper">
            @php
                $avatarPath = $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=d10000&color=fff';
            @endphp
            <img src="{{ $avatarPath }}" class="avatar-image">
        </div>

        <h3 class="user-name">{{ $user->name }}</h3>
        <p class="user-email">{{ $user->email }}</p>

        <div class="profile-nav">
            <a href="{{ route('profile.index') }}" class="nav-item">
                <i class="fas fa-th-large"></i> Tổng quan & Đơn hàng
            </a>
            <a href="{{ route('profile.edit') }}" class="nav-item active">
                <i class="fas fa-user-edit"></i> Chỉnh sửa thông tin
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="nav-item" style="color: #f44336;" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Đăng xuất
                </a>
            </form>
        </div>
    </div>

    {{-- Cột phải (Nội dung chỉnh sửa) --}}
    <div class="profile-content">
        
        {{-- 1. Cập nhật thông tin --}}
        <div class="edit-section">
            <h2 class="section-title"><i class="fas fa-id-card"></i> Thông tin cơ bản</h2>
            <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="form-group">
                    <label>Họ và tên</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    @error('email') <p class="text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label>Ảnh đại diện mới</label>
                    <input type="file" name="avatar" class="form-control">
                    @error('avatar') <p class="text-danger">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="btn-save">LƯU THAY ĐỔI</button>
                @if (session('status') === 'profile-updated')
                    <span style="color: #38a169; margin-left: 15px;">✓ Đã lưu thành công</span>
                @endif
            </form>
        </div>

        {{-- 2. Đổi mật khẩu --}}
        <div class="edit-section">
            <h2 class="section-title"><i class="fas fa-key"></i> Đổi mật khẩu</h2>
            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="form-group">
                    <label>Mật khẩu hiện tại</label>
                    <input type="password" name="current_password" class="form-control" required>
                    @error('current_password', 'updatePassword') <p class="text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label>Mật khẩu mới</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password', 'updatePassword') <p class="text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label>Xác nhận mật khẩu mới</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn-save">CẬP NHẬT MẬT KHẨU</button>
                @if (session('status') === 'password-updated')
                    <span style="color: #38a169; margin-left: 15px;">✓ Đã đổi mật khẩu</span>
                @endif
            </form>
        </div>

        {{-- 3. Nguy hiểm --}}
        <div class="edit-section" style="border-top: 4px solid #e53e3e;">
            <h2 class="section-title" style="color: #e53e3e;"><i class="fas fa-user-slash"></i> Xóa tài khoản</h2>
            <p style="margin-bottom: 20px; color: #7f8c8d;">Dữ liệu sẽ bị xóa vĩnh viễn.</p>
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu để xác nhận..." required>
                    @error('password', 'userDeletion') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="btn-save" style="background: #e53e3e;" onclick="return confirm('Bạn có chắc chắn?')">XÓA TÀI KHOẢN</button>
            </form>
        </div>
    </div>
</div>
@endsection
