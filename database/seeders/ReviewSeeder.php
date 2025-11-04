<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reviews')->insert([
            [
                'author' => 'Thuỷ Tiên',
                'avatar' => './nonbaohiem/avatars/thuytien.jpg',
                'verified' => true,
                'rating' => 5,
                'variant' => 'Labubu',
                'date' => '2025-03-02',
                'title' => 'Đẹp & nhẹ',
                'content' => 'Mũ lên form gọn, bé 4 tuổi đội vừa vặn. Màu in rõ nét.',
                'media' => json_encode([
                    ['type' => 'image', 'src' => './nonbaohiem/anhlamro/labubu.png'],
                    ['type' => 'image', 'src' => './nonbaohiem/anhlamro/babytreehong.png'],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'author' => 'Minh Quân',
                'avatar' => '',
                'verified' => true,
                'rating' => 4,
                'variant' => 'Kurumi Hồng',
                'date' => '2025-02-25',
                'title' => 'Ổn so với giá',
                'content' => 'Mũ chắc chắn, màu đúng như hình. Giao hàng nhanh.',
                'media' => json_encode([
                    ['type' => 'video', 'src' => './nonbaohiem/media/review1.mp4'],
                    ['type' => 'image', 'src' => './nonbaohiem/anhlamro/kurumi_hong.png'],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'author' => 'Hồng Nhung',
                'avatar' => '',
                'verified' => false,
                'rating' => 5,
                'variant' => 'Baby Tree Cam',
                'date' => '2025-02-18',
                'title' => 'Bé mê luôn',
                'content' => 'Bé đòi đội suốt, nhìn ngoài còn xinh hơn hình.',
                'media' => json_encode([
                    ['type' => 'image', 'src' => './nonbaohiem/anhlamro/babytreecam.png'],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
