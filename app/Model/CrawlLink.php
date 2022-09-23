<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CrawlLink extends Model
{
    protected $table = 'crawl_links';

    const SO_SANH_GIA = 'sosanhgia.com';
    const WEB_SO_SANH = 'websosanh.vn';
    const WEB_DIEN_MAY_XANH = 'dienmayxanh.com';

    protected $fillable = [
        'link',
        'website_name',
        'page_number'
    ];
}
