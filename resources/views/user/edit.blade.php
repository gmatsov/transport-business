@extends('layouts.app')

@section('scripts')
@endsection
@section('styles')

@endsection
@section('content')
    <h1 class="text-center mb-4">Потребителски панел</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="text-center">
                <h4>Промени потребителски данни</h4>
            </div>
            <form method="post" action="{{route('user.update', auth()->id())}}">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="username">Потребителско име</label>
                    <input type="text" name="username" id="username"
                           class="form-control  @error('username') is-invalid @enderror" value="{{$user->username}}"
                           placeholder="Потребителско име">
                    @error('username')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="first_name">Име</label>
                    <input type="text" name="first_name" id="first_name"
                           class="form-control @error('first_name') is-invalid @enderror"
                           value="{{$user->first_name}}"
                           placeholder="Име">
                    @error('first_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="last_name">Фамилия</label>
                    <input type="text" name="last_name" id="last_name"
                           class="form-control @error('last_name') is-invalid @enderror" value="{{$user->last_name}}"
                           placeholder="Фамилия">
                    @error('last_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Имейл</label>
                    <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{$user->email}}"
                           placeholder="Имейл адрес">
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Парола</label>
                    <input type="password" name="password" id="password"
                           class="form-control @error('password') is-invalid @enderror" placeholder="Парола">
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group text-center">
                    <input type="submit" class="btn btn-sm blue-btn" value="Промени">
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <div class="text-center">
                <h4>Промени парола</h4>
            </div>
            <form action="{{route('password-change')}}" method="post">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="old_password">Стара парола</label>
                    <input type="password" id="old_password"
                           class="form-control  @error('old_password') is-invalid @enderror" name="old_password">
                    @error('old_password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="new_password">Нова парола</label>
                    <input type="password" id="new_password"
                           class="form-control  @error('new_password') is-invalid @enderror" name="new_password">
                    @error('new_password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="new_password_confirmation">Повтори нова парола</label>
                    <input type="password" id="new_password_confirmation"
                           class="form-control  @error('new_password_confirmation') is-invalid @enderror"
                           name="new_password_confirmation">
                    @error('new_password_confirmation')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group text-center">
                    <input type="submit" class="btn blue-btn btn-sm" value="Промени парола">
                </div>
            </form>
        </div>
    </div>
@endsection
