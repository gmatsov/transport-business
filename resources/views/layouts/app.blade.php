<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{str_replace('_', ' ',config('app.name'))}}</title>
    <link rel="icon" href="{{ URL::asset('img/logo-small.png') }}" type="image/x-icon"/>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/354cc2ddb6.js" crossorigin="anonymous"></script>

@yield('scripts')

<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
<div id="app" class="pl-4 pr-4">
    @include('layouts.nav')
    @guest
    @else
        @include('layouts.sidebar')
    @endguest
    <main class="py-4">
        <div id="messages">
            @if (\Session::has('error'))
                <div class="alert alert-danger">
                    {!! \Session::get('error') !!}
                    <button type="button" class="close" data-dismiss="alert">×</button>
                </div>
            @endif
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    {!! \Session::get('success') !!}
                    <button type="button" class="close" data-dismiss="alert">×</button>
                </div>
            @endif
        </div>

    @yield('content')
</div>
</main>
@include('layouts.footer')
</body>
</html>
