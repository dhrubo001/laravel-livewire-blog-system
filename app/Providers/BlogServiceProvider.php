<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\BlogService;

class BlogServiceProvider extends ServiceProvider
{

    public function register(): void
    {

        $this->app->singleton(BlogService::class, function ($app) {
            return new BlogService();
        });
    }


    public function boot(): void {}
}
