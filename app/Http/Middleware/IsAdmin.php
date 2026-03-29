<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     * Chỉ cho phép user có role = 'admin' vào.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // Nếu chưa đăng nhập -> về trang login
        // Nếu đã đăng nhập nhưng không phải admin -> về trang chủ
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        abort(403, 'Bạn không có quyền truy cập trang này.');
    }
}
