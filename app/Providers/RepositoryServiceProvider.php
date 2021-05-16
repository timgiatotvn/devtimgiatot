<?php

namespace App\Providers;

use App\Repository\Admins\Account\AccountRepository;
use App\Repository\Admins\Account\AccountRepositoryInterface;
use App\Repository\Admins\Advertisement\AdvertisementRepository;
use App\Repository\Admins\Advertisement\AdvertisementRepositoryInterface;
use App\Repository\Admins\Category\CategoryRepository;
use App\Repository\Admins\Category\CategoryRepositoryInterface;
use App\Repository\Admins\Product\ProductRepository;
use App\Repository\Admins\Product\ProductRepositoryInterface;
use App\Repository\IA\IA\IARepository;
use App\Repository\IA\IA\IARepositoryInterface;
use App\Repository\Admins\Post\PostRepository;
use App\Repository\Admins\Post\PostRepositoryInterface;
use App\Repository\Admins\Setting\SettingRepository;
use App\Repository\Admins\Setting\SettingRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
        $this->app->bind(AccountRepositoryInterface::class, AccountRepository::class);
        $this->app->bind(AdvertisementRepositoryInterface::class, AdvertisementRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);

        //IA
        $this->app->bind(IARepositoryInterface::class, IARepository::class);
    }
}