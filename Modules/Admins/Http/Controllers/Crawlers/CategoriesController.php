<?php

namespace Modules\Admins\Http\Controllers\Crawlers;

use App\Helpers\Helpers;
use App\Jobs\jobCrawlerCategories;
use App\Service\Admins\CrawlerCategoryService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Modules\Admins\Http\Requests\Crawlers\Category\CreateRequest;
use Modules\Admins\Http\Requests\Crawlers\Category\EditRequest;

class CategoriesController extends Controller
{
    private $service;
    private $type;

    public function __construct(CrawlerCategoryService $service)
    {
        $this->service = $service;
        $this->type = $this->service::TYPE;

        View::share('type_cate', $this->type);
        View::share('type_text', $this->service::TYPE_TEXT);
        $tmp = !empty($_GET["template"]) ? $_GET["template"] : "";
        View::share('templateCrawler', $this->templateCrawler($tmp));
    }

    /**
     * Crawler websites index
     * @method GET
     */
    public function index($crawler_website_id)
    {
        try {
            $data['common'] = Helpers::titleAction([__('admins::layer.crawler.index.title'), __('admins::layer.crawler.index.title2')]);
            $data['list'] = $this->service->getList(['limit' => 20, 'type' => $this->type, 'crawler_website_id' => $crawler_website_id]);
            return view('admins::crawlers.categories.index', ['data' => $data]);
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Crawler websites add
     * @method GET
     */
    public function create($crawler_website_id)
    {
        try {
            $data['common'] = Helpers::titleAction([__('admins::layer.crawler.add.title'), __('admins::layer.crawler.index.title2')]);
            return view('admins::crawlers.categories.create', ['data' => $data]);
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Crawler websites store
     * @method POST
     */
    public function store(CreateRequest $request, $crawler_website_id)
    {
        try {
            $_params = $request->all();
            $_params['crawler_website_id'] = $crawler_website_id;
            if ($this->service->create($_params)) {
                return redirect(route('admin.crawler.category.index', ['crawler_website_id' => $crawler_website_id]));
            } else {
                $errors = new MessageBag(['error' => __('admins::layer.notify.fail')]);
                return back()->withInput($_params)->withErrors($errors);
            }
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($crawler_website_id, $id)
    {
        return view('admins::show');
    }

    /**
     * Crawler websites edit
     * @method GET
     */
    public function edit($crawler_website_id, $id)
    {
        try {
            $data['common'] = Helpers::titleAction([__('admins::layer.crawler.edit.title'), __('admins::layer.crawler.index.title2')]);
            $data['detail'] = $this->service->findById($id);
            if (empty($data['detail']->id)) return abort(404);
            return view('admins::crawlers.categories.edit', ['data' => $data]);
        } catch (\Exception $e) {
            return !empty($e->getMessage()) ? abort('500') : abort(404);
        }
    }

    /**
     * Crawler websites update
     * @method POST
     */
    public function update(EditRequest $request, $crawler_website_id, $id)
    {
        try {
            $data['detail'] = $this->service->findById($id);
            if (empty($data['detail']->id)) return abort(404);
            $_params = $request->all();
            if ($this->service->update($_params, $id)) {
                session()->flash('success', __('admins::layer.notify.success'));
                return redirect(route('admin.crawler.category.index', ['crawler_website_id' => $crawler_website_id, 'page' => (!empty($_GET['page']) ? $_GET['page'] : 1)]));
            } else {
                $errors = new MessageBag(['error' => __('admins::layer.notify.fail')]);
                return back()->withInput($_params)->withErrors($errors);
            }
        } catch (\Exception $e) {Helpers::pre($e->getMessage());
            return !empty($e->getMessage()) ? abort('500') : abort(404);
        }
    }

    /**
     * Crawler websites status
     * @method GET
     */
    public function status($crawler_website_id, $id, $status)
    {
        try {
            if ($this->service->updateStatus($id, $status)) {
                session()->flash('success', __('admins::layer.notify.success'));
            } else {
                session()->flash('error', __('admins::layer.notify.fail'));
            }
            return back();
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($crawler_website_id, $id)
    {
        try {
            return back();
            if ($this->service->destroy($id)) {
                session()->flash('success', __('admins::layer.notify.success'));
            } else {
                session()->flash('error', __('admins::layer.notify.fail'));
            }
            return back();
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function crawlerSetup($crawler_website_id, $id)
    {
        try {
            $detail = $this->service->findById($id);
            if (empty($detail->id)) return abort(404);
            Helpers::queueWriteJson($id, "all");
            //jobCrawlerCategories::dispatch($detail)->delay(now()->addSeconds(2));
            return back();
        } catch (\Exception $e) {
            abort('500');
        }
    }

    public function templateCrawler($site = "")
    {
        $data = [
            "tiki" => [
                "domain_url" => "https://tiki.vn",
                "class_root_list" => "a.product-item",
                "class_parent" => "a.product-item",
                "class_url_image" => "picture.webpimg-container",
                "class_url_image_attr" => "src",
                "class_url_a" => "a.product-item",
                "class_detail" => "main .Container-sc-itwfbd-0.hfMLFx",
                "class_detail_name" => "h1.title",
                "class_detail_price" => ".product-price__current-price",
                "class_detail_price_root" => ".product-price__list-price",
                "class_detail_price_sale" => ".flash-sale-price span",
                "class_detail_price_sale_root" => ".flash-sale-price .sale .list-price",
                "class_detail_description" => ".style__Wrapper-sc-12gwspu-0 .content.has-table",
                "class_detail_content" => ".style__Wrapper-sc-12gwspu-0 .ToggleContent__Wrapper-sc-1dbmfaw-1",
                "type_crawler" => "ajax",
            ],
            "lazada" => [
                "domain_url" => "https://www.lazada.vn",
                "class_root_list" => ".Bm3ON",
                "class_parent" => ".Bm3ON",
                "class_url_image" => "._95X4G .picture-wrapper",
                "class_url_image_attr" => "src",
                "class_url_a" => "._95X4G a",
                "scroll_class" => ".desktop-footer",
                "class_detail" => "#root",
                "class_detail_name" => "h1.pdp-mod-product-badge-title",
                "class_detail_price" => ".pdp-price.pdp-price_type_normal.pdp-price_color_orange",
                "class_detail_price_root" => ".pdp-price.pdp-price_type_deleted.pdp-price_color_lightgray",
                "class_detail_price_sale" => "",
                "class_detail_price_sale_root" => "",
                "class_detail_description" => "h1.pdp-mod-product-badge-title",
                "class_detail_content" => ".html-content.detail-content",
                "type_crawler" => "ajax",
            ],
            "dienmayxanh" => [
                "domain_url" => "https://www.dienmayxanh.com",
                "class_root_list" => ".listproduct .item",
                "class_parent" => ".listproduct .item",
                "class_url_image" => ".main-contain .item-img",
                "class_url_image_attr" => "src",
                "class_url_a" => "a.main-contain",
                "scroll_class" => "",
                "class_detail" => "section.detail",
                "class_detail_name" => "h1",
                "class_detail_price" => ".box-price-present",
                "class_detail_price_root" => ".box-price-old",
                "class_detail_price_sale" => "",
                "class_detail_price_sale_root" => "",
                "class_detail_description" => ".short-article",
                "class_detail_content" => ".content-article",
                "type_crawler" => "ajax",
            ],
        ];

        return !empty($data[$site]) ? $data[$site] : [];
    }
}
