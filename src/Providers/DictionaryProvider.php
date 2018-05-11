<?php

namespace Phpno1\Dictionaries\Providers;

use Illuminate\Support\ServiceProvider;

class DictionaryProvider extends ServiceProvider
{
    /**
     * Dictionary any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../Config/dictionaries.php' => config_path('dictionaries.php')
        ]);

        $this->mergeConfigFrom(__DIR__ . '/../Config/dictionaries.php', 'dictionaries');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
