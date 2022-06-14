<?php

namespace App\Service\Admins;

use App\Helpers\Helpers;
use App\Repository\Admins\Category\CategoryRepositoryInterface;
use App\Repository\Admins\CrawlerWebsite\CrawlerWebsiteRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CrawlerWebsiteService
{
    private $repository;
    const TYPE = ['website'];
    const TYPE_TEXT = ['website' => 'Website crawler'];

    public function __construct(CrawlerWebsiteRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getList($_data = [])
    {
        $_data['keyword'] = request()->has('keyword') ? request()->get('keyword') : '';
        $_data['parent_id'] = !empty(request()->get('parent_id')) ? request()->get('parent_id') : 'null';
        return $this->repository->getList($_data);
    }

    public function findById($_id)
    {
        return $this->repository->findById($_id);
    }

    public function updateStatus($_id, $_status)
    {
        $detail = self::findById($_id);
        return $this->repository->updateStatus($_id, $_status, (($detail->$_status) ? 0 : 1));
    }

    public function destroy($_id)
    {
        return $this->repository->destroy($_id);
    }

    public function create($_data)
    {
        if (isset($_data['_token'])) unset($_data['_token']);
        unset($_data['proengsoft_jsvalidation']);
        $db = array_merge($_data, [
            'admin_id' => Auth::guard(Helpers::renderGuard())->user()->id,
            'created_at' => date("Y/m/d H:i:s"),
            'updated_at' => date("Y/m/d H:i:s")
        ]);

        return $this->repository->create($db);
    }

    public function update($_data, $_id)
    {
        if (isset($_data['_token'])) unset($_data['_token']);
        if (isset($_data['page'])) unset($_data['page']);
        unset($_data['proengsoft_jsvalidation']);
        $db = array_merge($_data, [
            'updated_at' => date("Y/m/d H:i:s")
        ]);
        return $this->repository->update($db, $_id);
    }

}
