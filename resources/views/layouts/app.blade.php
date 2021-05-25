<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Merienda:wght@700&display=swap" rel="stylesheet">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @yield('stylesheets')

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-white">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            <header class="bg-white shadow relative">
                <div class="max-w-7xl mx-auto py-4">
                    @livewire('navigation')
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @livewire('footer')

        @stack('modals')

        @livewireScripts
    </body>

</html>
