<?php

namespace App\Providers;

use App\Model\Category;
use App\Model\EmailSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Repository $setConfig)
    {
        if(in_array(env('ENVIROMENT'), ['production'])) {
            \URL::forceScheme('https');
        }
        try {
            \Carbon\Carbon::setLocale(config('app.locale'));
            $setting = EmailSetting::first();

            if ($setting) {
                $setConfig->set('mail.driver', $setting->driver);
                $setConfig->set('mail.host', $setting->host);
                $setConfig->set('mail.port', $setting->port);
                $setConfig->set('mail.from.address', $setting->from_email);
                $setConfig->set('mail.from.name', $setting->from_name);
                $setConfig->set('mail.encryption', $setting->encryption);
                $setConfig->set('mail.username', $setting->username);
                $setConfig->set('mail.password', $setting->password);
            }
            $cate_tim_gia_tot = Category::where('slug', 'tim-gia-tot')->first();
            $category_products = Category::where('parent_id', $cate_tim_gia_tot->id)
                                                 ->where('type', 'product')
                                                 ->with(['category' => function ($query) {
                                                    $query->with('category');
                                                 }])
                                                 ->get();
            View::share('data_share', [
                'category_products' => $category_products]);
        } catch(\Exception $e) {
        }
    }
}
