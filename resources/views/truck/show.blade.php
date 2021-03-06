@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/truck/remove.js') }}" defer></script>
    <script src="{{ asset('js/truck/show.js') }}" defer></script>

@endsection
@section('styles')
    <link href="{{ asset('css/truck/show.css') }}" rel="stylesheet">

@endsection
@section('content')

    <h1 class="text-center">{{ $truck->licence_plate}}</h1>
    <div class="row mb-4 truck-menu">
        <div>
            <a href="{{route('refuel.create', $truck->id)}}" id="add_fuel"
               class="btn btn-outline-info">
                <i class="fas fa-plus"></i> Гориво
            </a>
        </div>
        <div>
            <a href="{{route('paid-trip.create', $truck->id)}}" id="show_refuels" class="btn btn-outline-info">
                <i class="fas fa-plus"></i> Платени км
            </a>
        </div>
        <div>
            <a href="{{route('cost.create', $truck->id)}}" id="add_costs"
               class="btn btn-outline-info">
                <i class="fas fa-plus"></i> Разходи
            </a>
        </div>


        <div>
            <a href="{{route('refuel.truck', $truck->id)}}" id="show_refuels"
               class="btn btn-outline-info"><i class="fas fa-eye"></i>
                Зареждания
            </a>
        </div>
        <div>
            <a href="{{route('paid-trip.truck', $truck->id)}}"
               class="btn btn-outline-info"><i
                    class="fas fa-eye"></i>
                Платени км
            </a>
        </div>
        <div>
            <a href="{{route('cost.truck', $truck->id)}}" id="show_refuels"
               class="btn btn-outline-info"><i class="fas fa-eye"></i>
                Разходи
            </a>
        </div>

        <div>
            <button type="button" class="btn btn-outline-danger small-button font-weight-bold"
                    data-toggle="modal"
                    data-target="#removeTruckModal">
                {{__('Премахни камион')}}
            </button>

            <div class="modal fade" id="removeTruckModal" tabindex="-1" role="dialog"
                 aria-labelledby="removeTruckModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"
                                id="removeTruckModalHeader">{{__('Премахни камион')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{__(' Със заличаването на камиона ще загубите всички данни за него.')}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success"
                                    data-dismiss="modal">{{__('Изход')}}</button>
                            <form method="post" action="{{route('truck.destroy', $truck->id)}}">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Премахни камион" class="btn btn-danger">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="truck-data col-md-6">
            <div class="show_truck_header">Данни за МПС</div>
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
                <div class="border-bottom"><span><i class="fas fa-calendar-alt mr-2"></i> Година производство</span>
                    <span
                        class="float-right">{{$truck->production_year}}</span></div>
            @endif
            @if(isset($truck->horse_power))
                <div class="border-bottom"><span><i class="fas fa-horse mr-2"></i>Мощност</span>
                    <span
                        class="float-right">{{$truck->horse_power}}</span></div>
            @endif
        </div>
        <div class="truck-stats col-md-6">
            <ul class="nav nav-tabs show_truck_header">
                <li class="active" id="show_stats_tab">
                    <i class="fa fa-bar-chart"> </i>&nbsp;Статистики &nbsp;&nbsp;
                </li>
                <li class="mr-2" id="show_reminder_tab">
                    <i class="fa fa-bell"> </i>&nbsp;Напомняния
                    @if(count($reminders) > 0)
                        <span id="reminder_count"> {{count($reminders)}}</span>
                    @endif
                </li>
                <li id="show_refuels_tab">
                    <i class="fa fa-gas-pump"> </i>&nbsp;Зареждания &nbsp;&nbsp;
                </li>
            </ul>
            <div id="stats_tab">
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
                    <div class="border-bottom"><span><i class="fas fa-euro-sign"></i> Средна цена за литър</span> <span
                            class="float-right">{{number_format((float)$stats['average_price_per_liter'], 2, '.', ' ')}}</span>
                    </div>
                </div>
                <div>
                    <div class="border-bottom"><span><i class="fas fa-road"></i> Общо изминати км.</span> <span
                            class="float-right">{{number_format((float)$stats['total_mileage'], 2, '.', ' ')}}</span>
                    </div>
                </div>
                <div>
                    <div class="border-bottom"><span><i class="fas fa-road"></i> Общо платени км.</span> <span
                            class="float-right">{{number_format((float)$stats['total_paid_trips'], 2, '.', ' ')}}</span>
                    </div>
                </div>
                <div>
                    <div class="border-bottom"><span><i class="fas fa-euro-sign"></i> Средна цена за км.</span> <span
                            class="float-right">{{number_format((float)$stats['average_price_per_km'], 2, '.', ' ')}}</span>
                    </div>
                </div>
            </div>
            <div id="reminder_tab" style="display: none">

                @foreach($reminders as $reminder)
                    <div class="reminder-body">
                        <div class="reminder-info ">
                            <div class="row">
                                <a href="{{route('reminder.show', $reminder->id)}}"
                                   class="reminder-header-text d-inline-block col-md-6">{{$reminder->title}}
                                </a>
                                <div class="reminder-due col-md-6">
                                    @if($reminder->by_odometer != NULL)
                                        <div class="">
                                            @if(($reminder->by_odometer - $reminder->km_before - $reminder->truckData->odometer) >= 0)
                                                След {{$reminder->by_odometer - $reminder->km_before - $reminder->truckData->odometer}}
                                                км
                                            @else
                                                Просрочено с <span
                                                    class="text-danger"> {{$reminder->by_odometer - $reminder->km_before - $reminder->truckData->odometer}}</span>
                                                км
                                            @endif

                                        </div>
                                    @endif
                                    @if($reminder->by_date != NULL)
                                        <div class="">

                                            @if(date('Y-m-d', strtotime('-'.$reminder->days_before.' days', strtotime($reminder->by_date))) >=  date('Y-m-d'))
                                                До {{date('d M Y', strtotime('-'.$reminder->days_before.' days', strtotime($reminder->by_date)))}}
                                                г.
                                            @else
                                                Просрочено с <span
                                                    class="text-danger">
                                                {{abs((strtotime('-'.$reminder->days_before.' days', strtotime($reminder->by_date))) - strtotime(today()))/ (60 * 60 * 24)}}
                                            </span>
                                                дни
                                            @endif
                                        </div>
                                    @endif
                                </div>

                                <div class="reminder-actions col-md-12 text-right">
                                    <form method="post" action="{{route('reminder.complete', $reminder->id)}}">
                                        @csrf
                                        <button class="btn btn-success reminder-complete-button"> Отбележи изпълнено</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
            <div id="refuels_tab" style="display: none">
                <div class="refuels text-center">
                    <div class="row">
                        <p class="col-md-3 col-sm-3 col-3">Дата</p>
                        <p class="col-md-3 col-sm-3 col-3">Километраж</p>
                        <p class="col-md-2 col-sm-2 col-2">Дистанция</p>
                        <p class="col-md-2 col-sm-2 col-2">Количество</p>
                        <p class="col-md-2 col-sm-2 col-2">Ø</p>
                    </div>
                    @foreach($refuels as $refuel)
                        <div class="border-bottom row">
                            <span
                                class="col-md-3 col-sm-3 p-0 col-3">
                                <a href="{{route('refuel.edit', $refuel->id)}}"
                                   title="Промени">{{date( 'd M Y',strtotime( $refuel->date))}}</a></span>
                            <span
                                class="col-md-3 col-sm-3 p-0 col-3">{{number_format((integer)$refuel->current_odometer, 0, '', ' ')}}</span>
                            <span
                                class="col-md-2 col-sm-2 p-0 col-2">{{number_format( (integer)$refuel->trip_odometer, 0, '', ' ')}}</span>
                            <span
                                class="col-md-2 col-sm-2 p-0 col-2">{{number_format((float)$refuel->quantity, 2, '.', ' ')}}</span>
                            <span
                                class="col-md-2 col-sm-2 p-0 col-2">{{number_format(((float)$refuel->quantity*100)/$refuel->trip_odometer, 2, '.', ' ')}}</span>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@endsection
