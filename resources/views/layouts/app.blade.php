<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description"
            content="The official website of the Dalubhasaan ng Lungsod ng Lucena's College Research and Development Services office.">

        <title>{{ $title ?? config('app.name', 'DLL-CRDS') }}</title>

        <!-- Favicons -->
        <link type="image/x-icon" href="{{ asset('favicon.ico') }}" rel="icon">
        <link type="image/png" href="{{ asset('images/favicon-16x16.png') }}" rel="icon" sizes="16x16">
        <link type="image/png" href="{{ asset('images/favicon-32x32.png') }}" rel="icon" sizes="32x32">
        <link type="image/png" href="{{ asset('images/favicon-180x180.png') }}" rel="icon" sizes="180x180">
        <link type="image/png" href="{{ asset('images/favicon-192x192.png') }}" rel="icon" sizes="192x192">
        <link type="image/png" href="{{ asset('images/favicon-512x512.png') }}" rel="icon" sizes="512x512">

        <!-- Fonts -->
        <link href="https://fonts.bunny.net" rel="preconnect">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>

    <body class="font-sans antialiased">

        <livewire:components.navigation-menu />

        <!-- Page Content -->
        <main class="min-h-screen bg-gray-100 text-gray-900">
            {{ $slot }}
        </main>

        <livewire:components.footer />

        @stack('modals')

        @livewireScripts
    </body>

</html>
