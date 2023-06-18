<?php

namespace Modules\Admins\Services;

use App\Model\Post;
use Illuminate\Support\Facades\Storage;

class CrawlService
{
    public function crawlSoSanhGiaCom($data)
    {
        for ($page = 1; $page <= $data->page_number; $page++) {
            $html = file_get_html_custom($data->link . '?page=' . $page);
            $news = [];
            if (!empty($html->find('#news-list .posts'))) {
                foreach ($html->find('#news-list .posts li') as $newsItem) {
                    try {
                        if (!empty($newsItem->find('.img-wrapper', 0))) {
                            $thumbnail = $newsItem->find('.img-wrapper img', 0)->attr['data-src'];
                        } else {
                            $thumbnail = NULL;
                        }
                        if (!empty($newsItem->find('.content-wrapper a', 0))) {
                            $link = $newsItem->find('.content-wrapper a', 0)->href;
                            $checkExistNews = Post::where('link_origin_encode', md5($link))->first();
        
                            if (empty($checkExistNews)) {
                                $title = trim($newsItem->find('.content-wrapper a', 0)->plaintext);
                                $news[] = [
                                    'title' => $title,
                                    'slug' => str_slug($title),
                                    'thumbnail' => $this->storeThumbnail($thumbnail, $title),
                                    //'description' => !empty($newsItem->find('.content-wrapper .short-description', 0)) ? trim($newsItem->find('.content-wrapper .short-description', 0)->plaintext) : NULL,
                                    'category_id' => 4,
                                    'link_origin' => $link,
                                    'link_origin_encode' => md5($link),
                                    'admin_id' => -1,
                                    'status' => 0,
                                    'content' => $this->get_content_so_sanh_gia($link) . "<p>Nguồn: $link</p>",
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'updated_at' => date('Y-m-d H:i:s')
                                ];
                                //$this->storeThumbnail($thumbnail, $title);
                            }
                        }
                    } catch (\Throwable $th) {
                    }
                }
            }
            if (count($news) > 0) {
                Post::insert($news);
            }
        }
    }
    
    public function storeThumbnail($thumbnail, $title)
    {
        if (!empty($thumbnail)) {
            \Storage::disk('s3')->put('photos/' . str_slug($title) . '.jpg', fopen($thumbnail, 'r'));
            $s3 = \Storage::disk('s3')->getAdapter()->getClient();
            
            return $s3->getObjectUrl(env('AWS_BUCKET'), 'photos/' . str_slug($title) . '.jpg');
            // $path = storage_path("app/public/photos/" . str_slug($title) . '.jpg');
            // file_put_contents($path, fopen($thumbnail, 'r'));
        } else {
            return NULL;
        }
    }

    public function crawlDienMayXanh($data)
    {
        $news = [];
        $html = file_get_html_custom($data->link);

        if (!empty($html->find('#moinhat .box-featured ul li'))) {
            foreach ($html->find('#moinhat .box-featured ul li') as $newsItem) {
                try {
                    $title = html_entity_decode($newsItem->find('h3', 0)->plaintext);
                    $link = "https://www.dienmayxanh.com" . $newsItem->find('a', 0)->href;
                    $thumbnail = NULL;

                    if (!empty($newsItem->find('img'))) {
                        $thumbnail = $newsItem->find('img', 0)->src;
                    }
                    $checkExistNews = Post::where('link_origin_encode', md5($link))->first();

                    if (empty($checkExistNews)) {
                        $news[] = $this->detail_news($title, $thumbnail, $link);
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        }
        if (!empty($html->find('#moinhat .listnews'))) {
            foreach ($html->find('#moinhat .listnews li') as $newsItem) {
                try {
                    $title = html_entity_decode($newsItem->find('h3', 0)->plaintext);
                    $link = "https://www.dienmayxanh.com" . $newsItem->find('a', 0)->href;
                    $thumbnail = NULL;

                    if (!empty($newsItem->find('img'))) {
                        $thumbnail = $newsItem->find('img', 0)->src;

                        if (empty($thumbnail)) {
                            $thumbnail = $newsItem->find('img', 0)->attr['data-original'];
                        }
                    }
                    $checkExistNews = Post::where('link_origin_encode', md5($link))->first();

                    if (empty($checkExistNews)) {
                        $news[] = $this->detail_news($title, $thumbnail, $link);
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        }        
        // if (!empty($html->find('ul.box-featured'))) {
        //     foreach ($html->find('ul.box-featured li.featured') as $newsItem) {
        //         try {
        //             $title = html_entity_decode($newsItem->find('a div.title h3', 0)->plaintext);
        //             $thumbnail = !empty($newsItem->find('div.img img', 0)) ? $newsItem->find('div.img img', 0)->src : NULL;
        //             $link = "https://www.dienmayxanh.com" . $newsItem->find('a', 0)->href;
        //             $checkExistNews = Post::where('link_origin_encode', md5($link))->first();
                    
        //             if (empty($checkExistNews)) {
        //                 $news[] = $this->detail_news($title, $thumbnail, $link);
        //             }
        //         } catch (\Throwable $th) {
                    
        //         }
        //     }
        // }
        // if (!empty($html->find('ul.listpost'))) {
        //     foreach ($html->find('ul.listpost li') as $key => $newsItem) {
        //         try {
        //             if ($key > 0) {
        //                 $title = html_entity_decode($newsItem->find('a span', 0)->plaintext);
        //                 $link = "https://www.dienmayxanh.com" . $newsItem->find('a', 0)->href;
        //                 $checkExistNews = Post::where('link_origin_encode', md5($link))->first();
                    
        //                 if (empty($checkExistNews)) {
        //                     $news[] = $this->detail_news($title, $thumbnail = NULL, $link);
        //                 }
        //             }
        //         } catch (\Throwable $th) {
        //         }
        //     }
        // }
        // if (!empty($html->find('div#lstMainNews'))) {
        //     foreach ($html->find('div#lstMainNews ul li') as $key => $newsItem) {
        //         try {
        //             $title = html_entity_decode($newsItem->find('a div.title h3', 0)->plaintext);
        //             if (!empty($newsItem->find('div.img img', 0))) {
        //                 $thumbnail = $newsItem->find('div.img img', 0)->src;

        //                 if (empty($thumbnail)) {
        //                     $thumbnail = $newsItem->find('div.img img', 0)->attr['data-src'];
        //                 }
        //             } else {
        //                 $thumbnail = NULL;
        //             }
        //             $link = "https://www.dienmayxanh.com" . $newsItem->find('a', 0)->href;
        //             $checkExistNews = Post::where('link_origin_encode', md5($link))->first();
                    
        //             if (empty($checkExistNews)) {
        //                 $news[] = $this->detail_news($title, $thumbnail, $link);
        //             }
        //         } catch (\Throwable $th) {
                    
        //         }
        //     }
        // }
        if (count($news) > 0) {
            Post::insert($news);
        }
    }

    public function detail_news($title, $thumbnail, $link)
    {
        return [
            'title' => $title,
            'slug' => str_slug($title),
            'thumbnail' => $this->storeThumbnail($thumbnail, $title),
            'category_id' => 4,
            'link_origin' => $link,
            'link_origin_encode' => md5($link),
            'admin_id' => -1,
            'status' => 0,
            'content' => $this->get_content_dien_may_xanh($link) . "<p>Nguồn: $link</p>",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
    }

    public function get_content_dien_may_xanh($link)
    {
        $html = file_get_html_custom($link);

        if (!empty($html->find('#bxcontentnewsindx'))) {
            $content = $html->find('#bxcontentnewsindx', 0)->innertext;
            
            if (!empty($html->find('.infobox'))) {
                foreach ($html->find('.infobox') as $read_more_item) {
                    $content = str_replace($read_more_item->outertext, "", $content);
                }
            }
            
            return str_replace("data-src", "src", $content);
        }

        return NULL;
    }

    public function crawlWebSoSanhVn($data)
    {
        $news = [];
        $html = file_get_html_custom($data->link);
        
        if (!empty($html->find('.blog-sticky-item')) && count($html->find('.blog-sticky-item')) > 0) {
            foreach ($html->find('.blog-sticky-item') as $newsItem) {
                try {
                    if (!empty($newsItem->find('a', 0))) {
                        $link = $newsItem->find('a', 0)->href;
                        $checkExistNews = Post::where('link_origin_encode', md5($link))->first();

                        if (!empty($newsItem->find('a img', 0))) {
                            $thumbnail = $newsItem->find('a img', 0)->attr['data-src'];
                        } else {
                            $thumbnail = NULL;
                        }
    
                        if (empty($checkExistNews)) {
                            $title = trim(html_entity_decode($newsItem->find('a', 0)->plaintext));
                            $news[] = [
                                'title' => $title,
                                'slug' => str_slug($title),
                                'thumbnail' => $this->storeThumbnail($thumbnail, $title),
                                //'description' => !empty($newsItem->find('.blog-sticky-desc', 0)) ? trim($newsItem->find('.blog-sticky-desc', 0)->plaintext) : NULL,
                                'category_id' => 4,
                                'link_origin' => $link,
                                'link_origin_encode' => md5($link),
                                'admin_id' => -1,
                                'status' => 0,
                                'content' => $this->get_content_web_so_sanh_gia($link) . "<p>Nguồn: $link</p>",
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            ];
                            //$this->storeThumbnail($thumbnail, $title);
                        }
                    }
                } catch (\Throwable $th) {
                }
            }
        }
        if (!empty($html->find('.blog-category-item')) && count($html->find('.blog-category-item')) > 0) {
            foreach ($html->find('.blog-category-item') as $newsItem) {
                try {
                    if (!empty($newsItem->find('a', 0))) {
                        $link = $newsItem->find('a', 0)->href;
                        $checkExistNews = Post::where('link_origin_encode', md5($link))->first();
                        
                        if (!empty($newsItem->find('a img', 0))) {
                            $thumbnail = $newsItem->find('a img', 0)->attr['data-src'];
                        } else {
                            $thumbnail = NULL;
                        }
                        if (empty($checkExistNews)) {
                            $title = trim(html_entity_decode($newsItem->find('a', 0)->plaintext));
                            $news[] = [
                                'title' => $title,
                                'slug' => str_slug($title),
                                'thumbnail' => $this->storeThumbnail($thumbnail, $title),
                                //'description' => !empty($newsItem->find('.blog-category-desc', 0)) ? trim($newsItem->find('.blog-category-desc', 0)->plaintext) : NULL,
                                'category_id' => 4,
                                'link_origin' => $link,
                                'link_origin_encode' => md5($link),
                                'admin_id' => -1,
                                'status' => 0,
                                'content' => $this->get_content_web_so_sanh_gia($link) . "<p>Nguồn: $link</p>",
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            ];
                            //$this->storeThumbnail($thumbnail, $title);
                        }
                    }
                } catch (\Throwable $th) {
                    
                }
            }
        }
        if (count($news) > 0) {
            Post::insert($news);
        }
    }

    public function get_content_web_so_sanh_gia($link)
    {
        try {
            $html = file_get_html_custom($link);

            if (!empty($html->find('.single-article-content'))) {
                $content = $html->find('.single-article-content', 0)->innertext;
                
                return trim($content);
            }

            return NULL;
        } catch (\Throwable $th) {
            return NULL;
        }
    }

    public function get_content_so_sanh_gia($link)
    {
        try {
            $html = file_get_html_custom($link);
            $content = $html->find('.article-content', 0)->innertext;
    
            return trim($content);
        } catch (\Throwable $th) {
            return  NULL;
        }
    }
}