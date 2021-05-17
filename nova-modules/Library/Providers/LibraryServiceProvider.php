<?php

namespace NovaModules\Library\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Nova\Actions\ActionResource;
use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\Facades\Route;
use Laravel\Nova\Resource;
use Symfony\Component\Finder\Finder;
use ReflectionClass;

class LibraryServiceProvider extends ServiceProvider
{
    /**
     * Module Namespace
     *
     * @var string
     */
    protected $namespace = "NovaModules\Library";

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
         $this->app->booted(function () {
            $this->routes();
         });
    }

    /**
     * Register the module's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova'])
                ->prefix('api/library')
                ->group(__DIR__.'/../Routes/api.php');

    }

    /**
     * Bootstrap your assets
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ .'/../Database/migrations');

        Nova::serving(function (ServingNova $event) {
            $this->registerViews();
            Nova::resources($this->resources());
            Nova::cards($this->cards());
            Nova::dashboards($this->dashboards());
            Nova::tools($this->tools());
            Nova::script('library', __DIR__.'/../dist/js/library.js');
            Nova::style('library', __DIR__.'/../dist/css/library.css');
        });
    }

    /**
     * Register Views for your module
     */
    protected function registerViews()
    {
        $sourcePath = __DIR__ . '/../Assets/views';

        $viewPath = resource_path('views/nova-modules/library');

        $this->publishes([
              $sourcePath => $viewPath
            ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
                return $path . '/nova-modules/library';
            }, \Config::get('view.paths')), [$sourcePath]), 'library');

    }

    /**
     * Autoload all resources of your module
     */
    protected function resources()
    {
        $directory = __DIR__ . '/../Resources';
        $namespace = $this->namespace;
        $resources = [];

        foreach ((new Finder)->in($directory)->files() as $resource) {
            $resource = str_replace(
                '.php',
                '',
                $namespace.Str::afterLast($resource, '\\')
            );

            //dd(str_replace(__DIR__, '', $resource));

            if (is_subclass_of($resource, Resource::class) &&
                ! (new ReflectionClass($resource))->isAbstract() &&
                ! (is_subclass_of($resource, ActionResource::class))) {
                $resources[] = $resource;
            }
        }

        return $resources;
    }

    /**
     * Here you can register your cards
     */
    protected function cards()
    {
        return [];
    }

    /**
     * Here you can register your dashboards
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Here you can register your tools connected to module
     */
    protected function tools()
    {
        return [];
    }


}
