<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mefolio') }}</title>

    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">


    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="text-gray-900 font-syne">
    <div class="h-screen flex flex-col sm:justify-center items-center">

        <div class="w-full bg-white overflow-hidden sm:rounded-xs">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
