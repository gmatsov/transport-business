<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{str_replace('_', ' ',config('app.name'))}}</title>
    <link rel="icon" href="{{ URL::asset('img/logo-small.png') }}" type="image/x-icon"/>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="{{ asset('css/guest.css') }}" rel="stylesheet">

</head>
<body>
<div id="app">
    <main>
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
</body>
</html>
