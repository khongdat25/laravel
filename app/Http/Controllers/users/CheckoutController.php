<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderSuccess;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $cartItems = Cart::where('user_id', $userId)
            ->with('productVariant.product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += $item->productVariant->price * $item->quantity;
        }

        $paymentMethods = PaymentMethod::all();

        return view('user.checkout', compact('cartItems', 'totalAmount', 'paymentMethods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'payment_method_id' => 'required|exists:payment_methods,id',
        ], [
            'name.required' => 'Vui lòng nhập họ tên.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'address.required' => 'Vui lòng nhập địa chỉ giao hàng.',
            'payment_method_id.required' => 'Vui lòng chọn phương thức thanh toán.',
        ]);

        $userId = auth()->id();
        $cartItems = Cart::where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống, không thể đặt hàng.');
        }

        try {
            DB::beginTransaction();

            // 1. Tính tổng tiền
            $totalAmount = 0;
            foreach ($cartItems as $item) {
                $totalAmount += $item->productVariant->price * $item->quantity;
            }

            // 2. Tạo đơn hàng
            $order = Order::create([
                'user_id' => $userId,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'note' => $request->note,
                'total_amount' => $totalAmount,
                'payment_method_id' => $request->payment_method_id,
                'payment_status' => 'unpaid',
                'status' => 'pending',
            ]);

            // 3. Tạo chi tiết đơn hàng & Trừ tồn kho
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_variant_id' => $item->product_variant_id,
                    'quantity' => $item->quantity,
                    'price' => $item->productVariant->price,
                ]);

                // Trừ tồn kho
                $variant = $item->productVariant;
                if ($variant->stock < $item->quantity) {
                    throw new \Exception("Sản phẩm {$variant->product->name} (biến thể {$variant->id}) không đủ tồn kho.");
                }
                $variant->decrement('stock', $item->quantity);
            }

            // 4. Xóa giỏ hàng
            Cart::where('user_id', $userId)->delete();

            DB::commit();

            try {
                Mail::to($request->email)->send(new OrderSuccess($order));
            } catch (\Exception $e) {
                // Log error or ignore to ensure user gets to success page
                \Illuminate\Support\Facades\Log::error("Mail error: " . $e->getMessage());
            }

            return redirect()->route('order.success', $order->id)->with('success', 'Đặt hàng thành công!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage())->withInput();
        }
    }

    public function success($id)
    {
        $order = Order::where('user_id', auth()->id())
            ->where('id', $id)
            ->with('items.productVariant.product')
            ->firstOrFail();

        return view('user.success', compact('order'));
    }
}
