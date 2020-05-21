@extends('layouts.app')

@section('scripts')
@endsection

@section('content')
    <h1 class="text-center">Моите камиони</h1>
    <div class="table-responsive">
        <table id="trucks_table" class="table table-striped">
            <thead>
            <tr class="thead-dark ">
                <th>Регистрационен номер</th>
                <th>Километраж</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($trucks as $truck)
                <tr id="truck-{{$truck->id}}">
                    <td>{{$truck->licence_plate}}</td>
                    <td>{{$truck->odometer}}</td>
                    <td><a href="{{route('truck.show',[$truck->id])}}" class="btn btn-outline-success">Виж</a></td>
                    <td><a href="{{route('truck.edit', $truck->id)}}" class="btn btn-outline-info">Промени</a></td>
                    <td><a href="{{route('refuel.create', $truck->id)}}" class="btn btn-outline-dark">Зареждане</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
