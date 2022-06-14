<?php

namespace App\Service\Admins;

use App\Helpers\Helpers;
use App\Repository\Admins\Account\AccountRepositoryInterface;
use App\Repository\Admins\Advertisement\AdvertisementRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdvertisementService
{
    private $advertisementRepository;
    const TYPE = ['adv', 'logo', 'slideshow', 'link'];

    public function __construct(AdvertisementRepositoryInterface $advertisementRepository)
    {
        $this->advertisementRepository = $advertisementRepository;
    }

    public function getList($_data = [])
    {
        $_data['keyword'] = request()->has('keyword') ? request()->get('keyword') : '';
        return $this->advertisementRepository->getList($_data);
    }

    public function findById($_id)
    {
        return $this->advertisementRepository->findById($_id);
    }

    public function updateStatus($_id, $_status)
    {
        return $this->advertisementRepository->updateStatus($_id, $_status);
    }

    public function destroy($_id)
    {
        return $this->advertisementRepository->destroy($_id);
    }

    public function create($_data)
    {
        if (isset($_data['_token'])) unset($_data['_token']);
        unset($_data['proengsoft_jsvalidation']);
        $db = array_merge($_data, [
            'admin_id' => Auth::guard(Helpers::renderGuard())->user()->id,
            'type' => $_data['type'],
            'created_at' => date("Y/m/d H:i:s"),
            'updated_at' => date("Y/m/d H:i:s")
        ]);
        return $this->advertisementRepository->create($db);
    }

    public function update($_data, $_id)
    {
        if (isset($_data['_token'])) unset($_data['_token']);
        if (isset($_data['page'])) unset($_data['page']);
        unset($_data['proengsoft_jsvalidation']);
        $db = array_merge($_data, [
            'updated_at' => date("Y/m/d H:i:s")
        ]);
        return $this->advertisementRepository->update($db, $_id);
    }

}
