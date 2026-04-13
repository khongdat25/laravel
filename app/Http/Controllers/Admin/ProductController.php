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
use App\Models\ProductSpecification;
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
            'variants' => 'required|array|min:1',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
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

        // 3. Create Variants
        foreach($request->variants as $vData) {
            $variant = ProductVariant::create([
                'product_id' => $product->id,
                'price' => $vData['price'],
                'original_price' => $vData['original_price'] ?? null,
                'stock' => $vData['stock'],
                'sku' => strtoupper(Str::random(10)),
            ]);

            // Handle Attributes for Variant
            $attributeInputs = [
                'CPU' => $vData['cpu'] ?? null,
                'RAM' => $vData['ram'] ?? null,
                'VGA' => $vData['vga'] ?? null,
                'SSD' => $vData['ssd'] ?? null,
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
        }

        // 4. Handle Specifications (Fixed Grid format: [Name => Value])
        if ($request->has('specs')) {
            foreach ($request->specs as $name => $value) {
                if (!empty($value)) {
                    ProductSpecification::create([
                        'product_id' => $product->id,
                        'name' => $name,
                        'value' => $value
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm mới thành công!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with(['variants.attributeValues.attribute', 'images', 'specifications'])->findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        $attributes = Attribute::with('values')->get();
        
        return view('admin.products.edit', compact('product', 'categories', 'brands', 'attributes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'variants' => 'required|array|min:1',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $product = Product::findOrFail($id);
        $category = Category::findOrFail($request->category_id);

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'category_slug' => $category->slug,
        ]);

        // Xóa ảnh cũ nếu admin tick chọn xoá
        if ($request->has('remove_images')) {
            $imagesToRemove = \App\Models\ProductImage::whereIn('id', $request->remove_images)->where('product_id', $product->id)->get();
            foreach ($imagesToRemove as $img) {
                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($img->image_path)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($img->image_path);
                }
                $img->delete();
            }
        }

        // Upload thêm ảnh mới
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('products', 'public');
                \App\Models\ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }

        // Đảm bảo cập nhật lại mainImage
        $firstRemainingImage = \App\Models\ProductImage::where('product_id', $product->id)->orderBy('id')->first();
        $product->update(['image_id' => $firstRemainingImage ? $firstRemainingImage->id : null]);

        // --- Cập nhật Variants ---
        // Lấy danh sách ID variants gửi lên để biết cái nào cần giữ/cập nhật, cái nào không có trong list thì xóa
        $variantIdsInRequest = collect($request->variants)->pluck('id')->filter()->toArray();
        
        // [QUAN TRỌNG] Xóa các variants cũ không còn trong request TRƯỚC KHI xử lý/tạo mới
        ProductVariant::where('product_id', $product->id)->whereNotIn('id', $variantIdsInRequest)->delete();
        
        // Cập nhật hoặc tạo mới variants
        foreach ($request->variants as $vData) {
            if (isset($vData['id'])) {
                $variant = ProductVariant::find($vData['id']);
                if ($variant) {
                    $variant->update([
                        'price' => $vData['price'],
                        'original_price' => $vData['original_price'] ?? null,
                        'stock' => $vData['stock'],
                    ]);
                }
            } else {
                $variant = ProductVariant::create([
                    'product_id' => $product->id,
                    'price' => $vData['price'],
                    'original_price' => $vData['original_price'] ?? null,
                    'stock' => $vData['stock'],
                    'sku' => strtoupper(Str::random(10)),
                ]);
            }

            if ($variant) {
                // Xử lý attributeValues cho variant này
                $attributeInputs = [
                    'CPU' => $vData['cpu'] ?? null,
                    'RAM' => $vData['ram'] ?? null,
                    'VGA' => $vData['vga'] ?? null,
                    'SSD' => $vData['ssd'] ?? null,
                ];

                $syncAttributeValueIds = [];
                foreach ($attributeInputs as $attrName => $attrValue) {
                    if (!empty($attrValue)) {
                        $attribute = Attribute::firstOrCreate(['name' => $attrName]);
                        $value = AttributeValue::firstOrCreate([
                            'attribute_id' => $attribute->id,
                            'value' => $attrValue
                        ]);
                        $syncAttributeValueIds[] = $value->id;
                    }
                }
                $variant->attributeValues()->sync($syncAttributeValueIds);
            }
        }

        // --- Cập nhật Specifications (Fixed Grid format) ---
        // Cách đơn giản nhất là xóa hết specs cũ của product này và tạo lại
        $product->specifications()->delete();
        if ($request->has('specs')) {
            foreach ($request->specs as $name => $value) {
                if (!empty($value)) {
                    ProductSpecification::create([
                        'product_id' => $product->id,
                        'name' => $name,
                        'value' => $value
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công!');
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
