<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Status;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
    public function boot()
    {
        if (env('APP_ENV') !== 'local' || env('NGROK_ACTIVE') != false) {
            URL::forceScheme('https');
        }

        Schema::defaultStringLength(191);
        View::composer('*', function ($view) {
            if (session('username')) {
                $username = session('username');

                $provideUserData = $username == 'admin'
                    ? Admin::where('username', $username)->first()
                    : Customer::where('username', $username)->first();

                $buttonColorStatus = Status::buttonColorStatus();
                $buttonTextStatus = Status::buttonTextStatus();

                $getGivenData = [
                    'name' => $provideUserData['name'],
                    'button_color' => $buttonColorStatus,
                    'button_text' => $buttonTextStatus,
                ];

                $view->with('getGivenData', $getGivenData);
            }
        });
    }
}
