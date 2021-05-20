<?php

namespace App\Service\Clients;

use App\Helpers\Helpers;
use App\Repository\Clients\Advertisement\AdvertisementRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdvertisementService
{

    private $advRepository;
    const TYPE = ['adv', 'logo', 'slideshow'];

    public function __construct(AdvertisementRepositoryInterface $advRepository)
    {
        $this->advRepository = $advRepository;
    }

    public function getListAds()
    {
        return $this->advRepository->getListAds(self::TYPE[0]);
    }

    public function findByLogo()
    {
        return $this->advRepository->findByLogo(self::TYPE[1]);
    }

    public function getListSlideShow()
    {
        return $this->advRepository->getListSlideShow(self::TYPE[2]);
    }

}
