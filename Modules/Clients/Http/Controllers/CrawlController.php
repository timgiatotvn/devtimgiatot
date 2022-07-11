<?php

namespace Modules\Clients\Http\Controllers;

use App\Model\CrawlLink;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admins\Services\CrawlService;

class CrawlController extends Controller
{
    protected $crawlService;

    public function __construct(CrawlService $crawlService)
    {
        $this->crawlService = $crawlService;
    }

    public function crawlData()
    {
        $links = CrawlLink::all();
        foreach ($links as $linkItem) {
            if ($linkItem->website_name == CrawlLink::SO_SANH_GIA) {
                $this->crawlService->crawlSoSanhGiaCom($linkItem);
            } else if ($linkItem->website_name == CrawlLink::WEB_SO_SANH) {
                $this->crawlService->crawlWebSoSanhVn($linkItem);
            }
        }
    }
}