<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Page logo -->
    <link rel="icon" href="https://cdn.discordapp.com/attachments/1090199171568500760/1091310054222864464/logo_deliverboo_100x250.png" type="image/icon type">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="home-guest">
        <div class="container">
            <header>
                @include('includes.navbar')
            </header>
            <main class="d-flex align-items-end justify-content-center">
                <div class="d-flex flex-column align-items-center justify-content-center text-center">
                    <h1>Diventa un partner DeliveBoo</h1>
                    <a class="nav-link btn-cust" href="{{ route('register') }}">{{ __('Crea Account') }}</a>
                </div>
            </main>
        </div>
    </div>

</body>

</html>