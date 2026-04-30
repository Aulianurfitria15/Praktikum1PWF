<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use App\Policies\CategoryPolicy;
use App\Policies\ProductPolicy;
use App\Models\Kategori;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('manage-product', function (User $user) {
            return $user->role === 'admin';
        });
        Gate::policy(Kategori::class, CategoryPolicy::class);
        Gate::policy(Product::class, ProductPolicy::class);
    }
}
