<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Laptop Store')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/admin/sidebar.css', 'resources/css/admin/dashboard.css'])
    @stack('styles')
</head>
<body>
    <div class="admin-container">
        @include('admin.sidebar')
        <div class="main-content">
            <!-- Topbar (Optional: can be moved to a separate file or kept per page) -->
            @yield('content')
        </div>
    </div>
    @stack('scripts')
</body>
</html>
