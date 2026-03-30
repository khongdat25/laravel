<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Get Attributes
        $attrCPU = Attribute::where('name', 'CPU')->first();
        $attrRAM = Attribute::where('name', 'RAM')->first();
        $attrVGA = Attribute::where('name', 'VGA')->first();
        $attrSSD = Attribute::where('name', 'SSD')->first();
        $attrScreen = Attribute::where('name', 'Screen')->first();
        $attrOS = Attribute::where('name', 'OS')->first();

        // 2. Pre-create Attribute Values
        $cpus = [
            'Apple M3 8-core' => AttributeValue::create(['attribute_id' => $attrCPU->id, 'value' => 'Apple M3 8-core']),
            'Apple M3 Max 14-core' => AttributeValue::create(['attribute_id' => $attrCPU->id, 'value' => 'Apple M3 Max 14-core']),
            'Intel Core i9-14900HX' => AttributeValue::create(['attribute_id' => $attrCPU->id, 'value' => 'Intel Core i9-14900HX']),
            'Intel Core i7-13650HX' => AttributeValue::create(['attribute_id' => $attrCPU->id, 'value' => 'Intel Core i7-13650HX']),
            'Intel Core i5-13500H' => AttributeValue::create(['attribute_id' => $attrCPU->id, 'value' => 'Intel Core i5-13500H']),
        ];

        $rams = [
            '8GB' => AttributeValue::create(['attribute_id' => $attrRAM->id, 'value' => '8GB']),
            '16GB' => AttributeValue::create(['attribute_id' => $attrRAM->id, 'value' => '16GB']),
            '32GB' => AttributeValue::create(['attribute_id' => $attrRAM->id, 'value' => '32GB']),
        ];

        $vgas = [
            '10-core GPU' => AttributeValue::create(['attribute_id' => $attrVGA->id, 'value' => '10-core GPU']),
            'RTX 4060 8GB' => AttributeValue::create(['attribute_id' => $attrVGA->id, 'value' => 'RTX 4060 8GB']),
            'RTX 4080 12GB' => AttributeValue::create(['attribute_id' => $attrVGA->id, 'value' => 'RTX 4080 12GB']),
        ];

        $ssds = [
            '256GB' => AttributeValue::create(['attribute_id' => $attrSSD->id, 'value' => '256GB']),
            '512GB' => AttributeValue::create(['attribute_id' => $attrSSD->id, 'value' => '512GB']),
            '1TB' => AttributeValue::create(['attribute_id' => $attrSSD->id, 'value' => '1TB']),
        ];

        $screens = [
            '14.2" Liquid Retina XDR' => AttributeValue::create(['attribute_id' => $attrScreen->id, 'value' => '14.2" Liquid Retina XDR']),
            '16" QHD+ 240Hz' => AttributeValue::create(['attribute_id' => $attrScreen->id, 'value' => '16" QHD+ 240Hz']),
            '16" 2.5K 165Hz' => AttributeValue::create(['attribute_id' => $attrScreen->id, 'value' => '16" 2.5K 165Hz']),
        ];

        $oss = [
            'macOS' => AttributeValue::create(['attribute_id' => $attrOS->id, 'value' => 'macOS']),
            'Windows 11' => AttributeValue::create(['attribute_id' => $attrOS->id, 'value' => 'Windows 11']),
        ];

        // 3. Get Base Data
        $categories = Category::all()->pluck('id', 'slug')->toArray();
        $brands = Brand::all()->pluck('id', 'name')->toArray();

        // Sample image URLs
        $laptopImages = [
            'https://images.unsplash.com/photo-1603302576834-0d1a7099d69d?w=800',
            'https://images.unsplash.com/photo-1593642632823-8f785ba67e45?w=800',
            'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=800',
            'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=800',
        ];

        // 4. Products defined with variants
        $laptopData = [
            [
                'name' => 'MacBook Pro 14 M3',
                'brand' => 'Apple',
                'cat' => 'macbook',
                'variants' => [
                    ['price' => 39990000, 'stock' => 50, 'cpu' => 'Apple M3 8-core', 'ram' => '8GB', 'ssd' => '512GB', 'vga' => '10-core GPU', 'screen' => '14.2" Liquid Retina XDR', 'os' => 'macOS'],
                    ['price' => 45990000, 'stock' => 30, 'cpu' => 'Apple M3 8-core', 'ram' => '16GB', 'ssd' => '512GB', 'vga' => '10-core GPU', 'screen' => '14.2" Liquid Retina XDR', 'os' => 'macOS'],
                ]
            ],
            [
                'name' => 'Lenovo Legion 5 Pro',
                'brand' => 'Lenovo',
                'cat' => 'laptop-gaming',
                'variants' => [
                    ['price' => 35990000, 'stock' => 45, 'cpu' => 'Intel Core i9-14900HX', 'ram' => '16GB', 'ssd' => '512GB', 'vga' => 'RTX 4060 8GB', 'screen' => '16" 2.5K 165Hz', 'os' => 'Windows 11'],
                    ['price' => 38990000, 'stock' => 20, 'cpu' => 'Intel Core i9-14900HX', 'ram' => '32GB', 'ssd' => '1TB', 'vga' => 'RTX 4060 8GB', 'screen' => '16" 2.5K 165Hz', 'os' => 'Windows 11'],
                ]
            ],
            [
                'name' => 'ASUS ROG Strix G16',
                'brand' => 'Asus',
                'cat' => 'laptop-gaming',
                'variants' => [
                    ['price' => 32450000, 'stock' => 60, 'cpu' => 'Intel Core i7-13650HX', 'ram' => '16GB', 'ssd' => '512GB', 'vga' => 'RTX 4060 8GB', 'screen' => '16" 2.5K 165Hz', 'os' => 'Windows 11'],
                ]
            ],
        ];

        foreach ($laptopData as $data) {
            $product = Product::create([
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'description' => "Dòng sản phẩm cao cấp từ " . $data['brand'] . ". Siêu mạnh mẽ cho công việc và giải trí.",
                'category_id' => $categories[$data['cat']] ?? 1,
                'brand_id' => $brands[$data['brand']] ?? 1,
                'category_slug' => $data['cat'],
                'status' => 'active',
                'sold' => rand(50, 500),
            ]);

            // Create images for product
            $firstImageId = null;
            foreach (array_slice($laptopImages, 0, 3) as $url) {
                $img = ProductImage::create(['product_id' => $product->id, 'image_path' => $url]);
                if (!$firstImageId) $firstImageId = $img->id;
            }
            $product->update(['image_id' => $firstImageId]);

            // Create variants
            foreach ($data['variants'] as $v) {
                $variant = ProductVariant::create([
                    'product_id' => $product->id,
                    'price' => $v['price'],
                    'stock' => $v['stock'],
                    'sku' => strtoupper(Str::random(10)),
                ]);

                // Link variant to attribute values
                $variant->attributeValues()->attach([
                    $cpus[$v['cpu']]->id,
                    $rams[$v['ram']]->id,
                    $vgas[$v['vga']]->id,
                    $ssds[$v['ssd']]->id,
                    $screens[$v['screen']]->id,
                    $oss[$v['os']]->id,
                ]);
            }
        }
    }
}