@extends('layouts.app')

@section('styles')

@endsection
@section('content')
    <h1 class="text-center mb-4">Промени зареждане</h1>
    <div class=" col-md-6">
        <form action="{{route('refuel.update', $refuel->id)}}" method="post">
            @method('put')
            @csrf
            <div class="form-group">
                <label for="date"><i class="far fa-calendar-alt"></i> Дата</label>
                <input type="date" name="date" value="{{$refuel->date}}"
                       class="form-control float-right col-md-6"
                       id="date">
            </div>
            <div class="form-group">
                <label for="quantity"><i class="fas fa-gas-pump"></i> Количество в литри</label>
                <input type="number" step="0.01" name="quantity" min="0" placeholder="Заредени литри"
                       class="form-control float-right col-md-6"
                       id="quantity" value="{{$refuel->quantity}}">
            </div>
            <div class="form-group">
                <label for="price"><i class="fas fa-euro-sign"></i> Цена</label>
                <input type="number" step="0.01" min="1" placeholder="цена е Евро" name="price"
                       class="form-control float-right col-md-6"
                       id="price" value="{{$refuel->price}}">
            </div>
            <div class="form-group">
                <label for="current_odometer"><i class="fas fa-tachometer-alt"></i> Километраж</label>
                <input type="number" class="form-control float-right col-md-6" name="current_odometer"
                       id="current_odometer" value="{{$refuel->current_odometer}}">
            </div>
            <div class="form-group">
                <label for="note"><i class="far fa-clipboard"></i> Бележка</label>
                <textarea type="text" class="form-control float-right col-md-6" name="note"
                          id="current_odometer"
                          placeholder="Бележка" rows="1">{{$refuel->note}}</textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Промени" class="btn btn-success submit mt-4" id="submit">
            </div>
        </form>
    </div>
    <div class="col-md-12 text-center"><a href="{{route('truck.index')}}" class="btn btn-success m-4">Назад</a>
@endsection
