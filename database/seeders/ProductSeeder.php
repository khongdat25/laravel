<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Lấy ID của các Brand từ database để đảm bảo chính xác
        $brands = [
            'Apple'  => DB::table('brands')->where('name', 'Apple')->value('id'),
            'Dell'   => DB::table('brands')->where('name', 'Dell')->value('id'),
            'Lenovo' => DB::table('brands')->where('name', 'Lenovo')->value('id'),
            'Asus'   => DB::table('brands')->where('name', 'Asus')->value('id'),
            'HP'     => DB::table('brands')->where('name', 'HP')->value('id'),
        ];

        // Kiểm tra nếu chưa có brand nào thì dừng lại để tránh lỗi
        if (in_array(null, $brands)) {
            $this->command->error("Lỗi: Một số Brand chưa tồn tại trong bảng brands. Hãy chạy BrandSeeder trước!");
            return;
        }

        // 2. Danh sách 50 mẫu Laptop thuộc 5 brand trên
        $laptopModels = [
            // APPLE
            ['name' => 'MacBook Pro 14 M3', 'brand' => 'Apple', 'price' => 1599, 'desc' => 'Chip M3, 8GB RAM, 512GB SSD'],
            ['name' => 'MacBook Pro 16 M3 Max', 'brand' => 'Apple', 'price' => 3499, 'desc' => 'Chip M3 Max, 36GB RAM, 1TB SSD'],
            ['name' => 'MacBook Air 13 M2', 'brand' => 'Apple', 'price' => 999, 'desc' => 'Chip M2, 8GB RAM, 256GB SSD'],
            ['name' => 'MacBook Air 15 M3', 'brand' => 'Apple', 'price' => 1299, 'desc' => 'Chip M3, Màn hình 15.3 inch Retina'],
            ['name' => 'MacBook Pro 14 M3 Pro', 'brand' => 'Apple', 'price' => 1999, 'desc' => 'Chip M3 Pro, 18GB RAM, 512GB SSD'],
            ['name' => 'MacBook Air 13 M1', 'brand' => 'Apple', 'price' => 799, 'desc' => 'Chip M1 huyền thoại, pin 18h'],
            ['name' => 'MacBook Pro 13 M2', 'brand' => 'Apple', 'price' => 1199, 'desc' => 'Chip M2, Touch Bar, 8GB RAM'],
            ['name' => 'MacBook Pro 16 M2 Max', 'brand' => 'Apple', 'price' => 2999, 'desc' => 'Chip M2 Max, Siêu cấu hình đồ họa'],
            ['name' => 'MacBook Air 15 M2', 'brand' => 'Apple', 'price' => 1099, 'desc' => 'Chip M2, Màn hình lớn, mỏng nhẹ'],
            ['name' => 'MacBook Pro 14 M2 Pro', 'brand' => 'Apple', 'price' => 1799, 'desc' => 'Chip M2 Pro, Liquid Retina XDR'],

            // DELL
            ['name' => 'Dell XPS 13 9315', 'brand' => 'Dell', 'price' => 949, 'desc' => 'i5-1230U, 8GB RAM, 256GB SSD'],
            ['name' => 'Dell XPS 15 9530', 'brand' => 'Dell', 'price' => 1899, 'desc' => 'i7-13700H, RTX 4050, 16GB RAM'],
            ['name' => 'Dell Inspiron 14 5430', 'brand' => 'Dell', 'price' => 749, 'desc' => 'i5-1335U, 16GB RAM, Văn phòng'],
            ['name' => 'Dell Alienware m16 R1', 'brand' => 'Dell', 'price' => 2199, 'desc' => 'i9-13900HX, RTX 4080, Gaming'],
            ['name' => 'Dell Vostro 3520', 'brand' => 'Dell', 'price' => 599, 'desc' => 'i5-1235U, Bền bỉ cho doanh nghiệp'],
            ['name' => 'Dell Latitude 7440', 'brand' => 'Dell', 'price' => 1250, 'desc' => 'Dòng doanh nhân cao cấp, i7 Gen 13'],
            ['name' => 'Dell G15 5530', 'brand' => 'Dell', 'price' => 1099, 'desc' => 'i7-13650HX, RTX 4050, Gaming giá rẻ'],
            ['name' => 'Dell Precision 3581', 'brand' => 'Dell', 'price' => 1450, 'desc' => 'Trạm đồ họa chuyên nghiệp'],
            ['name' => 'Dell Inspiron 16 Plus', 'brand' => 'Dell', 'price' => 1150, 'desc' => 'Màn hình 3K, i7 Gen 13'],
            ['name' => 'Dell Alienware x14 R2', 'brand' => 'Dell', 'price' => 1699, 'desc' => 'Gaming mỏng nhẹ nhất thế giới'],

            // LENOVO
            ['name' => 'Lenovo ThinkPad X1 Carbon G11', 'brand' => 'Lenovo', 'price' => 1650, 'desc' => 'Siêu bền, sợi Carbon, i7-1355U'],
            ['name' => 'Lenovo Legion Pro 5i', 'brand' => 'Lenovo', 'price' => 1399, 'desc' => 'i7-13700HX, RTX 4060, 165Hz'],
            ['name' => 'Lenovo Yoga 7i Gen 8', 'brand' => 'Lenovo', 'price' => 849, 'desc' => 'Xoay gập 360 độ, màn hình cảm ứng'],
            ['name' => 'Lenovo IdeaPad Slim 5', 'brand' => 'Lenovo', 'price' => 649, 'desc' => 'Ryzen 7 7730U, Vỏ nhôm'],
            ['name' => 'Lenovo LOQ 15IRH8', 'brand' => 'Lenovo', 'price' => 899, 'desc' => 'Gaming quốc dân mới của Lenovo'],
            ['name' => 'Lenovo ThinkBook 14 G6', 'brand' => 'Lenovo', 'price' => 720, 'desc' => 'Doanh nhân trẻ, i5-1335U'],
            ['name' => 'Lenovo Legion Slim 7i', 'brand' => 'Lenovo', 'price' => 1799, 'desc' => 'Gaming cao cấp, mỏng nhẹ'],
            ['name' => 'Lenovo Yoga Slim 7i Carbon', 'brand' => 'Lenovo', 'price' => 1299, 'desc' => 'Siêu nhẹ chưa tới 1kg'],
            ['name' => 'Lenovo IdeaPad Gaming 3', 'brand' => 'Lenovo', 'price' => 799, 'desc' => 'Ryzen 5, RTX 3050 giá tốt'],
            ['name' => 'Lenovo ThinkPad T14 G4', 'brand' => 'Lenovo', 'price' => 1100, 'desc' => 'Nồi đồng cối đá, i5 Gen 13'],

            // ASUS
            ['name' => 'Asus Zenbook 14 OLED', 'brand' => 'Asus', 'price' => 999, 'desc' => 'Màn hình OLED 2.8K, Ultra 5'],
            ['name' => 'Asus Vivobook S 14', 'brand' => 'Asus', 'price' => 749, 'desc' => 'i5-13500H, Trẻ trung năng động'],
            ['name' => 'Asus ROG Zephyrus G14', 'brand' => 'Asus', 'price' => 1599, 'desc' => 'Ryzen 9, RTX 4060, Anime Matrix'],
            ['name' => 'Asus TUF Gaming A15', 'brand' => 'Asus', 'price' => 949, 'desc' => 'Bền chuẩn quân đội, RTX 4050'],
            ['name' => 'Asus ExpertBook B9', 'brand' => 'Asus', 'price' => 1899, 'desc' => 'Laptop doanh nhân nhẹ nhất thế giới'],
            ['name' => 'Asus ROG Strix G16', 'brand' => 'Asus', 'price' => 1650, 'desc' => 'i7-13650HX, chuyên game'],
            ['name' => 'Asus Zenbook Pro 14 Duo', 'brand' => 'Asus', 'price' => 2199, 'desc' => '2 màn hình độc đáo, OLED'],
            ['name' => 'Asus Vivobook Go 15', 'brand' => 'Asus', 'price' => 399, 'desc' => 'Giá rẻ cho sinh viên'],
            ['name' => 'Asus ROG Flow X13', 'brand' => 'Asus', 'price' => 1499, 'desc' => 'Gaming xoay gập 13 inch'],
            ['name' => 'Asus Zenbook S 13 OLED', 'brand' => 'Asus', 'price' => 1399, 'desc' => 'Siêu mỏng 1cm, bảo vệ môi trường'],

            // HP
            ['name' => 'HP Spectre x360 14', 'brand' => 'HP', 'price' => 1449, 'desc' => '2-in-1 cao cấp nhất của HP'],
            ['name' => 'HP Envy x360 15', 'brand' => 'HP', 'price' => 849, 'desc' => 'Màn hình lớn cảm ứng, Ryzen 7'],
            ['name' => 'HP Pavilion 15', 'brand' => 'HP', 'price' => 620, 'desc' => 'i5-1335U, Sang trọng giá hời'],
            ['name' => 'HP Victus 16', 'brand' => 'HP', 'price' => 920, 'desc' => 'Gaming thiết kế tối giản'],
            ['name' => 'HP Omen 17', 'brand' => 'HP', 'price' => 1799, 'desc' => 'i7-13700HX, RTX 4070'],
            ['name' => 'HP ProBook 450 G10', 'brand' => 'HP', 'price' => 899, 'desc' => 'Bền bỉ cho văn phòng'],
            ['name' => 'HP EliteBook 840 G10', 'brand' => 'HP', 'price' => 1350, 'desc' => 'Bảo mật cao cấp doanh nghiệp'],
            ['name' => 'HP Pavilion Aero 13', 'brand' => 'HP', 'price' => 799, 'desc' => 'Siêu nhẹ dưới 1kg, Ryzen 5'],
            ['name' => 'HP Omen Transcend 16', 'brand' => 'HP', 'price' => 1999, 'desc' => 'Màn hình Mini-LED cực đẹp'],
            ['name' => 'HP ZBook Studio G10', 'brand' => 'HP', 'price' => 2500, 'desc' => 'Máy trạm di động cao cấp'],
        ];

        // 3. Chuẩn bị dữ liệu để insert
        $data = [];
        foreach ($laptopModels as $item) {
            $data[] = [
                'name' => $item['name'],
                'image' => null,
                'price' => $item['price'],
                'description' => $item['desc'],
                'category_id' => 1, // Giả sử 1 là Laptop
                'brand_id' => $brands[$item['brand']], // Lấy ID tương ứng từ mảng $brands
                'sold' => rand(5, 300),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // 4. Đẩy vào Database
        DB::table('products')->insert($data);
    }
}