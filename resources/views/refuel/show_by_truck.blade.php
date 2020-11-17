@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection
@section('content')
    <h1 class="text-center">Зареждания
        на {{count($refuels) != NULL ? $refuels->first()->truckData->licence_plate : ''}}</h1>
    <div>
        <table class="table table-striped text-center row-sm">
            <thead>
            <tr>
                <th>Дата</th>
                <th>Количество</th>
                <th>Цена</th>
                <th>Покзания на километража</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($refuels as $refuel)
                <tr>
                    <td>
                        <a href="{{route('refuel.edit', $refuel->id)}}">{{$refuel->date}}</a>
                    </td>
                    <td>{{$refuel->quantity}}</td>
                    <td>{{$refuel->price}}</td>
                    <td>{{$refuel->current_odometer}}</td>
                    <td>
                        <form method="post" action="{{route('refuel.destroy', $refuel->id)}}"
                              onclick="return confirm('Сигурен ли си')">
                            @method('delete')
                            @csrf
                            <input type="submit" value="Изтрии" class="btn btn-danger btn-sm">
                        </form>
                    <td>
                </tr>
            @endforeach
            {{ $refuels->links() }}
            </tbody>
        </table>
    </div>
    <div class="col-md-12 text-center">
        <a href="{{route('truck.show', $truck_id)}}" class="btn btn-sm blue-btn m-4">Назад към камиона</a>
    </div>
@endsection
