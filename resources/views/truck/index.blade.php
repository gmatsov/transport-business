@extends('layouts.app')

@section('scripts')
@endsection

@section('content')
    <h1 class="text-center">Моите камиони</h1>
    <div class="text-center d-md-none mt-2 mb-2">
        <a href="{{route('truck.create')}}" class="btn btn-outline-success">Добави камион</a>
    </div>
    <table id="trucks_table" class="table table-striped text-center">
        <thead>
        <tr class="table-info">
            <th>Регистрационен номер</th>
            <th>Километраж</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($trucks as $truck)
            <tr id="truck-{{$truck->id}}">
                <td><a href="{{route('truck.show',[$truck->id])}}" class="">{{$truck->licence_plate}}</a></td>
                <td>{{$truck->odometer}}</td>
                <td><a href="{{route('truck.edit', $truck->id)}}" class="btn btn-outline-info">Промени</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
