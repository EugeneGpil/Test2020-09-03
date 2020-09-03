<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Json Documents</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}" id="maincss">
    </head>
    <body>
        <div id="app">
            <router-view />
        </div>
        
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
