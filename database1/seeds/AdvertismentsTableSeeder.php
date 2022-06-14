<?php

use Illuminate\Database\Seeder;

class AdvertismentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            //slide
            [
                'title' => 'Timgiatot.vn',
                'url' => '#',
                'thumbnail' => '/storage/photos/Slideshows/shopee-5-5-pc.jpeg',
                'admin_id' => '1',
                'type' => 'slideshow',
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s"),
            ],
            [
                'title' => 'Timgiatot.vn',
                'url' => '#',
                'thumbnail' => '/storage/photos/Slideshows/shopee-5-5-pc.jpeg',
                'admin_id' => '1',
                'type' => 'slideshow',
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s"),
            ],

            //logo
            [
                'title' => 'Timgiatot.vn',
                'url' => '#',
                'thumbnail' => '/storage/photos/logo.png',
                'admin_id' => '1',
                'type' => 'logo',
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s"),
            ],

            //link
            [
                'title' => 'FLASH SALE SHOPEE 5.5',
                'description' => 'Miễn phí vận chuyển 0đ',
                'url_title' => 'Shopee ngay',
                'url' => 'http://click.adpia.vn/tracking.php?m=shopee&a=A100047172&l=0000',
                'thumbnail' => '/storage/photos/flash-sale-timgiatot-chuan-598x302.jpeg',
                'admin_id' => '1',
                'type' => 'link',
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s"),
            ],
            [
                'title' => 'LAZADA 5.5',
                'description' => 'Freeship toàn quốc',
                'url_title' => 'Lazada ngay',
                'url' => 'http://click.adpia.vn/tracking.php?m=lazada&a=A100047172&l=0000',
                'thumbnail' => '/storage/photos/flash-sale-timgiatot-chuan-598x302.jpeg',
                'admin_id' => '1',
                'type' => 'link',
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s"),
            ],
            [
                'title' => 'TIKI SALE 5.5',
                'description' => 'Tiki Tết Sale 49%',
                'url_title' => 'Tiki ngay',
                'url' => 'http://click.adpia.vn/tracking.php?m=tiki&a=A100047172&l=0000',
                'thumbnail' => '/storage/photos/flash-sale-timgiatot-chuan-598x302.jpeg',
                'admin_id' => '1',
                'type' => 'link',
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s"),
            ],
            [
                'title' => 'SALE SENDO 5.5',
                'description' => 'Deal 1K, Freeship',
                'url_title' => 'Sendo ngay',
                'url' => 'http://click.adpia.vn/tracking.php?m=sendo&a=A100047172&l=0000',
                'thumbnail' => '/storage/photos/flash-sale-timgiatot-chuan-598x302.jpeg',
                'admin_id' => '1',
                'type' => 'link',
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s"),
            ],
            [
                'title' => 'ĐIỆN THOẠI',
                'description' => 'So sánh và mua điện thoại với giá rẻ nhất.',
                'url_title' => 'Tìm giá tốt',
                'url' => 'http://click.adpia.vn/tracking.php?m=shopee&a=A100047172&l=0000',
                'thumbnail' => '/storage/photos/iphone-500x500-1-100x100.png',
                'admin_id' => '1',
                'type' => 'link',
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s"),
            ],
            [
                'title' => 'LAPTOP',
                'description' => 'So sánh mua laptop với giá rẻ nhất.',
                'url_title' => 'Tìm giá tốt',
                'url' => 'http://click.adpia.vn/tracking.php?m=shopee&a=A100047172&l=0000',
                'thumbnail' => '/storage/photos/o1-100x100.jpeg',
                'admin_id' => '1',
                'type' => 'link',
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s"),
            ],
            [
                'title' => 'TABLET',
                'description' => 'So sánh và mua máy tính bảng với giá rẻ nhất.',
                'url_title' => 'Tìm giá tốt',
                'url' => 'http://click.adpia.vn/tracking.php?m=shopee&a=A100047172&l=0000',
                'thumbnail' => '/storage/photos/45-100x100.jpeg',
                'admin_id' => '1',
                'type' => 'link',
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s"),
            ],
            [
                'title' => 'MÁY ẢNH',
                'description' => 'So sánh và mua máy ảnh với giá rẻ nhất.',
                'url_title' => 'Tìm giá tốt',
                'url' => 'http://click.adpia.vn/tracking.php?m=shopee&a=A100047172&l=0000',
                'thumbnail' => '/storage/photos/37-100x100.jpeg',
                'admin_id' => '1',
                'type' => 'link',
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s"),
            ],
            [
                'title' => 'MART TIVI',
                'description' => 'So sánh và mua tivi với giá rẻ nhất.',
                'url_title' => 'Tìm giá tốt',
                'url' => 'http://click.adpia.vn/tracking.php?m=shopee&a=A100047172&l=0000',
                'thumbnail' => '/storage/photos/48-100x100.jpeg',
                'admin_id' => '1',
                'type' => 'link',
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s"),
            ],
            [
                'title' => 'TỦ LẠNH',
                'description' => 'So sánh và mua tủ lạnh với giá rẻ nhất.',
                'url_title' => 'Tìm giá tốt',
                'url' => 'http://click.adpia.vn/tracking.php?m=shopee&a=A100047172&l=0000',
                'thumbnail' => '/storage/photos/66.jpeg',
                'admin_id' => '1',
                'type' => 'link',
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s"),
            ],
            [
                'title' => 'ĐIỀU HÒA',
                'description' => 'So sánh và mua điều hòa với giá rẻ nhất.',
                'url_title' => 'Tìm giá tốt',
                'url' => 'http://click.adpia.vn/tracking.php?m=shopee&a=A100047172&l=0000',
                'thumbnail' => '/storage/photos/53-100x100.jpeg',
                'admin_id' => '1',
                'type' => 'link',
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s"),
            ],
            [
                'title' => 'MÁY GIẶT',
                'description' => 'So sánh và mua máy giặt với giá rẻ nhất.',
                'url_title' => 'Tìm giá tốt',
                'url' => 'http://click.adpia.vn/tracking.php?m=shopee&a=A100047172&l=0000',
                'thumbnail' => '/storage/photos/64.jpeg',
                'admin_id' => '1',
                'type' => 'link',
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s"),
            ],
        ];

        foreach ($data as $row) {
            DB::table('advertisements')->insert($row);
        }

    }
}
