<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Affiliate contact records</title>
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" >
    </head>
    <body>
        <div class="header">
            <h1>Affiliate contact records</h1>
        </div>
        <div class="content">
            <table class="items">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Distance (from office)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($affiliates as $key => $affiliate)
                        <tr>
                            <td>{{ $affiliate->affiliate_id }}</td>
                            <td>{{ $affiliate->name }}</td>
                            <td>{{ $affiliate->distance }} Km</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">{{ $affiliates->links() }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="footer">
            <p>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
        </div>
    </body>
</html>
