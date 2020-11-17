@extends('layouts.app')

@section('scripts')
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <script src="{{ asset('js/dashboard.js') }}" defer></script>

@endsection

@section('content')
    @foreach($reminders as $reminder)
        <div class="alert alert-danger">
            <a href="{{route('truck.show', $reminder->truck_id)}}">{{$reminder->truckData->licence_plate}}</a> :
            <a href="{{route('reminder.show', $reminder->id)}}">{{$reminder->title}}</a> {{$reminder->note}}
            <form class="d-inline " method="post"
                  action="{{route('reminder.close', $reminder->id)}}">
                @csrf
                @method('put')
                <button
                    type="submit" class="close">x
                </button>
            </form>
        </div>
    @endforeach
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
        <div id="traveled_km_chart" style="height: 250px ;" class="col-md-6">
            <h4 class="text-center">Изминати километри</h4>
        </div>

        <div id="avg_fuel_consumption_chart" style="height: 250px;" class="col-md-6">
            <h4 class="text-center">Среден разход в литри</h4>
        </div>
        <div id="paid_trips_chart" style="height: 250px;" class="col-md-6">
            <h4 class="text-center">Платени километри</h4>
        </div>
        <div id="avg_fuel_price_chart" style="height: 250px;" class="col-md-6">
            <h4 class="text-center">Средна цена на гориво в Евро</h4>
        </div>
        <div id="number_of_trucks" style="height: 250px;" class="col-md-3">
            <h4 class="text-center">Брой камиони</h4>
        </div>

    </div>

@endsection

