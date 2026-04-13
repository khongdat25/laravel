<?php

namespace App\Http\Controllers\users;
use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use App\Models\Cart;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $cart = Cart::where('user_id', auth()->id())
        ->with('productVariant.product.mainImage')
        ->get();
        return view('user.cart', compact('cart'));      
    }

    public function add(Request $request){
        if(!auth()->check()){
            if($request->ajax()){
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn cần đăng nhập mới được thêm vào giỏ hàng'
                ]);
            }
            return redirect()->route('login')->with('error','Bạn cần đăng nhập mới được thêm vào giỏ hàng');
        }
    $varitantId = $request->input('variant_id');
    $quantity = $request->input('quantity',1);

    $cartItem = Cart::where('user_id', auth()->id())
    ->where('product_variant_id', $varitantId)
    ->first();  
    if ($cartItem){
        $cartItem->increment('quantity', $quantity);
    }else{
        Cart::create([
            'user_id'=> auth()->id(),
            'quantity'=> $quantity,
            'product_variant_id'=> $varitantId,
        ]);
    }
   if ($request->ajax()){
    //tính số lượng sản phẩm của user trong giỏ hàng
    $totalCount = Cart::where('user_id', auth()->id())->sum('quantity');
    return response()->json([
        'success' => true,
        'message' => 'Đã thêm sản phẩm vào giỏ hàng',
        'totalCount' => $totalCount
    ]);
   }
   return redirect()->route('cart.index')->with('success','Đã thêm sản phẩm vào giỏ hàng');
}

public function update(Request $request, $id) {
    // 1. Tìm mục giỏ hàng của user hiện tại
    $cartItem = Cart::where('user_id', auth()->id())->where('id', $id)->first();

    if (!$cartItem) {
        return response()->json(['error' => 'Không tìm thấy sản phẩm'], 404);
    }

    // 2. Cập nhật số lượng mới từ request gửi lên
    $quantity = $request->input('quantity');
    if ($quantity < 1) {
        return response()->json(['error' => 'Số lượng không hợp lệ'], 400);
    }
    
    $cartItem->update(['quantity' => $quantity]);

    // 3. Tính toán lại giá tiền của sản phẩm đó và tổng giỏ hàng
    $itemSubtotal = $cartItem->productVariant->price * $cartItem->quantity;

    // Tính tổng toàn bộ giỏ hàng
    $cartItems = Cart::where('user_id', auth()->id())->get();
    $totalPrice = 0;
    $totalQty = 0;
    foreach ($cartItems as $item) {
        $totalPrice += $item->productVariant->price * $item->quantity;
        $totalQty += $item->quantity;
    }

    // 4. Trả về dữ liệu dạng JSON để JavaScript ở trình duyệt có thể đọc được
    return response()->json([
        'success' => true,
        'itemSubtotal' => number_format($itemSubtotal) . ' ₫',
        'totalPrice' => number_format($totalPrice) . ' ₫',
        'totalQty' => $totalQty,
    ]);
}


public function destroy($id){
    $cartItem = Cart::where('user_id', auth()->id())
    ->where('id', $id)
    ->first();
    if($cartItem){
        $cartItem->delete();
        return redirect()->route('cart.index')->with('success','Xóa sản phẩm khỏi giỏ hàng thành công');
    }
    return redirect()->route('cart.index')->with('error','Không tìm thấy sản phẩm trong giỏ hàng');
}
}
