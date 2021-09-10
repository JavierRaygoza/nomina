<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Nómina</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body class="bg-white">
        <div id="app">
            <example-component></example-component>
        </div>
    </body>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</html>