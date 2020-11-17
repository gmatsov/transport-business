@extends('layouts.guest')
@section('content')
    <div class="login-form">
        <h1>Здравей</h1>

        <form class="form" method="POST" action="{{ route('login') }}">
            @csrf
            <input id="username" type="text"
                   class=" @error('username') is-invalid @enderror"
                   name="username"
                   value="{{ old('username') }}"
                   placeholder="Потребителско име"
                   autocomplete="username"
                   required>

            @error('email')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input id="password"
                   type="password"
                   class=" @error('password') is-invalid @enderror"
                   name="password"
                   placeholder="Парола"
                   required
                   autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <button type="submit">
                {{ __('Вход') }}
            </button>
            <div></div>
            @if (Route::has('password.request'))
                <a class="forgot-password" href="{{ route('password.request') }}">
                    {{ __('Забравена парола?') }}
                </a>
            @endif
        </form>
    </div>

@endsection
