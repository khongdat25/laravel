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
        $products = Product::with(['variants', 'mainImage'])->latest('id')->take(6)->get(); 
        $bestSellingProducts = Product::with(['variants', 'mainImage'])->orderBy('sold', 'desc')->take(4)->get(); 
        $brands = Brand::with('products')->get(); // Lấy tất cả thương hiệu kèm sản phẩm
        return view('user.home', compact('categories', 'products', 'bestSellingProducts', 'brands'));
    }
}
