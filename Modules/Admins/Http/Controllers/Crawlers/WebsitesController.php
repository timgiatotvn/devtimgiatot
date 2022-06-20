<?php

namespace Modules\Admins\Http\Controllers\Crawlers;

use App\Helpers\Helpers;
use App\Service\Admins\CrawlerWebsiteService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Modules\Admins\Http\Requests\Crawlers\Website\CreateRequest;
use Modules\Admins\Http\Requests\Crawlers\Website\EditRequest;

class WebsitesController extends Controller
{
    private $service;
    private $type;

    public function __construct(CrawlerWebsiteService $service)
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
    public function index()
    {
        try {
            $data['common'] = Helpers::titleAction([__('admins::layer.crawler.index.title'), __('admins::layer.crawler.index.title2')]);
            $data['list'] = $this->service->getList(['limit' => 20, 'type' => $this->type]);
            return view('admins::crawlers.websites.index', ['data' => $data]);
        } catch (\Exception $e) {Helpers::pre($e->getMessage());
            abort('500');
        }
    }

    /**
     * Crawler websites add
     * @method GET
     */
    public function create()
    {
        try {
            $data['common'] = Helpers::titleAction([__('admins::layer.crawler.add.title'), __('admins::layer.crawler.index.title2')]);
            return view('admins::crawlers.websites.create', ['data' => $data]);
        } catch (\Exception $e) {Helpers::pre($e->getMessage());
            abort('500');
        }
    }

    /**
     * Crawler websites store
     * @method POST
     */
    public function store(CreateRequest $request)
    {
        try {
            $_params = $request->all();
            if ($this->service->create($_params)) {
                return redirect(route('admin.crawler.website.index'));
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
    public function show($id)
    {
        return view('admins::show');
    }

    /**
     * Crawler websites edit
     * @method GET
     */
    public function edit($id)
    {
        try {
            $data['common'] = Helpers::titleAction([__('admins::layer.crawler.edit.title'), __('admins::layer.crawler.index.title2')]);
            $data['detail'] = $this->service->findById($id);
            if (empty($data['detail']->id)) return abort(404);
            return view('admins::crawlers.websites.edit', ['data' => $data]);
        } catch (\Exception $e) {
            return !empty($e->getMessage()) ? abort('500') : abort(404);
        }
    }

    /**
     * Crawler websites update
     * @method POST
     */
    public function update(EditRequest $request, $id)
    {
        try {
            $data['detail'] = $this->service->findById($id);
            if (empty($data['detail']->id)) return abort(404);
            $_params = $request->all();
            if ($this->service->update($_params, $id)) {
                session()->flash('success', __('admins::layer.notify.success'));
                return redirect(route('admin.crawler.website.index', ['page' => (!empty($_GET['page']) ? $_GET['page'] : 1)]));
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
    public function status($id, $status)
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
    public function destroy($id)
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
}
