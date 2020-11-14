@extends('layouts.app')

@section('scripts')
@endsection
@section('styles')
    <link href="{{ asset('css/reminder/show.css') }}" rel="stylesheet">
@endsection
@section('content')

    <h1 class="text-center">Напомняне за {{$reminder->title}}</h1>
    <div id="reminder_body">
        <div class="border-bottom">
            <span><i aria-hidden="true" class="fas fa-truck-moving"></i>&nbsp;&nbsp;&nbsp;Камион</span>
            <span class="float-right"><a
                    href="{{route('truck.show', $reminder->truckData->id)}}">{{$reminder->truckdata->licence_plate}}</a>  </span>
        </div>
        @if($reminder->by_date)
            <div class="border-bottom">
                <span><i class="fas fa-calendar-alt"></i>&nbsp;&nbsp;&nbsp; До дата</span> <span
                    class="float-right"> {{date('d M Y', strtotime( $reminder->by_date))}}</span>
            </div>
            <div class="border-bottom">
                <span><i class="fas fa-bell"></i> &nbsp;&nbsp;&nbsp;Напомни</span>
                <span class="float-right">{{$reminder->days_before}} дни предварително</span>
            </div>
        @endif
        @if($reminder->by_odometer)
            <div class="border-bottom">
                <span><i aria-hidden="true"
                         class="fas fa-tachometer-alt mr-2"></i>&nbsp;Километри</span>
                <span class="float-right">{{$reminder->by_odometer}}</span>
            </div>
            <div class="border-bottom">
                <span><i class="fas fa-bell"></i>&nbsp;&nbsp;&nbsp; Напомни</span>
                <span class="float-right">{{$reminder->km_before ? $reminder->km_before : 0}} км. предварително</span>

            </div>
        @endif
        @if($reminder->note)
            <div class="border-bottom">
                <span><i class="fas fa-sticky-note"></i>&nbsp;&nbsp;&nbsp; Бележка</span>
                <span class="float-right">{{$reminder->note}}</span>
            </div>
        @endif
        @if($reminder->finished_at)
            <div class="border-bottom">
                <span><i class="fas fa-check"></i>&nbsp;&nbsp;&nbsp;Изпълнено на</span>
                <span class="float-right">{{date('d M Y', strtotime( $reminder->finished_at))}}</span>
            </div>
        @endif
        <div class="mt-4 text-center">
            <form class="d-inline-block" method="post" action="{{route('reminder.complete', $reminder->id)}}">
                @csrf
                <button class="btn {{$reminder->finished_at ? 'btn-success' : 'btn-outline-secondary'}}">
                    <i class="fas fa-check"></i> Изпълнено
                </button>
            </form>
            <a href="{{route('reminder.edit', $reminder->id)}}"
               class="btn btn-outline-info d-inline-block">Редактирай</a>
            <form class="d-inline-block" method="post" action="{{route('reminder.destroy', $reminder->id)}}">
                @csrf
                @method('delete')
                <button class="btn btn-outline-danger" onclick="return confirm('Пътвърди изтриване на напомняне!');">
                    <i class="fas fa-trash-alt"></i> Премахни
                </button>
            </form>
        </div>
    </div>
@endsection
