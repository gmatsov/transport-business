@extends('layouts.guest')

@section('content')
    <div class="welcome-page">
    <h1>Codi Trans</h1>
        <div>

            <a class="go-to-login" href="{{route('login')}}">Вход</a>
        </div>
    </div>
@endsection
