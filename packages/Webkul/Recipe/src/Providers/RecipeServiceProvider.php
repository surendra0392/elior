<?php

namespace Webkul\Recipe\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class RecipeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/admin-routes.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/shop-routes.php');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'recipe');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'recipe');

        Event::listen('bagisto.admin.layout.head', function($viewRenderEventManager) {
            // Include admin assets if needed
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
    }

    /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/admin-menu.php', 'menu.admin'
        );

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/acl.php', 'acl'
        );
    }
}
