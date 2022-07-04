<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!--<title>{{ nova_get_setting('site_title') ?? config('app.name', 'TripleLMS') }}</title>-->

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
        <!-- Styles -->
        @vite('resources/css/app.css')

        <!-- Scripts -->
        @routes
        @vite('resources/js/app.js')
        @inertiaHead
    </head>
    
    <body class="font-sans antialiased">
        @inertia
    </body>
    
    <script src="https://vuwcourses.h5p.com/js/h5p-resizer.js" charset="UTF-8"></script>
    @if (env('GOOGLE_ANALYTICS_TAG'))
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GOOGLE_ANALYTICS_TAG') }}"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', "{{ env('GOOGLE_ANALYTICS_TAG') }}");
        </script>
    @endif
</html>
