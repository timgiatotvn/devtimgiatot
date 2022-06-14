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
        } catch (\Exception $e) {Helpers::pre($e->getMessage());
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
        } catch (\Exception $e) {
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
            jobCrawlerCategories::dispatch($detail)->delay(now()->addSeconds(2));
            return back();
        } catch (\Exception $e) {
            abort('500');
        }
    }
}
