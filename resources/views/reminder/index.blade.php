@extends('layouts.app')

@section('scripts')
@endsection
@section('styles')
    <link href="{{ asset('css/reminder/index.css') }}" rel="stylesheet">
@endsection
@section('content')
    <h1 class="text-center">Напомняния</h1>
    <div class="p-4">
        <div class="text-center d-md-none">
            <a href="{{route('reminder.create')}}" class="btn btn-outline-success">Добави напомняне</a>
        </div>
        @foreach($reminders as $reminder)
            <div class="reminders border-bottom">
                <h4 class="mt-1"><a href="{{route('reminder.show', $reminder->id)}}">{{$reminder->title}}</a>
                    <form class="d-inline-block complete-form" method="post"
                          action="{{route('reminder.complete', $reminder->id)}}">
                        @csrf
                        <button
                            class="mt-2 complete btn {{$reminder->finished_at ? 'btn-success' : 'btn-danger'}}">
                        </button>
                    </form>
                </h4>

                <div>
                    @if($reminder->by_odometer != NULL) <span class="">След {{$reminder->by_odometer - $reminder->truckData->odometer}} км.</span> @endif

                    @if($reminder->by_date != NULL) <span class="">След дата {{$reminder->by_date}} </span> @endif
                    | <a href="{{route('truck.show', $reminder->truckData->id)}}">
                        {{$reminder->truckData->licence_plate}}
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
