@extends('layouts.guest')
@section('content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form class="password-reset-form" method="POST" action="{{ route('password.email') }}">
        <h1>{{ __('Нулиране на парола') }}</h1>
        @csrf

        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"
               value="{{ old('email') }}" required autocomplete="email" placeholder="Имейл адрес">

        @error('email')
        <div role="alert">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <button type="submit">
            {{ __('Изпрати') }}
        </button>
    </form>
@endsection
