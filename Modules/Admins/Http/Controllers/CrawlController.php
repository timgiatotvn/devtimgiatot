<?php

namespace Modules\Admins\Http\Controllers;

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

    public function list()
    {
        $links = CrawlLink::all();
        $data_pass = [
            'links' => $links,
            'so_sanh_gia' => CrawlLink::SO_SANH_GIA,
            'web_so_sanh' => CrawlLink::WEB_SO_SANH
        ];

        return view('admins::crawls.list', $data_pass);
    }

    public function storeLink(Request $request)
    {
        $link = CrawlLink::updateOrCreate(
            [
                'link' => $request->link,
                'website_name' => $request->website_name
            ],[
                'page_number' => $request->page_number
            ]
        );
        if ($request->website_name == CrawlLink::SO_SANH_GIA) {
            $this->crawlService->crawlSoSanhGiaCom($link);
        } else if ($request->website_name == CrawlLink::WEB_SO_SANH) {
            $this->crawlService->crawlWebSoSanhVn($link);
        }

        return back()->with('success', 'Thêm link và crawl thành công');
    }
}