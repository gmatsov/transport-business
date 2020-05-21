@extends('layouts.app')

@section('styles')

@endsection
@section('content')
    <h1 class="text-center">Зареждания</h1>
    <div>
        <table class="table table-responsive text-center">
            <thead>
            <tr>
                <th>Дата</th>
                <th>Количество</th>
                <th>Цена</th>
                <th>Покзания на километража</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($refuels as $refuel)
                <tr>
                    <td>{{$refuel->date}}</td>
                    <td>{{$refuel->quantity}}</td>
                    <td>{{$refuel->price}}</td>
                    <td>{{$refuel->current_odometer}}</td>
                    <td><a href="{{route('refuel.edit', $refuel->id)}}" class="btn btn-outline-info">Промени</a>
                    <td>
                    <td>
                        <form method="post" action="{{route('refuel.destroy', $refuel->id)}}">
                            @method('delete')
                            @csrf
                            <input type="submit" value="Изтрии" class="btn btn-outline-danger">
                        </form>
                    <td>
                </tr>
            @endforeach
            {{ $refuels->links() }}
            </tbody>
        </table>
    </div>
    <div class="col-md-12 text-center"><a href="{{route('truck.show', $refuels->first()->truck_id)}}"
                                          class="btn btn-success m-4">Назад към камиона</a>
@endsection
