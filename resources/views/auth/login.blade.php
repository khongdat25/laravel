<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin - Laptop Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/pages/login.css'])
</head>
<body>

<div class="login-container">
    <div class="login-header">
        <i class="fas fa-laptop"></i>
        <h1>Laptop Store</h1>
        <p>Admin Panel</p>
    </div>
    
    <div class="login-body">
        @if (session('status'))
            <div style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; border-radius: 5px; margin-bottom: 20px; text-align: center; font-size: 14px;">
                {{ session('status') }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="admin@laptopstore.vn" required autofocus autocomplete="username">
                @error('email')
                    <span style="color:red; font-size:0.85em; margin-top:5px; display:block;">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input id="password" type="password" name="password" placeholder="••••••••" required autocomplete="current-password">
                @error('password')
                    <span style="color:red; font-size:0.85em; margin-top:5px; display:block;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; align-items: center; justify-content: space-between; font-size: 14px; margin-bottom: 20px;">
                <label for="remember_me" style="cursor: pointer;">
                    <input id="remember_me" type="checkbox" name="remember" style="margin-right: 6px;"> Ghi nhớ tôi
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" style="color: var(--primary);">Quên mật khẩu?</a>
                @endif
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Đăng nhập
            </button>
        </form>

        <div class="footer-link">
            Chưa có tài khoản? <a href="{{ route('register') }} ">Đăng ký ngay</a>
        </div>
    </div>
</div>

</body>
</html>