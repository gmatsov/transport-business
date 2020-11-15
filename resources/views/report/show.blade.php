@extends('layouts.app')

@section('scripts')
@endsection
@section('styles')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="custom-print-area">
        <h1 class="text-center">Репорт за {{ $report->licence_plate }}</h1>
        <h5 class="row">
            Отчетен период: {{date("F", mktime(0, 0, 0, $report->month, 10))}} {{ $report->year }}
        </h5>
        <div class="row mt-3">
            @if(isset( $report->paid_trip_km_traveled ))
                <div class="col-md-3 font-weight-bold">Платени километри</div>
                <div class="col-md-1">{{$report->paid_trip_km_traveled}}</div>
            @endif
            @if(isset( $report->km_traveled ))
                <div class="col-md-3 font-weight-bold">Изминати километри</div>
                <div class="col-md-1">{{$report->km_traveled}}</div>
            @endif
            @if(isset( $report->km_difference ))
                <div class="col-md-3 font-weight-bold">Разлика между изминати и платени километри</div>
                <div class="col-md-1">{{$report->km_difference}}</div>
            @endif
        </div>
        <hr/>

        <div class="row">
            @if(isset( $report->paid_trip_km_traveled ))
                <div class="col-md-3 font-weight-bold">Платена сума</div>
                <div class="col-md-1">{{$report->paid_amount}}</div>
            @endif
            @if(isset( $report->fuel_consumption ))
                <div class="col-md-3 font-weight-bold">Среден разход</div>
                <div class="col-md-1">{{$report->fuel_consumption}}</div>
            @endif

        </div>

    </div>
    @if(isset( $report->paid_trip_km_traveled ))
        <hr/>
        <div class="row text-center font-weight-bold col-md-6">
            <div class="col-md-12"> Разбивка на платените километри</div>
        </div>
        <div class="row">
            <table class="table table-striped col-md-6">
                <tr>
                    <th class="col-md-3">Цена на километър</th>
                    <th class="col-md-3">Разстояние</th>
                </tr>
                @foreach($report->paid_trip_details as $detailed_paid_trip)
                    <tr>
                        <td class="col-md-4">{{$detailed_paid_trip->price_per_km}} €</td>
                        <td class="col-md-4">{{$detailed_paid_trip->total_distance}} км.</td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endif

    <div class="d-flex justify-content-center">
        <button onclick="window.print()" class="custom-print-button btn btn-info">Принтирай</button>
    </div>
@endsection
