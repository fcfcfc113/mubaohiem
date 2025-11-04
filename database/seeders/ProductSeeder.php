<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $variants = [
            'labubu' => [
                'name' => 'Labubu',
                'price' => 249000,
                'compare_at' => 299000,
                'image' => 'images/nonbaohiem/anhlamro/labubu.png',
            ],
            'kurumihong' => [
                'name' => 'Kurumi Hồng',
                'price' => 259000,
                'compare_at' => 289000,
                'image' => 'images/nonbaohiem/anhlamro/kurumi_hong.png',
            ],
            'kurumitim' => [
                'name' => 'Kurumi Tím',
                'price' => 269000,
                'compare_at' => 299000,
                'image' => 'images/nonbaohiem/anhlamro/kurumi_tim.png',
            ],
            'cappypara' => [
                'name' => 'Cappypara',
                'price' => 279000,
                'compare_at' => 299000,
                'image' => 'images/nonbaohiem/anhlamro/cappypara.png',
            ],
            'lupy' => [
                'name' => 'Lupy',
                'price' => 239000,
                'compare_at' => 269000,
                'image' => 'images/nonbaohiem/anhlamro/lupy.png',
            ],
            'babytreecam' => [
                'name' => 'Baby Tree Cam',
                'price' => 249000,
                'compare_at' => 289000,
                'image' => 'images/nonbaohiem/anhlamro/babytreecam.png',
            ],
            'babytreeden' => [
                'name' => 'Baby Tree Đen',
                'price' => 259000,
                'compare_at' => 299000,
                'image' => 'images/nonbaohiem/anhlamro/babytreeden.png',
            ],
            'babytreehong' => [
                'name' => 'Baby Tree Hồng',
                'price' => 239000,
                'compare_at' => 289000,
                'image' => 'images/nonbaohiem/anhlamro/babytreehong.png',
            ],
        ];

        foreach ($variants as $slug => $data) {
            Product::create([
                'parent_id'   => null,
                'slug'        => 'v_'.$slug,
                'short_name'  => $slug,
                'name'        => $data['name'],
                'description' => 'Mẫu nón bảo hiểm thời trang ' . $data['name'],
                'category'    => 'nonbaohiem',
                'price'       => $data['price'],
                'compare_at'  => $data['compare_at'],
                'thumbnail'   => $data['image'],
                'images'      => json_encode([$data['image']]),
                'main'        => 0,
            ]);
        }
    }
}
