<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng - Laptop Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary: #d10000;
            --dark: #2c3e50;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
            color: #2c3e50;
            font-size: 32px;
        }

        .cart-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }

        /* Danh sách sản phẩm trong giỏ */
        .cart-items {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.07);
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }
        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-item img {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 20px;
        }

        .item-info {
            flex: 1;
        }
        .item-info h3 {
            margin-bottom: 8px;
            font-size: 18px;
        }
        .item-price {
            color: var(--primary);
            font-weight: 700;
            font-size: 18px;
            margin: 5px 0;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 10px 0;
        }
        .quantity-btn {
            width: 32px;
            height: 32px;
            border: 1px solid #ddd;
            background: white;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }
        .quantity {
            width: 50px;
            text-align: center;
            font-weight: 600;
        }

        .item-total {
            font-weight: 700;
            color: var(--primary);
            min-width: 120px;
            text-align: right;
        }

        .remove-btn {
            color: #999;
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            padding: 5px 10px;
        }
        .remove-btn:hover {
            color: var(--primary);
        }

        /* Sidebar tóm tắt đơn hàng */
        .cart-summary {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.07);
            height: fit-content;
            position: sticky;
            top: 20px;
        }

        .summary-title {
            font-size: 22px;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }
        .summary-row:last-child {
            border-bottom: none;
            font-weight: 700;
            font-size: 18px;
        }

        .total-price {
            color: var(--primary);
            font-size: 24px;
        }

        .btn-checkout {
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            padding: 18px;
            font-size: 18px;
            font-weight: 700;
            border-radius: 10px;
            margin-top: 25px;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-checkout:hover {
            background: #a80000;
            transform: translateY(-3px);
        }

        .btn-continue {
            width: 100%;
            background: #6c757d;
            color: white;
            border: none;
            padding: 16px;
            font-size: 16px;
            border-radius: 10px;
            margin-top: 15px;
            cursor: pointer;
        }

        .empty-cart {
            text-align: center;
            padding: 80px 20px;
            color: #666;
        }
        .empty-cart i {
            font-size: 80px;
            color: #ddd;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1><i class="fas fa-shopping-cart"></i> Giỏ hàng của bạn</h1>

    <div class="cart-container">
        
        <!-- Danh sách sản phẩm -->
        <div class="cart-items">
            @php $totalPrice = 0; $totalQty = 0; @endphp
            @forelse($cart as $item)
                @php 
                    $price = $item->productVariant->price;
                    $itemQty = $item->quantity;
                    $subtotal = $price * $itemQty;
                    $totalPrice += $subtotal;
                    $totalQty += $itemQty;
                    $product = $item->productVariant->product;
                @endphp
                <div class="cart-item">
                    @if($product->mainImage)
                        <img src="{{ asset('storage/' . $product->mainImage->image_path) }}" alt="{{ $product->name }}">
                    @else
                        <img src="https://images.unsplash.com/photo-1603302576834-0d1a7099d69d?w=400" alt="{{ $product->name }}">
                    @endif
                    
                    <div class="item-info">
                        <h3>{{ $product->name }}</h3>
                        <p style="color:#666; font-size:14px;">
                            @foreach($item->productVariant->attributeValues as $av)
                                {{ $av->attribute->name }}: {{ $av->value }} @if(!$loop->last) • @endif
                            @endforeach
                        </p>
                        <div class="quantity-control">
                            <button class="quantity-btn" onclick="changeQuantity({{ $item->id }},-1)">−</button>
                            <span id="quantity-{{ $item->id }}" class="quantity">{{ $itemQty }}</span>
                            <button class="quantity-btn" onclick="changeQuantity({{ $item->id }},1)">+</button>
                        </div>
                    </div>
                    <div>
                        <div class="item-price">{{ number_format($price) }} ₫</div>
                        <div class="item-total" id="item-total-{{ $item->id }}">{{ number_format($subtotal) }} ₫</div>
                    </div>
                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="remove-btn" onclick="return confirm('Xóa sản phẩm này khỏi giỏ hàng?')">×</button>
                    </form>
                </div>
            @empty
                <div class="empty-cart">
                    <i class="fas fa-shopping-basket"></i>
                    <p>Giỏ hàng của bạn đang trống.</p>
                    <a href="/san-pham" class="btn-continue" style="display: inline-block; width: auto; padding: 10px 20px;">Tiếp tục mua sắm</a>
                </div>
            @endforelse
        </div>

        <!-- Tóm tắt giỏ hàng -->
        <div class="cart-summary">
            <div class="summary-title">Tóm tắt đơn hàng</div>
            
            <div class="summary-row">
                <span>Số lượng sản phẩm:</span>
                <span id="total-items">{{ $totalQty ?? 0 }}</span>
            </div>
            <div class="summary-row">
                <span>Tạm tính:</span>
                <span id="subtotal">{{ number_format($totalPrice ?? 0) }} ₫</span>
            </div>
            <div class="summary-row">
                <span>Phí vận chuyển:</span>
                <span>Miễn phí</span>
            </div>
            <div class="summary-row" style="margin-top: 15px; font-size: 20px;">
                <span>Tổng thanh toán:</span>
                <span class="total-price" id="total">{{ number_format($totalPrice ?? 0) }} ₫</span>
            </div>

            <button class="btn-checkout" onclick="window.location.href='{{ route('checkout.index') }}'">
                <i class="fas fa-credit-card"></i> Tiến hành thanh toán
            </button>
            
            <button class="btn-continue" onclick="window.location.href='/'">
                ← Tiếp tục mua sắm
            </button>
        </div>
    </div>
</div>

<script>
    function changeQuantity(id, change){
        //1 tìm thẻ hiển thị số lượng sản phẩm
        let quantityEl = document.getElementById('quantity-'+ id);
        let currentQuantity = parseInt(quantityEl.textContent);
        let newQty = currentQuantity + change;

        //không cho phép giảm về 0
        if(newQty< 1){
            alert('Số lượng không được nhỏ hơn 1');
            return;
        }
            // gọi yêu cầu Fetch gửi lên sever
            fetch(`/cart/update/${id}` , {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 'Accept':'application/json'},body: JSON.stringify({quantity: newQty}),
                    body: JSON.stringify({quantity: newQty})
                }).then(response => response.json())
                .then(data=>{
                    if(data.success){
                        quantityEl.textContent = newQty;
                        document.getElementById('item-total-'+id).textContent = data.itemSubtotal;
                        document.getElementById('total-items').textContent = data.totalQty;
                        document.getElementById('subtotal').textContent = data.totalPrice;
                        document.getElementById('total').textContent = data.totalPrice;
                    }else{
                        alert(data.error);
                        quantityEl.textContent = currentQuantity;
                    }
                })
                .catch(error =>{
                    consoloe.error('Error', error);
                    alert('Có lỗi xảy ra khi cập nhật số lượng');
                })
            }
        


    function removeItem(btn) {
        if (confirm("Xóa sản phẩm này khỏi giỏ hàng?")) {
            btn.parentElement.remove();
            // Cập nhật lại tổng tiền và số lượng
        }
    }
</script>

</body>
</html>