<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $site_logo = nova_get_setting('logo_frontend');

        return array_merge(parent::share($request), [
            // Add site-wide settings
            'settings.title' => nova_get_setting('site_title') ?? config('app.name', 'TripleLMS'),
            'test' => 'hi',

            'settings.logo' => ($site_logo !== null && file_exists(storage_path('app/public/' . $site_logo)))
                ? \Illuminate\Support\Facades\URL::asset( 'storage/' . $site_logo)
                : null,
        ]);
    }
}
