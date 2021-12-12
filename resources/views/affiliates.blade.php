<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Affiliate contact records</title>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>Affiliate contact records</h1>
            </div>
            <table class="table table-hover">
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
            </table>
            <div class="row">
                <div class="col-sm">
                    {{ $affiliates->links() }}
                </div>
            </div>
            <div class="footer">
                <p>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
            </div>
        </div>
    </body>
</html>
