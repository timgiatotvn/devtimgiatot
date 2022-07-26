<?php

namespace App\Service\Admins;

use App\Helpers\Helpers;
use App\Repository\Admins\Post\PostRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostService
{
    private $categoryService;
    private $postRepository;
    const TYPE = ['new'];

    public function __construct(CategoryService $categoryService, PostRepositoryInterface $postRepository)
    {
        $this->categoryService = $categoryService;
        $this->postRepository = $postRepository;
    }

    public function getList($_data = [])
    {
        $_data['keyword'] = request()->has('keyword') ? request()->get('keyword') : '';
        $_data['col_order'] = request()->has('col_order') ? request()->get('col_order') : 'id';
        $_data['type_order'] = request()->has('type_order') ? request()->get('type_order') : 'DESC';
        $_data['category_id'] = request()->has('category_id') ? $this->categoryService->multiCate(request()->get('category_id')) : '';
        $_data['type'] = request()->has('type') ? request()->get('type') : 'all';
        $_data['admin_id'] = request()->has('admin_id') ? request()->get('admin_id') : 'all';
        $_data['status'] = request()->has('status') ? request()->get('status') : 'all';
        $_data['month'] = request()->has('month') ? request()->get('month') : 'all';
        $_data['year'] = request()->has('year') ? request()->get('year') : 'all';
        return $this->postRepository->getList($_data);
    }

    public function findById($_id)
    {
        return $this->postRepository->findById($_id);
    }

    public function updateStatus($_id, $_status)
    {
        $detail = self::findById($_id);
        return $this->postRepository->updateStatus($_id, $_status, (($detail->$_status) ? 0 : 1));
    }

    public function destroyAll($_data)
    {
        return $this->postRepository->destroyAll($_data);
    }

    public function destroy($_id)
    {
        return $this->postRepository->destroy($_id);
    }

    public function create($_data)
    {
        if (isset($_data['_token'])) unset($_data['_token']);
        unset($_data['proengsoft_jsvalidation']);
        $db = array_merge($_data, [
            //'description' => !empty($_data['description']) ? substr(strip_tags($_data['description']), 0, 1000) : '',
            'description' => !empty($_data['description']) ? $_data['description'] : '',
            'slug' => !empty($_data['slug']) ? $_data['slug'] : (!empty($_data['title']) ? Str::slug($_data['title'], '-') : ''),
            'admin_id' => Auth::guard(Helpers::renderGuard())->user()->id,
            'category_multi' => !empty($_data['category_multi']) ? '|' . implode('|', $_data['category_multi']) . '|' : '',
            'type' => $this::TYPE[0],
            'choose_1' => 0,
            'choose_2' => 0,
            'choose_3' => 0,
            'choose_4' => 0,
            'created_at' => date("Y/m/d H:i:s"),
            'updated_at' => date("Y/m/d H:i:s")
        ]);

        return $this->postRepository->create($db);
    }

    public function update($_data, $_id)
    {
        if (isset($_data['_token'])) unset($_data['_token']);
        if (isset($_data['page'])) unset($_data['page']);
        unset($_data['proengsoft_jsvalidation']);

        $db = array_merge($_data, [
            //'description' => !empty($_data['description']) ? substr(strip_tags($_data['description']), 0, 1000) : '',
            'description' => !empty($_data['description']) ? $_data['description'] : '',
            //'slug' => !empty($_data['title']) ? Str::slug($_data['title'], '-') : '',
            'category_multi' => !empty($_data['category_multi']) ? '|' . implode('|', $_data['category_multi']) . '|' : '',
            'updated_at' => date("Y/m/d H:i:s"),
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return $this->postRepository->update($db, $_id);
    }

}
