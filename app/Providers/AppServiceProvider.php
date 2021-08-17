<?php

namespace App\Providers;

use App\Repositories\ProductRepository;
use App\Repositories\RecentlyViewedProductRepository;
use App\Contracts\ProductRepositoryContract;
use App\Contracts\RecentlyViewedProductRepositoryContract;
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
        $this->app->bind(RecentlyViewedProductRepositoryContract::class, RecentlyViewedProductRepository::class);
        $this->app->bind(ProductRepositoryContract::class, ProductRepository::class);
    }
}
