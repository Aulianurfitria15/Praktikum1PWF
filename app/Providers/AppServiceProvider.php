<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use App\Policies\CategoryPolicy;
use App\Policies\ProductPolicy;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Dedoc\Scramble\Scramble;
use Illuminate\Routing\Route;
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
        Scramble::configure()
            ->routes(function (Route $route) {
                return Str::startsWith($route->uri, 'api/');
            });
        Gate::define('viewApiDocs', function(){
            return true;
        });
    }
}
