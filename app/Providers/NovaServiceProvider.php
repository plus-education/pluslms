<?php

namespace App\Providers;

use App\Models\Roles;
use Illuminate\Support\Facades\Gate;
use Joedixon\NovaTranslation\NovaTranslation;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Lms\Gradebook\Gradebook;
use Lms\MyCourses\MyCourses;
use Lms\StudentGradebook\StudentGradebook;
use Vyuldashev\NovaPermission\PermissionPolicy;
use Vyuldashev\NovaPermission\RolePolicy;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();



        \OptimistDigital\NovaSettings\NovaSettings::addSettingsFields([
            Image::make('Logo', 'logo'),
            Image::make('Logo Frontend', 'logo_frontend'),
        ]);
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return !$user->hasRole(Roles::STUDENT);
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            MyCourses::make(),



            new \Infinety\Filemanager\FilemanagerTool(),

            \Spatie\BackupTool\BackupTool::make()
                ->canSee(function (){
                    return auth()->user()->can('manage backup');
                }),

            \Vyuldashev\NovaPermission\NovaPermissionTool::make()
                ->rolePolicy(RolePolicy::class)
                ->permissionPolicy(PermissionPolicy::class)
                ->canSee(function (){
                    return auth()->user()->can('manage roles');
                }),
            //\ChrisWare\NovaBreadcrumbs\NovaBreadcrumbs::make(),

            NovaTranslation::make()
                ->canSee(function (){
                    return auth()->user()->can('manage translations');
                }),

            \OptimistDigital\NovaSettings\NovaSettings::make(),

            \Mirovit\NovaNotifications\NovaNotifications::make(),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
