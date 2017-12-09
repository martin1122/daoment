<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    <title>Daoment - The Next Step In Crypto Index</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="robots" content="noindex,nofollow" />
    <meta name="description" content="The Daoment Cryptocurrency Index" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <header class="doc-head">
            <div class="head-top">
                <coins></coins>
            </div>
            <div class="head-bottom">
                <a class="logo" href="#">daoment</a>
                <div class="contact-info pull-right">
                    <span>indecies about contact</span>
                </div>
            </div>
        </header>

        <div class="content-wrap">
            @yield('content')
        </div>

        <footer class="footer">
            <div class="container">
                &copy; {{ date('Y') }} Daoment.
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
