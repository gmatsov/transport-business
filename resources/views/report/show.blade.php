@extends('layouts.app')

@section('scripts')
@endsection
@section('styles')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="custom-print-area">
        <h1 class="text-center">Репорт за {{ $report->licence_plate }}</h1>

        <div class="text-center">
            <div>Отчетен период: &nbsp;&nbsp;
            </div>
            <div>{{date("F", mktime(0, 0, 0, $report->month, 10))}} {{ $report->year }}</div>

            @if(isset( $report->km_traveled ))
                <div>Изминати км: &nbsp;&nbsp;</div>
                <div>{{$report->km_traveled}}</div>
            @else
                <div>Изминати км: &nbsp;&nbsp;</div>
                <div>0</div>
            @endif
            @if(isset( $report->paid_trip_km_traveled ))
                <div>Изминати платени км: &nbsp;&nbsp;</div>
                <div>{{$report->paid_trip_km_traveled}}</div>
            @else
                <div>Изминати платени км: &nbsp;&nbsp;</div>
                <div>0</div>
            @endif
            @if(isset( $report->km_difference ))
                <div>Разликa между изминати и плтени км. : &nbsp;&nbsp;</div>
                <div>{{$report->km_difference}}</div>
            @endif
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <button onclick="window.print()" class="custom-print-button btn btn-info">Принтирай</button>
    </div>
@endsection
