@extends('layouts.app')

@section('scripts')
@endsection

@section('content')
    <h1 class="text-center">Моите камиони</h1>
    <div class="row align-content-center">
    <div class="table-responsive text-center">
        <table id="trucks_table" class="table table-striped col-md-8">
            <thead>
            <tr class="thead-dark ">
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
    </div>
    </div>
@endsection
