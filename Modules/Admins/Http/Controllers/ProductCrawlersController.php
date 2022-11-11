<?php

namespace Modules\Admins\Http\Controllers;

use App\Helpers\Helpers;
use App\Service\Admins\CategoryService;
use App\Service\Admins\ProductService;
use App\Service\Clients\ClientArticleService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\MessageBag;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Admins\Http\Requests\ProductCrawler\CreateRequest;
use Modules\Admins\Http\Requests\ProductCrawler\EditRequest;

class ProductCrawlersController extends Controller
{

    private $categoryService;
    private $productService;
    private $type;
    private $type_product;
    private $clientArticleService;

    public function __construct(CategoryService $categoryService, ProductService $productService, ClientArticleService $clientArticleService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
        $this->type = [$this->categoryService::TYPE[1]];
        $this->type_product = $this->categoryService::TYPE2[3];
        $this->clientArticleService = $clientArticleService;
    }

    /**
     * Category index
     * @method GET
     */
    public function index()
    {
        try {
            $data['common'] = Helpers::titleAction([__('admins::layer.product.index.title'), __('admins::layer.product.index.title2')]);
            $data['list'] = $this->productService->getList(['limit' => 10, 'type' => $this->type_product]);
            $data['category'] = $this->categoryService->getListMenu(['type' => $this->type, 'parent_id' => [(request()->has('category_id') ? request()->get('category_id') : '')]]);
            return view('admins::productCrawlers.index', ['data' => $data]);
        } catch (\Exception $e) {
            abort('500');
        }
    }

    public function indexCR()
    {
        if (\request()->has('file_exels')) {
            $updateFile = \request()->file('file_exels');
            $fileExtension = $updateFile->getClientOriginalExtension();
            if ($fileExtension == "xlsx") {
                $excelData = Excel::toArray([], $updateFile);

                if (!empty($excelData[0])) {
                    unset($excelData[0][0]);
                    foreach ($excelData[0] as $row) {
                        if (!empty($row[0])) {
                            $data = [
                                "title" => $row[0],
                                "keyword_suggest" => $row[1],
                                "category_id" => $row[2],
                                "type" => "crawler"
                            ];
                            $this->productService->create($data);
                        }
                    }
                }
            }
        }
        return redirect(route('admin.productCrawler.index'));
    }

    /**
     * Category add
     * @method GET
     */
    public function create()
    {
        try {
            $data['common'] = Helpers::titleAction([__('admins::layer.product.add.title'), __('admins::layer.product.index.title2')]);
            $data['category'] = $this->categoryService->getListMenu(['type' => $this->type, 'multi' => true]);
            return view('admins::productCrawlers.create', ['data' => $data]);
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Category store
     * @method POST
     */
    public function store(CreateRequest $request)
    {
        try {
            $_params = $request->all();
            $_params["type"] = "crawler";
            if ($this->productService->create($_params)) {
                return redirect(route('admin.productCrawler.index'));
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
     * Category edit
     * @method GET
     */
    public function edit($id)
    {
        try {
            $data['common'] = Helpers::titleAction([__('admins::layer.product.edit.title'), __('admins::layer.product.index.title2')]);
            $data['detail'] = $this->productService->findById($id);
            if (empty($data['detail']->id)) return abort(404);
            $data['category'] = $this->categoryService->getListMenu(['type' => $this->type, 'parent_id' => [$data['detail']->category_id], 'multi' => true]);
            $data['sosanh'] = $this->clientArticleService->getList(['list_id' => explode('|', $data['detail']->keyword_suggest_map_crawler), 'limit' => 15]);

            return view('admins::productCrawlers.edit', ['data' => $data]);
        } catch (\Exception $e) {
            return !empty($e->getMessage()) ? abort('500') : abort(404);
        }
    }

    /**
     * Category update
     * @method POST
     */
    public function update(EditRequest $request, $id)
    {
        try {
            $data['detail'] = $this->productService->findById($id);
            if (empty($data['detail']->id)) return abort(404);
            $_params = $request->all();
            if ($this->productService->update($_params, $id)) {
                session()->flash('success', __('admins::layer.notify.success'));
                return redirect(route('admin.productCrawler.index', ['page' => !empty($_GET['page']) ? $_GET['page'] : 1]));
            } else {
                $errors = new MessageBag(['error' => __('admins::layer.notify.fail')]);
                return back()->withInput($_params)->withErrors($errors);
            }
        } catch (\Exception $e) {
            return !empty($e->getMessage()) ? abort('500') : abort(404);
        }
    }

    /**
     * Category status
     * @method GET
     */
    public function status($id, $status)
    {
        try {
            if ($this->productService->updateStatus($id, $status)) {
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
    public function actionIndex()
    {
        try {
            $data = \request()->all();
            if (empty($data['check']) || empty($data['action'])) {
                session()->flash('error', __('admins::layer.notify.fail'));
            } else {
                $flag = true;
                if ($data['action'] == 1) {
                    $flag = $this->productService->destroyAll($data);
                }

                if ($flag) {
                    session()->flash('success', __('admins::layer.notify.success'));
                } else {
                    session()->flash('error', __('admins::layer.notify.fail'));
                }
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
            if ($this->productService->destroy($id)) {
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
