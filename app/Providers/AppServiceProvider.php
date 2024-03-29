<?php

namespace App\Providers;

use App\Models\Lang;
use App\Models\Logo;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('*', function ($view) {
            $langsForHeader = Lang::where('is_published', true)->get();
            $currenctLang = Lang::where('code', session('locale'))->first();
            $logo = Logo::first();

            $view->with([
                'langsForHeader' => $langsForHeader,
                'currenctLang' => $currenctLang,
                'logo' => $logo,
            ]);
        });
    }
}
