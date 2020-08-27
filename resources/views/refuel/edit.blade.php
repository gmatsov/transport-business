@extends('layouts.app')

@section('styles')

@endsection
@section('content')
    <h1 class="text-center mb-4">Промени зареждане</h1>
    <div class="d-flex justify-content-center">
        <form action="{{route('refuel.update', $refuel->id)}}" method="post">
            @method('put')
            @csrf

            <div class="form-group">
                <label for="date"><i class="far fa-calendar-alt"></i> Дата</label>
                <input type="date" name="date" value="{{$refuel->date}}"
                       class="form-control float-right col-md-6 @error('date') is-invalid @enderror"
                       id="date">

            </div>
            @error('date')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="quantity"><i class="fas fa-gas-pump"></i> Количество в литри</label>
                <input type="number" step="0.01" name="quantity" min="0" placeholder="Заредени литри"
                       class="form-control float-right col-md-6 @error('quantity') is-invalid @enderror"
                       id="quantity" value="{{$refuel->quantity}}">
            </div>
            @error('quantity')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="price"><i class="fas fa-euro-sign"></i> Сума</label>
                <input type="number" step="0.01" min="1" placeholder="{{$refuel->price}}" name="price"
                       title="обща цена в Евро"
                       class="form-control float-right col-md-6 @error('price') is-invalid @enderror"
                       id="price" value="{{$refuel->price}}">
            </div>
            @error('price')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="current_odometer"><i class="fas fa-tachometer-alt"></i> Километраж</label>
                <input type="number" class="form-control float-right col-md-6 @error('current_odometer') is-invalid @enderror" name="current_odometer"
                       id="current_odometer" value="{{$refuel->current_odometer}}">
            </div>
            @error('current_odometer')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="note"><i class="far fa-clipboard"></i> Бележка</label>
                <textarea type="text" class="form-control float-right col-md-6 @error('note') is-invalid @enderror" name="note"
                          id="current_odometer"
                          placeholder="Бележка" rows="1">{{$refuel->note}}</textarea>
            </div>
            @error('note')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="form-group text-center">
                <input type="submit" value="Промени" class="btn btn-success submit mt-4" id="submit">
            </div>
        </form>
    </div>
    <div class="col-md-12 text-center"><a href="{{route('truck.index')}}" class="btn btn-success m-4">Назад</a>
@endsection
