<?php

namespace App\Service\Admins;

use App\Helpers\Helpers;
use App\Repository\Admins\Setting\SettingRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SettingService
{

    private $settingRepository;

    public function __construct(SettingRepositoryInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }


    public function findById($_id)
    {
        return $this->settingRepository->findById($_id);
    }


    public function update($_data, $_id)
    {
        if (isset($_data['_token'])) unset($_data['_token']);
        if (isset($_data['page'])) unset($_data['page']);
        unset($_data['proengsoft_jsvalidation']);
        $db = array_merge($_data, [
            'updated_at' => date("Y/m/d H:i:s")
        ]);
        return $this->settingRepository->update($db, $_id);
    }

}
