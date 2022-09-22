<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta property="og:site_name" content="Mystery Fun House" />
        <meta property="og:title" content="{{ $title ?? 'Mystery Fun House' }}" />
        <meta property="og:description" content="{{ $description ?? 'Mystery Fun House is a blind racing community, playing games against each other that we\'ve never played before! Join us to see how well you do when it comes to sightreading challenging and weird games!' }}" />
        <meta property="og:image" content="{{ $image ?? asset('/img/home.jpg') }}" />

        <link rel="icon" type="image/png" href="/img/favicon.png">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body>
        @inertia
    </body>
</html>
