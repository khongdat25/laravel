<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đơn hàng - Shop Online</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; margin: 0; padding: 0; color: #333; }
        .container { max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #d32f2f 0%, #b71c1c 100%); padding: 40px 20px; text-align: center; color: #ffffff; }
        .header h1 { margin: 0; font-size: 28px; letter-spacing: 1px; }
        .content { padding: 30px; line-height: 1.6; }
        .greeting { font-size: 18px; font-weight: 600; color: #b71c1c; margin-bottom: 15px; }
        .success-box { background-color: #e8f5e9; border-left: 5px solid #4caf50; padding: 15px; margin-bottom: 25px; border-radius: 4px; }
        .order-details { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .order-details th { text-align: left; background-color: #f8f9fa; padding: 12px; border-bottom: 2px solid #dee2e6; }
        .order-details td { padding: 12px; border-bottom: 1px solid #eee; }
        .total-row td { font-weight: 700; color: #b71c1c; font-size: 18px; }
        .footer { padding: 20px; background-color: #f8f9fa; text-align: center; font-size: 13px; color: #666; }
        .btn { display: inline-block; padding: 12px 25px; background-color: #b71c1c; color: #ffffff; text-decoration: none; border-radius: 6px; font-weight: 600; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>SHOP ONLINE</h1>
            <p style="margin: 10px 0 0; opacity: 0.9;">Công nghệ trong tầm tay bạn</p>
        </div>
        <div class="content">
            <div class="greeting">Xin chào {{ $order->name }},</div>
            <p>Cảm ơn bạn đã lựa chọn mua sắm tại <strong>Shop Online</strong>. Chúng tôi rất vui mừng thông báo rằng đơn hàng của bạn đã được tiếp nhận thành công và đang được chuẩn bị để giao đến bạn.</p>
            
            <div class="success-box">
                <strong>Mã đơn hàng: #{{ $order->id }}</strong><br>
                Trạng thái: Đang chờ xử lý
            </div>

            <table class="order-details">
                <tr>
                    <th>Thông tin thanh toán</th>
                    <th>Chi tiết đơn hàng</th>
                </tr>
                <tr>
                    <td>
                        <strong>Địa chỉ giao hàng:</strong><br>
                        {{ $order->address }}<br>
                        SĐT: {{ $order->phone }}
                    </td>
                    <td>
                        <strong>Ngày đặt:</strong><br>
                        {{ $order->created_at->format('d/m/Y H:i') }}
                    </td>
                </tr>
                <tr class="total-row">
                    <td>TỔNG CỘNG:</td>
                    <td>{{ number_format($order->total_amount) }} VNĐ</td>
                </tr>
            </table>

            <div style="text-align: center;">
                <a href="{{ url('/profile') }}" class="btn">Theo dõi đơn hàng của bạn</a>
            </div>

            <p style="margin-top: 30px; font-size: 14px; text-align: center; color: #888;">
                Nếu bạn có bất kỳ thắc mắc nào, vui lòng liên hệ với chúng tôi qua hotline hoặc phản hồi email này.
            </p>
        </div>
        <div class="footer">
            &copy; 2026 Shop Online. Tất cả các quyền được bảo lưu.<br>
            Hệ thống bán lẻ Laptop & Phụ kiện uy tín hàng đầu.
        </div>
    </div>
</body>
</html>
