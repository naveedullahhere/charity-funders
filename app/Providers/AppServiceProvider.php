<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\{Company,Funder};
use App\Models\User;
use App\Observers\{FunderObserver,UserObserver,CompanyObserver};
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrapFive();
        Company::observe(CompanyObserver::class);
        User::observe(UserObserver::class);
        Funder::observe(FunderObserver::class);

    }
}
