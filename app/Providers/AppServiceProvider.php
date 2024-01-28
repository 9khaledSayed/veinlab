<?php

namespace App\Providers;

use App\HR\Branch;
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
        Schema::defaultStringLength(191);

        View::composer(['layouts.parts.dashboard.header', 'layouts.parts.hr.header'], function ($view) {
            $currentBranch = Branch::find(setting('current_branch'));
            $branches = Branch::get();

            $view->with(['branches'=> $branches, 'currentBranch' => $currentBranch]);
        });
    }
}
