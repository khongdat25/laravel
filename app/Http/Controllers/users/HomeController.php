<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Attribute;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function index() {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        
        // Fetch all variants with their product and attributes for the "Latest" section
        $products = \App\Models\ProductVariant::with(['product.mainImage', 'attributeValues.attribute'])
            ->latest('id')
            ->take(8)
            ->get(); 
            
        // Fetch variants for the "Best Selling" section
        $bestSellingProducts = \App\Models\ProductVariant::with(['product.mainImage', 'attributeValues.attribute'])
            ->join('products', 'product_variants.product_id', '=', 'products.id')
            ->orderBy('products.sold', 'desc')
            ->select('product_variants.*')
            ->take(4)
            ->get(); 
            
        $brands = Brand::all(); 
        return view('user.home', compact('categories', 'products', 'bestSellingProducts', 'brands'));
    }

    public function detail(Request $request, $id){
        $product = Product::with(['images', 'mainImage', 'variants.attributeValues.attribute', 'category', 'brand', 'specifications'])->findOrFail($id);
        
        $similarProducts = Product::with(['mainImage', 'variants'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();
        
        // Lấy phiên bản cụ thể dựa trên ID (v) hoặc mặc định là bản đầu tiên
        $selectedVariantId = $request->query('v');
        $selectedVariant = $product->variants->where('id', $selectedVariantId)->first() ?? $product->variants->first();
        
        return view('user.detail', compact('product', 'similarProducts', 'selectedVariant'));
    }

    public function search(Request $request){
        $search = $request->input('query');
        $products = \App\Models\ProductVariant::with(['product.mainImage', 'attributeValues.attribute'])
        ->whereHas('product', function($query) use ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        })
        ->paginate();
        return view('user.search', compact('products', 'search'));
    }
}
