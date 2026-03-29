<div class="sidebar">
    <div class="sidebar-header">
        <i class="fas fa-laptop"></i>
        <h1>Laptop Store</h1>
    </div>
    <div class="sidebar-menu">
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="{{ route('admin.categories.index') }}"><i class="fas fa-tags"></i> Quản lý Danh mục</a>
        <a href="#"><i class="fas fa-box"></i> Quản lý Sản phẩm</a>
        <a href="#"><i class="fas fa-shopping-cart"></i> Đơn hàng</a>
        <a href="#"><i class="fas fa-users"></i> Khách hàng</a>
        <a href="#"><i class="fas fa-chart-bar"></i> Thống kê</a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> Đăng xuất
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
    </div>
</div>
