<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body>
        <div id="app">
            <index></index>
        </div>
    </body>
</html>
