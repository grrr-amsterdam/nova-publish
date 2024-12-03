<?php

namespace Publish;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Http\Middleware\Authenticate;
use Laravel\Nova\Nova;
use Publish\Http\Middleware\Authorize;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadJsonTranslationsFrom(__DIR__ . "/../resources/lang");

        $this->app->booted(function () {
            $this->routes();
        });

        $this->publishes([
            __DIR__ . "/../config/publish.php" => config_path("publish.php"),
        ]);

        Nova::serving(function (ServingNova $event) {
            $currentLocale = app()->getLocale();
            // Use the current locale to load the appropriate translations
            Nova::translations(
                __DIR__ . "/../resources/lang/{$currentLocale}.json"
            );

            Nova::provideToScript([
                "currentLocale" => $currentLocale,
            ]);
        });
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Nova::router(
            ["nova", Authenticate::class, Authorize::class],
            "publish"
        )->group(__DIR__ . "/../routes/inertia.php");

        Route::middleware(["nova"])
            ->prefix("nova-vendor/publish")
            ->group(__DIR__ . "/../routes/api.php");
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PublishManager::class, PublishManager::class);
    }
}
