<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tu Cotizador</title>

    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="antialiased bg-gray-100">

    {{ $slot ?? '' }}

    @livewireScripts
</body>

</html>
