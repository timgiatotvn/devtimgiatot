<?php

namespace App\Providers;

use App\Model\Category;
use App\Model\CategoryWp;
use App\Model\EmailSetting;
use App\Model\Widget;
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
            \Carbon\Carbon::setLocale('vi');
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
            $cate_kien_thuc = Category::where('parent_id', 3)->get();
            $category_products = Category::where('parent_id', $cate_tim_gia_tot->id)
                                                 ->where('type', 'product')
                                                 ->with(['category' => function ($query) {
                                                    $query->with('category');
                                                 }])
                                                 ->oldest('sort')
                                                 ->get();
            View::share('data_share', [
                'category_products' => $category_products,
                'cate_kien_thuc' => $cate_kien_thuc,
                'widget_footer' => Widget::where("name", "footer")->first(),
                'categories' => CategoryWp::oldest("position")->get()
            ]);
        } catch(\Exception $e) {
        }
    }
}
