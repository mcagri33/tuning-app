<?php

namespace App\Providers;

use App\Models\Language;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();

        $language_data = Language::get();
        if(!session()->get('session_short_name')) {
            $current_short_name = Language::where('is_default','Yes')->first()->short_name;
        } else {
            $current_short_name = session()->get('session_short_name');
        }
        $default_lang_data = Language::where('is_default','Yes')->first();

        view()->share('global_cms_language_data',$language_data);
        view()->share('global_cms_short_name',$default_lang_data->short_name);
    }
}
