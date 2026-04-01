<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký Admin - Laptop Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/pages/register.css'])
</head>
<body>

<div class="register-container">
    <div class="register-header">
        <i class="fas fa-user-plus"></i>
        <h1>Tạo tài khoản Admin</h1>
    </div>
    
    <div class="register-body">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="admin@laptopstore.vn" required autocomplete="username">
                @error('email')
                    <span style="color:red; font-size:0.85em; margin-top:5px; display:block;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Tên đăng nhập</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="admin_dat" required autocomplete="name">
                @error('name')
                    <span style="color:red; font-size:0.85em; margin-top:5px; display:block;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input id="password" type="password" name="password" placeholder="••••••••" required autocomplete="new-password">
                @error('password')
                    <span style="color:red; font-size:0.85em; margin-top:5px; display:block;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Xác nhận mật khẩu</label>
                <input id="password_confirmation" type="password" name="password_confirmation" placeholder="••••••••" required autocomplete="new-password">
                @error('password_confirmation')
                    <span style="color:red; font-size:0.85em; margin-top:5px; display:block;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-register">
                <i class="fas fa-user-plus"></i> Đăng ký tài khoản
            </button>
        </form>

        <div class="footer-link">
            Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a>
        </div>
    </div>
</div>

</body>
</html>