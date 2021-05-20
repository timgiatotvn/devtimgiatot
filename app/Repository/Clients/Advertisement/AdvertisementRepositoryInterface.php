<?php

namespace App\Repository\Clients\Advertisement;

interface AdvertisementRepositoryInterface
{
    public function getListAds($_type);

    public function findByLogo($_type);

    public function getListSlideShow($_type);

}
