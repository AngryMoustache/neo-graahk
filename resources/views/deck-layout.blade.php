<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="https://kit.fontawesome.com/989b502037.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
        @stack('scripts')
        <livewire:styles>
    </head>
    <body id="deck-builder" onresize="fitCardBuilder()">
        <div class="wrapper">
            <main id="app">@yield('content')</main>
        </div>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <livewire:scripts>
    </body>
</html>
