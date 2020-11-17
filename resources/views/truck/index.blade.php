@extends('layouts.app')

@section('scripts')
@endsection

@section('content')
    <h1 class="text-center">Моите камиони</h1>

    <a href="{{route('truck.create')}}" class="btn btn-sm blue-btn">Добави камион</a>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="text-center col-md-8">
            <div class="row bg-info text-white p-2">
                <div class="col-md-4 col-sm-4 col-4">Регистрационен номер</div>
                <div class="col-md-4 col-sm-4 col-4">Километраж</div>
                <div class="col-md-4 col-sm-4 col-4">Промени</div>
            </div>
            @foreach($trucks as $truck)
                <div class="row border-bottom p-1" id="truck-{{$truck->id}}">
                    <div class="col-md-4 col-sm-4 col-4"><a href="{{route('truck.show',[$truck->id])}}"class="">{{$truck->licence_plate}}</a></div>
                    <div class="col-md-4 col-sm-4 col-4">{{$truck->odometer}}</div>
                    <div class="col-md-4 col-sm-4 col-4"><a href="{{route('truck.edit', $truck->id)}}" class="btn btn-sm blue-btn">Промени</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
