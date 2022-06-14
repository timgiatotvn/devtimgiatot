<?php

namespace Modules\Admins\Http\Controllers\Crawlers;

use App\Helpers\Helpers;
use App\Service\Admins\ArticleService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ArticlesController extends Controller
{
    private $service;

    public function __construct(ArticleService $service)
    {
        $this->service = $service;
    }

    /**
     * Crawler websites index
     * @method GET
     */
    public function index()
    {
        try {
            $data['common'] = Helpers::titleAction([__('admins::layer.crawler.article.index.title'), __('admins::layer.crawler.article.index.title2')]);
            $data['list'] = $this->service->getList(['limit' => 20]);
            return view('admins::crawlers.articles.index', ['data' => $data]);
        } catch (\Exception $e) {
            abort('500');
        }
    }
}
