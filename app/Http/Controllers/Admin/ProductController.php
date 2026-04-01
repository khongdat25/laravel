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
        $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $category = Category::findOrFail($request->category_id);

        // 1. Create base product
        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . time(),
            'description' => $request->description,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'category_slug' => $category->slug,
            'status' => 'active',
            'sold' => 0,
        ]);

        // 2. Upload and Handle Images
        $firstImageId = null;
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('products', 'public');
                $productImage = \App\Models\ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);

                if ($index === 0) {
                    $firstImageId = $productImage->id;
                }
            }
            
            if ($firstImageId) {
                $product->update(['image_id' => $firstImageId]);
            }
        }

        // 3. Create Default Variant
        $variant = ProductVariant::create([
            'product_id' => $product->id,
            'price' => $request->price,
            'original_price' => $request->original_price,
            'stock' => $request->stock,
            'sku' => strtoupper(Str::random(10)),
        ]);

        // 4. Handle Attributes
        $attributeInputs = [
            'VGA' => $request->vga,
            'CPU' => $request->cpu,
            'RAM' => $request->ram,
            'SSD' => $request->ssd,
            'Screen' => $request->screen,
            'OS' => $request->os,
        ];

        foreach ($attributeInputs as $attrName => $attrValue) {
            if (!empty($attrValue)) {
                $attribute = Attribute::firstOrCreate(['name' => $attrName]);
                $value = AttributeValue::firstOrCreate([
                    'attribute_id' => $attribute->id,
                    'value' => $attrValue
                ]);
                $variant->attributeValues()->attach($value->id);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm mới thành công!');
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
