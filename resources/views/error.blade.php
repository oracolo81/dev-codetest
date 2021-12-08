<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Error</title>
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" >
    </head>
    <body class="error">
        <div class="header">
            <h1>Ooops...</h1>
        </div>
        <div class="content text-center">
            <h4>{{ $error }}</h4>
        </div>
        <div class="footer">
            <p>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
        </div>
    </body>
</html>
