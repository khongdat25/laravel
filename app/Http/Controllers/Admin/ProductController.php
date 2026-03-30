<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductVariant;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $brands = Brand::all();

        $products = Product::with(['category', 'brand', 'variants', 'mainImage'])
            ->when($request->search, function ($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%");
            })
            ->when($request->category, function ($query, $categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->when($request->brand, function ($query, $brandId) {
                return $query->where('brand_id', $brandId);
            })
            ->latest('id')
            ->paginate(10)
            ->appends(request()->query()); // Keep filters in pagination links
            
        return view('admin.products.index', compact('products', 'categories', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $attributes = Attribute::with('values')->get();
        
        return view('admin.products.create', compact('categories', 'brands', 'attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Logic for handling variants and multiple images
        return redirect()->route('admin.products.index')->with('success', 'Đang phát triển tính năng lưu sản phẩm phức tạp...');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with(['variants.attributeValues', 'images'])->findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        $attributes = Attribute::with('values')->get();
        
        return view('admin.products.edit', compact('product', 'categories', 'brands', 'attributes'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        
        return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công!');
    }
}
