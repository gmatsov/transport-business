@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/create-refuel.css') }}" rel="stylesheet">

@endsection

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Добавяне на платени километри за камион {{$truck->licence_plate}}</h1>
        <div class="row p-2">
            <div class="float-left col-md-6 m-0 p-0">
                <form method="post" action="{{route('paid-trip.store')}}" class="">
                    @csrf
                    <input type="number" name="truck_id" value="{{$truck->id}}" hidden>
                    <div class="form-group">
                        <h5>Отечетен период</h5>
                        <select class="form-control col-md-6 mb-2 float-left" name="month" id="month">
                            @for($i = 1; $i<= 12; $i++)
                                <option
                                    value="{{$i}}" {{date("F") == date("F", mktime(0, 0, 0, $i, 10)) ? 'selected' : ''}}>{{date("F", mktime(0, 0, 0, $i, 10))}}</option>
                            @endfor
                        </select>
                        <select class="form-control col-md-6" name="year" id="year">
                            @for($i = -1; $i<= 1; $i++)
                                <option value="{{date("Y")+$i}}"
                                    {{(date("Y")+$i == date("Y")) ? 'selected' : ''}}>
                                    {{date("Y")+$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="distance"><i class="fas fa-gas-pump"></i> Изминати км</label>
                        <input type="number" name="distance" min="0" max="9999" placeholder="Изминати км"
                               class="form-control float-right col-md-6  @error('distance') is-invalid @enderror"
                               id="trip" value="{{old('distance')}}">
                        @error('trip')
                        <div class="col-md-12 float-right text-right text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price_per_km"><i class="fas fa-euro-sign"></i> Цена за км</label>
                        <input type="number" step="0.01" min="0.01" max="9.99" placeholder="цена е Евро за км."
                               name="price_per_km"
                               class="form-control float-right col-md-6  @error('price_per_km') is-invalid @enderror"
                               id="price_per_km" value="{{old('price_per_km')}}">
                        @error('price_per_km')
                        <div class="col-md-12 float-right text-right text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Добави" class="btn btn-success submit mt-4" id="submit">
                    </div>
                </form>

            </div>
            <div class="col-md-6 float-right p-0">
                <h4 class="text-center">Последни добавени платени км.</h4>
                <div class="refuels ">
                    <div>
                        <p class="col-md-4 col-sm-4 col-4">Отчетен период</p>
                        <p class="col-md-3 col-sm-3 col-3">Дистанция</p>
                        <p class="col-md-4 col-sm-3 col-2">Цена</p>
                    </div>
                    @foreach($trips as $trip)
                        <div class="border-bottom">
                            <span
                                class="col-md-4 col-sm-4 col-4">{{date("F", mktime(0, 0, 0, $trip->reportingPeriod->month, 10))}} {{$trip->reportingPeriod->year}}</span>
                            <span class="col-md-3 col-sm-3 col-3">{{$trip->distance}}</span>
                            <span
                                class="col-md-2 col-sm-2 col-2">{{number_format((float)$trip->price_per_km, 2, '.', ' ')}}</span>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-12 text-center"><a href="{{route('truck.show', $truck->id)}}"
                                                      class="btn btn-success m-4">Назад към камиона</a>
            </div>
        </div>
    </div>
@endsection
