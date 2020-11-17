@extends('layouts.app')

@section('scripts')
@endsection
@section('styles')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection
@section('content')
    <h1 class="text-center">Напомняния</h1>

    <a href="{{route('reminder.create')}}" class="btn btn-sm blue-btn">Добави напомняне</a>

    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="row bg-info text-white p-2 text-center">
                <div class="col-md-4 col-sm-4 col-4">Информация</div>
                <div class="col-md-5 col-sm-5 col-5">Камион / Дата</div>
                <div class="col-md-3 col-sm-3 col-3">Статус</div>
            </div>
            @foreach($reminders as $reminder)

                <div class="row border-bottom p-1">
                    <div class="col-md-4 col-sm-4 col-4">
                        <div>
                            <a href="#" data-toggle="modal"
                               data-target="#showReminderModal{{$reminder->id}}">
                                {{$reminder->title}}
                            </a>

                            <div class="modal fade" id="showReminderModal{{$reminder->id}}" tabindex="-1"
                                 role="dialog"
                                 aria-labelledby="#showReminderModal{{$reminder->id}}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"
                                                id="reminderModalHeader">
                                                Напомняне за {{$reminder->title}}
                                            </h5>
                                            <button type="button"
                                                    class="close"
                                                    data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="reminder_body">
                                                <div class="border-bottom">
                                                    <span><i aria-hidden="true" class="fas fa-truck-moving"></i>&nbsp;&nbsp;&nbsp;Камион</span>
                                                    <span class="float-right"><a
                                                            href="{{route('truck.show', $reminder->truckData->id)}}">{{$reminder->truckdata->licence_plate}}</a>  </span>
                                                </div>
                                                @if($reminder->by_date)
                                                    <div class="border-bottom">
                                                        <span><i class="fas fa-calendar-alt"></i>&nbsp;&nbsp;&nbsp; До дата</span>
                                                        <span
                                                            class="float-right"> {{date('d M Y', strtotime( $reminder->by_date))}}</span>
                                                    </div>
                                                    <div class="border-bottom">
                                                        <span><i
                                                                class="fas fa-bell"></i> &nbsp;&nbsp;&nbsp;Напомни</span>
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
                                                        <span>
                                                            <i class="fas fa-bell"></i>&nbsp;&nbsp;&nbsp; Напомни
                                                        </span>
                                                        <span class="float-right">
                                                            {{$reminder->km_before ? $reminder->km_before : 0}} км. предварително
                                                        </span>

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
                                                        <span
                                                            class="float-right">{{date('d M Y', strtotime( $reminder->finished_at))}}</span>
                                                    </div>
                                                @endif
                                                <div class="mt-4 text-center">
                                                    <form class="d-inline-block" method="post"
                                                          action="{{route('reminder.complete', $reminder->id)}}">
                                                        @csrf
                                                        <button
                                                            class="btn {{$reminder->finished_at ? 'btn-success' : 'btn-outline-secondary'}}">
                                                            @if($reminder->finished_at)
                                                                <i class="fas fa-check"></i> Прекратено
                                                            @else
                                                                <i class="fas fa-times"></i> Прекрати
                                                            @endif
                                                        </button>
                                                    </form>
                                                    <a href="{{route('reminder.edit', $reminder->id)}}"
                                                       class="btn btn-outline-info d-inline-block">Редактирай</a>
                                                    <form class="d-inline-block" method="post"
                                                          action="{{route('reminder.destroy', $reminder->id)}}">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-outline-danger"
                                                                onclick="return confirm('Пътвърди изтриване на напомняне!');">
                                                            <i class="fas fa-trash-alt"></i> Премахни
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-5 col-sm-5 col-5">
                        <a href="{{route('truck.show', $reminder->truckData->id)}}">
                            {{$reminder->truckData->licence_plate}}
                        </a> |
                        @if($reminder->by_odometer != NULL) <span class="">След {{$reminder->by_odometer - $reminder->truckData->odometer}} км.</span> @endif

                        @if($reminder->by_date != NULL) <span class="">След дата {{$reminder->by_date}} </span> @endif
                    </div>
                    <div class="col-md-3 col-sm-3 col-3 text-center">
                        <form class="reminder-complete-form" method="post"
                              action="{{route('reminder.complete', $reminder->id)}}">
                            @csrf
                            <button
                                class="mt-2 complete btn {{$reminder->finished_at ? 'btn-success' : 'btn-danger'}}">
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
            <div class="row mt-2">
                {{$reminders->links()}}
            </div>
        </div>
    </div>
@endsection
