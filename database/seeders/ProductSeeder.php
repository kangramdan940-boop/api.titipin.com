<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Categories
        $categories = [
            ['name' => 'Elektronik', 'slug' => 'elektronik', 'emoji' => '📱'],
            ['name' => 'Fashion', 'slug' => 'fashion', 'emoji' => '👟'],
            ['name' => 'Skincare', 'slug' => 'skincare', 'emoji' => '🧴'],
            ['name' => 'Rumah Tangga', 'slug' => 'rumah-tangga', 'emoji' => '🏠'],
            ['name' => 'UMKM', 'slug' => 'umkm', 'emoji' => '🎨'],
        ];
        foreach ($categories as $c) { Category::create($c); }

        // Events
        $events = [
            ['name' => 'PRJ Jakarta Fair 2026', 'slug' => 'prj-2026', 'location' => 'JIEXPO Kemayoran, Jakarta', 'start_date' => '2026-06-11', 'end_date' => '2026-07-12', 'status' => 'active', 'max_discount' => 50, 'emoji' => '🎪'],
            ['name' => 'Nike Warehouse Sale', 'slug' => 'nike-warehouse-2026', 'location' => 'ICE BSD, Tangerang', 'start_date' => '2026-07-20', 'end_date' => '2026-07-27', 'status' => 'upcoming', 'max_discount' => 70, 'emoji' => '👟'],
            ['name' => 'Jakarta Great Sale 2026', 'slug' => 'jakarta-great-sale-2026', 'location' => 'Mall seluruh Jakarta', 'start_date' => '2026-08-01', 'end_date' => '2026-08-31', 'status' => 'upcoming', 'max_discount' => 80, 'emoji' => '🛍️'],
        ];
        foreach ($events as $e) { Event::create($e); }

        // Products
        $prj = Event::where('slug', 'prj-2026')->first();
        $products = [
            ['name' => 'Samsung Galaxy A55', 'slug' => 'samsung-a55', 'category_id' => 1, 'event_id' => $prj->id, 'price' => 3500000, 'original_price' => 4200000, 'description' => 'Samsung Galaxy A55 5G, Super AMOLED 6.6", kamera 50MP OIS, baterai 5000mAh.', 'emoji' => '📱', 'gradient' => 'from-cyan-400 to-blue-500', 'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', 'wa_message' => 'Halo Titipin! Saya mau titip beli Samsung Galaxy A55 dari PRJ.', 'stock' => 10],
            ['name' => 'Lenovo IdeaPad Slim 3', 'slug' => 'lenovo-ideapad', 'category_id' => 1, 'event_id' => $prj->id, 'price' => 7200000, 'original_price' => 8999000, 'description' => 'Laptop AMD Ryzen 5, RAM 8GB, SSD 512GB. Garansi resmi.', 'emoji' => '💻', 'gradient' => 'from-violet-400 to-purple-500', 'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', 'wa_message' => 'Halo Titipin! Saya mau titip beli Lenovo IdeaPad Slim 3 dari PRJ.', 'stock' => 5],
            ['name' => 'Sony WH-1000XM5', 'slug' => 'sony-xm5', 'category_id' => 1, 'event_id' => $prj->id, 'price' => 3800000, 'original_price' => 4999000, 'description' => 'Headphone wireless ANC terbaik. 30 jam battery, USB-C.', 'emoji' => '🎧', 'gradient' => 'from-amber-400 to-orange-500', 'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', 'wa_message' => 'Halo Titipin! Saya mau titip beli Sony WH-1000XM5 dari PRJ.', 'stock' => 8],
            ['name' => 'Nike Air Max 90', 'slug' => 'nike-airmax90', 'category_id' => 2, 'event_id' => $prj->id, 'price' => 1200000, 'original_price' => 1899000, 'description' => 'Sepatu iconic Nike Air Max 90. Original 100% booth resmi Nike PRJ.', 'emoji' => '👟', 'gradient' => 'from-rose-400 to-red-500', 'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', 'wa_message' => 'Halo Titipin! Saya mau titip beli Nike Air Max 90 dari PRJ. Size: ', 'stock' => 15],
            ['name' => 'Skintific Bundle 5in1', 'slug' => 'skintific-bundle', 'category_id' => 3, 'event_id' => $prj->id, 'price' => 185000, 'original_price' => 350000, 'description' => 'Paket lengkap: Cleanser + Toner + Serum + Moisturizer + Sunscreen.', 'emoji' => '🧴', 'gradient' => 'from-pink-400 to-fuchsia-500', 'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', 'wa_message' => 'Halo Titipin! Saya mau titip beli Skintific Bundle 5in1 dari PRJ.', 'stock' => 20],
            ['name' => 'TCL 55" Smart TV 4K', 'slug' => 'tcl-tv55', 'category_id' => 4, 'event_id' => $prj->id, 'price' => 4500000, 'original_price' => 6299000, 'description' => 'Smart TV 55" 4K UHD, Google TV, Dolby Audio.', 'emoji' => '📺', 'gradient' => 'from-blue-400 to-indigo-500', 'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', 'wa_message' => 'Halo Titipin! Saya mau titip beli TCL 55 inch Smart TV dari PRJ.', 'stock' => 3],
            ['name' => 'Philips Air Fryer HD9200', 'slug' => 'philips-airfryer', 'category_id' => 4, 'event_id' => $prj->id, 'price' => 899000, 'original_price' => 1399000, 'description' => 'Air Fryer 4.1L, Rapid Air. Goreng tanpa minyak. Garansi 2 tahun.', 'emoji' => '🍳', 'gradient' => 'from-emerald-400 to-teal-500', 'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', 'wa_message' => 'Halo Titipin! Saya mau titip beli Philips Air Fryer HD9200 dari PRJ.', 'stock' => 7],
            ['name' => 'Amazfit GTS 4 Mini', 'slug' => 'amazfit-gts4', 'category_id' => 1, 'event_id' => $prj->id, 'price' => 950000, 'original_price' => 1499000, 'description' => 'Smartwatch AMOLED, GPS, SpO2, 120+ sport modes. Battery 15 hari.', 'emoji' => '⌚', 'gradient' => 'from-sky-400 to-cyan-500', 'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', 'wa_message' => 'Halo Titipin! Saya mau titip beli Amazfit GTS 4 Mini dari PRJ. Warna: ', 'stock' => 12],
        ];
        foreach ($products as $p) { Product::create($p); }
    }
}
