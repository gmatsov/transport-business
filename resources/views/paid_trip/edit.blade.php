@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/create-refuel.css') }}" rel="stylesheet">

@endsection

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Промяна на платени километри за камион {{$truck}}</h1>
        <div class="align-content-center">
            <div>
                <form method="post" action="{{route('paid-trip.update', $paid_trip->id)}}">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <h5>Отечетен период</h5>
                        <select class="form-control col-md-6 mb-2 float-left" name="month" id="month">
                            @for($i = 1; $i<= 12; $i++)
                                <option
                                    value="{{$i}}" {{$paid_trip->reportingPeriod->month == $i ? 'selected' : ''}}>{{date("F", mktime(0, 0, 0, $i, 10))}}</option>
                            @endfor
                        </select>
                        <select class="form-control col-md-6" name="year" id="year">
                            @for($i = -1; $i <= 1; $i++)
                                <option value="{{date("Y")+$i}}"
                                    {{(date("Y")+$i == date($paid_trip->reportingPeriod->year)) ? 'selected' : ''}}>
                                    {{date("Y")+$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="distance"><i class="fas fa-gas-pump"></i> Изминати км</label>
                        <input type="number" name="distance" min="0" max="9999"
                               placeholder="Старо показание : {{$paid_trip->distance}} "
                               class="form-control float-right col-md-6  @error('distance') is-invalid @enderror"
                               id="trip" value="{{old('distance') ?  old('distance') : $paid_trip->distance}}">
                        @error('distance')
                        <div class="col-md-12 float-right text-right text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price_per_km"><i class="fas fa-euro-sign"></i> Цена за км</label>
                        <input type="number" step="0.01" min="0.01" max="9.99"
                               placeholder="Старо показание : {{$paid_trip->price_per_km}}"
                               name="price_per_km"
                               class="form-control float-right col-md-6  @error('price_per_km') is-invalid @enderror"
                               id="price_per_km"
                               value="{{old('price_per_km') ? old('price_per_km') : $paid_trip->price_per_km}}">
                        @error('price_per_km')
                        <div class="col-md-12 float-right text-right text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" value="Промени" class="btn btn-success submit mt-4" id="submit">
                    </div>
                </form>
                <form action="{{ route('paid-trip.destroy', ['paid_trip_id'=> $paid_trip->id]) }}" method="POST">
                    @method('delete')
                    @csrf
                    <input type="submit" value="Изтрии" class="btn btn-danger"
                           onclick="return confirm('Сигурен ли си че искаш да изтриеш?');">
                </form>
            </div>
        </div>
@endsection
