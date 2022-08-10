<?php

namespace Modules\Admins\Http\Controllers;

use App\Helpers\Helpers;
use App\Model\Admin;
use App\Model\Category;
use App\Model\Notification;
use App\Model\Post;
use App\Service\Admins\CategoryService;
use App\Service\Admins\PostService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Modules\Admins\Http\Requests\Post\CreateRequest;
use Modules\Admins\Http\Requests\Post\EditRequest;

class PostsController extends Controller
{

    private $categoryService;
    private $postService;
    private $type;

    public function __construct(CategoryService $categoryService, PostService $postService)
    {
        $this->categoryService = $categoryService;
        $this->postService = $postService;
        $this->type = [$categoryService::TYPE[0]];
    }

    /**
     * Category index
     * @method GET
     */
    public function index()
    {
//        try {
            $data['common'] = Helpers::titleAction([__('admins::layer.post.index.title'), __('admins::layer.post.index.title2')]);
            $data['list'] = $this->postService->getList(['limit' => 10]);
            $data['category'] = $this->categoryService->getListMenu(['type' => $this->type, 'parent_id' => [(request()->has('category_id') ? request()->get('category_id') : '')]]);
            $data['admins'] = Admin::all();
            $data['total_post_active'] = Post::where('admin_id', auth('admins')->user()->id)
                                     ->where('status', 1)
                                     ->count();
            return view('admins::posts.index', ['data' => $data]);
//        } catch (\Exception $e) {
//            abort('500');
//        }
    }

    /**
     * Category add
     * @method GET
     */
    public function create()
    {
        try {
            $data['common'] = Helpers::titleAction([__('admins::layer.post.add.title'), __('admins::layer.post.index.title2')]);
            $data['category'] = $this->categoryService->getListMenu(['type' => $this->type, 'multi' => true]);
            return view('admins::posts.create', ['data' => $data]);
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
            $_params['admin_id'] = Auth::guard(Helpers::renderGuard())->user()->id;
            $_params['category_multi'] = !empty($request->get('category_multi')) ? '|' . implode('|', $request->get('category_multi')) . '|' : '';

            if ($_params) {
                $categoryPromotion = Category::where('title', 'LIKE', "Tin khuyến mãi")
                    ->where('type', 'new')
                    ->where('status', 1)->select('id', 'title', 'type')->first();
                if ($categoryPromotion) {
                    $_params['type'] = $categoryPromotion->type;
                }
                $post = new Post();
                $post->fill($_params);
                $post->save();
//                if (!empty($categoryPromotion) && $categoryPromotion->id == $_params['category_id']) {
//                    Notification::sendNotification($post, $type = 'post');
//                }

                return redirect(route('admin.post.index'));
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
            $data['common'] = Helpers::titleAction([__('admins::layer.post.edit.title'), __('admins::layer.post.index.title2')]);
            $data['detail'] = $this->postService->findById($id);
            if (empty($data['detail']->id)) return abort(404);
            /**
             * admin_id = -1 thì là tin crawl, nếu vẫn là = -1 thì người đầu tiền click vào là tin của ng đó
             */
            if ($data['detail']->admin_id == -1) {
                Post::whereId($id)->update([
                    'admin_id' => auth('admins')->user()->id
                ]);
            }
            $data['category'] = $this->categoryService->getListMenu(['type' => $this->type, 'parent_id' => [$data['detail']->category_id], 'multi' => true]);
            return view('admins::posts.edit', ['data' => $data]);
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
            $data['detail'] = $this->postService->findById($id);
            if (empty($data['detail']->id)) return abort(404);
            $_params = $request->all();

            if ($data['detail']->date_edit == '') {
                $_params['date_edit'] = date('Y-m-d');
            }            
            $categoryPromotion = Category::where('status', 'LIKE', 1)
                ->where('id', $_params['category_id'])
                ->where('status', 1)->select('id', 'title', 'type')->first();

            if ($categoryPromotion) {
                $_params['type'] = $categoryPromotion->type;
            }
            if ($this->postService->update($_params, $id)) {
                session()->flash('success', __('admins::layer.notify.success'));
                return redirect(route('admin.post.index', ['page' => !empty($_GET['page']) ? $_GET['page'] : 1]));
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
            if ($this->postService->updateStatus($id, $status)) {
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
                    $flag = $this->postService->destroyAll($data);
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
            if ($this->postService->destroy($id)) {
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
