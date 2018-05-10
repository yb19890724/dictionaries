<?php

namespace Phpno1\Dictionaries\Providers;

use Illuminate\Support\ServiceProvider;

class DictionaryProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../Config/dictionaries.php' => config_path('dictionary.php')
        ]);

        $this->mergeConfigFrom(__DIR__ . '/../Config/dictionaries.php', 'dictionary');
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
