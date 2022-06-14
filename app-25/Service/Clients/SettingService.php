<?php

namespace App\Service\Clients;

use App\Helpers\Helpers;
use App\Repository\Clients\Setting\SettingRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SettingService
{

    private $settingRepository;

    public function __construct(SettingRepositoryInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function findFirst()
    {
        return $this->settingRepository->findFirst();
    }

}
