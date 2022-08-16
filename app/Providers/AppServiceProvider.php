<?php

namespace App\Providers;

use App\Model\EmailSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Config\Repository;

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
        } catch(\Exception $e) {
        }
    }
}
