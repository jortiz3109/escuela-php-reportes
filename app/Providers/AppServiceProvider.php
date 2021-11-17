<?php

namespace App\Providers;

use App\Exports\Extended\Writer;
use Illuminate\Support\ServiceProvider;
use Maatwebsite\Excel\Files\TemporaryFileFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\Maatwebsite\Excel\Writer::class, function ($app) {
            return new Writer($app->make(TemporaryFileFactory::class));
        });
    }
}
