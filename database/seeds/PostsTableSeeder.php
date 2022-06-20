<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title' => 'TOP 7 Công thức sữa rửa mặt Handmade tốt cho mọi loại da',
                'description' => '<p>TOP 7 Công thức sữa rửa mặt Handmade tốt cho mọi loại da Tổng hợp 7 cách làm Sữa rửa mặt handmade dành cho mọi loại da với nguồn nguyên liệu dễ kiếm và chi phí thấp Các sản phẩm sữa rửa mặt hiện nay có ....</p>',
                'content' => '<p>Các sản phẩm sữa rửa mặt hiện nay có thể làm bạn bối rối và khó lựa chọn vì đây là sản phẩm được sản xuất đại trà theo một số công thức nhất định.</p>
                <p>Trên thực tế, cùng một loại da nhưng mỗi người lại có một vấn đề về da cũng như cơ địa khác nhau mà sữa rửa mặt thông thường có thể không đáp ứng được.</p>
                <p>Với những công thức làm sữa rửa mặt handmade dưới đây, bạn sẽ có nhiều sự lựa chọn mới lạ hơn cho việc làm sạch da mặt và có thể tự điều chỉnh sao cho phù hợp nhất với từng thể trạng da cụ thể của từng người.</p>
                <p>Các nàng hãy tham khảo những gợi ý sau đây của mình để vệ sinh da mặt hàng ngày của mình nhé!</p>',
                'thumbnail' => '/storage/photos/news/tt1.png',
                'admin_id' => '1',
                'type' => 'new',
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s"),
            ],
            [
                'title' => '7 lợi ích sức khỏe tốt nhất của nước kiềm cho cơ thể bạn',
                'description' => '<p>TOP 7 Công thức sữa rửa mặt Handmade tốt cho mọi loại da Tổng hợp 7 cách làm Sữa rửa mặt handmade dành cho mọi loại da với nguồn nguyên liệu dễ kiếm và chi phí thấp Các sản phẩm sữa rửa mặt hiện nay có ....</p>',
                'content' => '<p>Các sản phẩm sữa rửa mặt hiện nay có thể làm bạn bối rối và khó lựa chọn vì đây là sản phẩm được sản xuất đại trà theo một số công thức nhất định.</p>
                <p>Trên thực tế, cùng một loại da nhưng mỗi người lại có một vấn đề về da cũng như cơ địa khác nhau mà sữa rửa mặt thông thường có thể không đáp ứng được.</p>
                <p>Với những công thức làm sữa rửa mặt handmade dưới đây, bạn sẽ có nhiều sự lựa chọn mới lạ hơn cho việc làm sạch da mặt và có thể tự điều chỉnh sao cho phù hợp nhất với từng thể trạng da cụ thể của từng người.</p>
                <p>Các nàng hãy tham khảo những gợi ý sau đây của mình để vệ sinh da mặt hàng ngày của mình nhé!</p>',
                'thumbnail' => '/storage/photos/news/tt1.png',
                'admin_id' => '1',
                'type' => 'new',
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s"),
            ]
        ];

        for ($i = 0; $i < 5; $i++) {
            foreach ($data as $row) {
                $row['slug'] = \Illuminate\Support\Str::slug($row['title'], '-');
                $row['category_id'] = 3;
                DB::table('posts')->insert($row);
            }
            foreach ($data as $row) {
                $row['slug'] = \Illuminate\Support\Str::slug($row['title'], '-');
                $row['category_id'] = 20;
                DB::table('posts')->insert($row);
            }
        }
    }
}
