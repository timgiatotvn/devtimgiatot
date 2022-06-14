<?php

return [
    'feeds' => [
        'main' => [
            /*
             * Here you can specify which class and method will return
             * the items that should appear in the feed. For example:
             * 'App\Model@getAllFeedItems'
             *
             * You can also pass an argument to that method:
             * ['App\Model@getAllFeedItems', 'argument']
             */
            'items' => 'App\Feed\NewsItem@getFeedItems',

            /*
             * The feed will be available on this url.
             */
            'url' => '/feed',

            'title' => 'Timgiatot.vn - Tìm giá tốt nhất tại thị trường Việt Nam',
            'description' => 'Timgiatot.vn - Công cụ so sánh, đánh giá, tìm giá tốt nhất tại thị trường Việt Nam. Cung cấp các nơi bán hàng uy tín hàng đầu tại Thị Trường.',
            'language' => 'en-US',

            /*
             * The view that will render the feed.
             */
            //'view' => 'clients::feed.index',
            //'format' => 'atom',
            /*
             * The type to be used in the <link> tag
             */
            'type' => 'application/atom+xml',
        ],
    ],
];
