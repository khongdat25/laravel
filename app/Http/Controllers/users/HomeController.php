<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class HomeController extends Controller
{
    public function index() {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        $products = Product::latest('id')->take(6)->get(); // Lấy 6 sản phẩm mới nhất
        $bestSellingProducts = Product::orderBy('sold', 'desc')->take(4)->get(); // Lấy 6 sản phẩm bán chạy nhất
        $brands = Brand::with('products')->get(); // Lấy tất cả thương hiệu kèm sản phẩm
        return view('user.home', compact('categories', 'products', 'bestSellingProducts', 'brands'));
    }
}
