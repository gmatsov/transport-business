@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/remove_truck.js') }}" defer></script>
@endsection
@section('styles')
    <link href="{{ asset('css/show-truck.css') }}" rel="stylesheet">

@endsection
@section('content')
    <h1 class="text-center">{{ $truck->licence_plate}}</h1>
    <div class="">
        <div class="m-1">
            <div><a href="{{route('refuel.create', $truck->id)}}" id="add_fuel"
                    class="btn btn-outline-info float-left m-1">Зареди
                    гориво</a></div>
        </div>
        <div class="m-1">
            <div><a href="{{route('paid-trip.create', $truck->id)}}" id="show_refuels" class="btn btn-outline-info m-1">Добави
                    платени км</a></div>
        </div>
        <div class="m-1">
            <div><a href="{{route('refuel.truck', $truck->id)}}" id="show_refuels" class="btn btn-outline-info float-left mr-1">Виж
                    зареждания</a></div>
        </div>
        <div class="m-1">
            <div><a href="{{route('paid-trip.truck', $truck->id)}}" id="show_refuels" class="btn btn-outline-info">Виж
                    платени км</a></div>
        </div>
    </div>
    <div class="row p-4">
        <div class=" float-left truck-data pr-2">
            @if(isset($truck->brand))
                <div class="border-bottom"><span><i class="fas fa-truck-moving mr-2"></i>Марка</span> <span
                        class="float-right">{{$truck->brand}}</span></div>
            @endif
            @if(isset($truck->model))
                <div class="border-bottom"><span><i class="fas fa-trailer mr-2"></i>Модел</span> <span
                        class="float-right">{{$truck->model}}</span></div>
            @endif
            @if(isset($truck->licence_plate))
                <div class="border-bottom"><span><i class="fas fa-passport mr-2"></i>Рег. №</span> <span
                        class="float-right">{{$truck->licence_plate}}</span></div>
            @endif
            @if(isset($truck->odometer))
                <div class="border-bottom"><span><i class="fas fa-tachometer-alt mr-2"></i>Километраж</span> <span
                        class="float-right">{{$truck->odometer}}</span></div>
            @endif
            @if(isset($truck->vin))
                <div class="border-bottom"><span><i class="fas fa-fingerprint mr-2"></i>Рама</span> <span
                        class="float-right">{{$truck->vin}}</span></div>
            @endif
            @if(isset($truck->emission_class))
                <div class="border-bottom"><span><i class="fas fa-smog mr-2"></i> Евро категория</span> <span
                        class="float-right">{{$truck->emissionClass->emission_category}}</span></div>
            @endif
            @if(isset($truck->production_year))
                <div class="border-bottom"><span><i class="far fa-calendar-alt mr-2"></i> Година производство</span>
                    <span
                        class="float-right">{{$truck->production_year}}</span></div>
            @endif
            @if(isset($truck->horse_power))
                <div class="border-bottom"><span><i class="fas fa-horse mr-2"></i>Мощност</span>
                    <span
                        class="float-right">{{$truck->horse_power}}</span></div>
            @endif
        </div>
        <div class=" float-right truck-stats">
            <div>
                <div class="border-bottom"><span>Ø Среден разход</span> <span
                        class="float-right">
                {{$stats['total_mileage'] != 0 ? number_format(((float)$stats['total_quantity']*100)/$stats['total_mileage'], 2, '.', ' ') : 0}}
            </span></div>
            </div>
            <div>
                <div class="border-bottom"><span><i class="fas fa-gas-pump"></i> Общо заредени литри</span> <span
                        class="float-right">{{$stats['total_quantity']}}</span></div>
            </div>
            <div>
                <div class="border-bottom"><span><i class="fas fa-road"></i> Общо изминати км.</span> <span
                        class="float-right">{{number_format((float)$stats['total_mileage'], 2, '.', ' ')}}</span></div>
            </div>
            <div>
                <div class="border-bottom"><span><i class="fas fa-road"></i> Общо платени км.</span> <span
                        class="float-right">{{number_format((float)$stats['total_paid_trips'], 2, '.', ' ')}}</span>
                </div>
            </div>
            <div>
                <div class="border-bottom"><span><i class="fas fa-euro-sign"></i> Средна цена гориво.</span> <span
                        class="float-right">{{number_format((float)$stats['average_fuel_price'], 2, '.', ' ')}}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="float-right">
        <form method="post" action="{{route('truck.destroy', $truck->id)}}">
            @csrf
            @method('DELETE')
            <input type="submit" value="Премахни камион" class="btn btn-danger"
                   onclick="return confirm('Сигурен ли си че искаш да изтриеш камион с рег. № {{$truck->licence_plate}}?')">
        </form>
    </div>

    <div class="col-md-12 text-center"><a href="{{route('truck.index')}}" class="btn btn-success m-4">Назад</a>
    </div>
@endsection
