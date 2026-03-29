<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Laptop Store Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/admin/dashboard.css'])
    @vite('resources/css/admin/sidebar.css')
</head>

<body>
    <!-- Main Content -->
    <div class="admin-container">
        @include('admin.sidebar')   
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <h2><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
            <div class="user-info">
                <span style="font-weight:600;">Xin chào, Admin</span>
                <img src="https://i.pravatar.cc/150?img=68" alt="Admin">
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon" style="color: #d10000;"><i class="fas fa-box"></i></div>
                <div class="stat-number">1,284</div>
                <div class="stat-label">Tổng sản phẩm</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="color: #28a745;"><i class="fas fa-shopping-cart"></i></div>
                <div class="stat-number">248</div>
                <div class="stat-label">Đơn hàng hôm nay</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="color: #ffc107;"><i class="fas fa-dollar-sign"></i></div>
                <div class="stat-number">245.8tr</div>
                <div class="stat-label">Doanh thu tháng này</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="color: #17a2b8;"><i class="fas fa-users"></i></div>
                <div class="stat-number">3,942</div>
                <div class="stat-label">Khách hàng</div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="content-grid">
            <!-- Đơn hàng gần đây -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-shopping-cart"></i> Đơn hàng gần đây</h3>
                    <a href="#">Xem tất cả →</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Khách hàng</th>
                            <th>Sản phẩm</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#LS24891</td>
                            <td>Nguyễn Văn Đạt</td>
                            <td>ASUS ROG Strix G16</td>
                            <td>32.450.000 ₫</td>
                            <td><span class="status status-completed">Hoàn thành</span></td>
                        </tr>
                        <tr>
                            <td>#LS24890</td>
                            <td>Trần Thị Lan</td>
                            <td>Lenovo Legion 5 Pro</td>
                            <td>35.990.000 ₫</td>
                            <td><span class="status status-pending">Đang xử lý</span></td>
                        </tr>
                        <tr>
                            <td>#LS24889</td>
                            <td>Lê Minh Quân</td>
                            <td>MacBook Air M3</td>
                            <td>27.890.000 ₫</td>
                            <td><span class="status status-completed">Hoàn thành</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Sản phẩm bán chạy -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-fire"></i> Sản phẩm bán chạy</h3>
                    <a href="#">Xem tất cả →</a>
                </div>
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <img src="https://images.unsplash.com/photo-1603302576834-0d1a7099d69d?w=80"
                            style="width:60px; border-radius:8px;" alt="">
                        <div style="flex:1;">
                            <strong>Lenovo Legion 5 Pro i9</strong><br>
                            <small style="color:#666;">35.990.000 ₫</small>
                        </div>
                        <span style="color:var(--primary); font-weight:700;">142 bán</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <img src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?w=80"
                            style="width:60px; border-radius:8px;" alt="">
                        <div style="flex:1;">
                            <strong>ASUS ROG Strix G16 RTX 4060</strong><br>
                            <small style="color:#666;">32.450.000 ₫</small>
                        </div>
                        <span style="color:var(--primary); font-weight:700;">98 bán</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</body>

</html>
