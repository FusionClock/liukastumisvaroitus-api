<?php

namespace App\Providers;

use App\Repositories\Interfaces\WarningRepositoryInterface;
use App\Repositories\LabyrinttiWarningRepository;
use Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(WarningRepositoryInterface::class, function () {
            return new LabyrinttiWarningRepository(
                Config::get('imap.server'),
                Config::get('imap.port'),
                Config::get('imap.user'),
                Config::get('imap.password')
            );
        });
    }
}
