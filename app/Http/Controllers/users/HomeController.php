<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;

class HomeController extends Controller
{
    public function index() {
        $products = Product::latest('id')->take(6)->get(); // Lấy 6 sản phẩm mới nhất
        $bestSellingProducts = Product::orderBy('sold', 'desc')->take(4)->get(); // Lấy 6 sản phẩm bán chạy nhất
        return view('user/home', compact('products', 'bestSellingProducts'));
    }
}
