<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS específicos -->
    <link href="{{ asset('css/indexFitness.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboardUser.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dietaUser.css') }}" rel="stylesheet">
    <link href="{{ asset('css/rutinaUser.css') }}" rel="stylesheet">
    <link href="{{ asset('css/progresoUser.css') }}" rel="stylesheet">
    <link href="{{ asset('css/graficasUser.css') }}" rel="stylesheet">
    <link href="{{ asset('css/formMedidas.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts (Chart.js ya incluido en app.js) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.usuario.navigationUser')

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main class="">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>

</html>