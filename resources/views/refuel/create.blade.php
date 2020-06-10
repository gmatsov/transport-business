@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/create-refuel.css') }}" rel="stylesheet">

@endsection

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Ново зареждане на камион {{$truck->licence_plate}}</h1>
        <div class="row p-2">

            <div class="float-left col-md-6 m-0 p-0 refuel-form">
                <form method="post" action="{{route('refuel.store')}}" class="">
                    @csrf
                    <input type="number" name="truck_id" value="{{$truck->id}}" hidden>
                    <div class="form-group">
                        <h5>Отечетен период</h5>
                        <select class="form-control col-md-6  float-left" name="month" id="month">
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
                        <label for="date"><i class="far fa-calendar-alt"></i> Дата</label>
                        <input type="date" name="date" value="{{date('Y-m-d')}}"
                               class="form-control float-right col-md-6  @error('date') is-invalid @enderror"
                               id="date">
                        @error('date')
                        <div class="col-md-12 text-right text-danger float-right">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="quantity"><i class="fas fa-gas-pump"></i> Количество в литри</label>
                        <input type="number" step="0.01" name="quantity" min="0" placeholder="Заредени литри"
                               class="form-control float-right col-md-6  @error('quantity') is-invalid @enderror"
                               id="quantity" value="{{old('quantity')}}">
                        @error('quantity')
                        <div class="col-md-12 text-right text-danger float-right">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price"><i class="fas fa-euro-sign"></i> Цена</label>
                        <input type="number" step="0.01" min="1" placeholder="цена е Евро" name="price"
                               class="form-control float-right col-md-6  @error('price') is-invalid @enderror"
                               id="price" value="{{old('price')}}">
                        @error('price')
                        <div class="col-md-12 text-right text-danger float-right">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="current_odometer"><i class="fas fa-tachometer-alt"></i> Километраж</label>
                        <input type="number"
                               class="form-control float-right col-md-6  @error('current_odometer') is-invalid @enderror"
                               name="current_odometer"
                               id="current_odometer"
                               placeholder="{{$truck->odometer +1}}"
                               value="{{ old('current_odometer') }}">
                        @error('current_odometer')
                        <div class="col-md-12 text-right text-danger float-right">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="note"><i class="far fa-clipboard"></i> Бележка</label>
                        <textarea type="text" class="form-control float-right col-md-6" name="note"
                                  id="current_odometer"
                                  placeholder="Бележка" rows="1"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" value="Добави" class="btn btn-success submit mt-4" id="submit">
                    </div>
                </form>

            </div>
            <div class="col-md-6 float-right p-0 refuels-stats">
                <h4 class="text-center">Последни зареждания</h4>
                <div class="refuels">
                    <div>
                        <p class="col-md-3 col-sm-3 col-3">Дата</p>
                        <p class="col-md-3 col-sm-3 col-3">Километраж</p>
                        <p class="col-md-2 col-sm-2 col-2">Дистанция</p>
                        <p class="col-md-2 col-sm-2 col-2">Количество</p>
                        <p class="col-md-1 col-sm-1 col-1">Ø</p>
                    </div>
                    @foreach($refuels as $refuel)
                        <div class="border-bottom">
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
                                class="col-md-1 col-sm-1 p-0 col-1">{{number_format(((float)$refuel->quantity*100)/$refuel->trip_odometer, 2, '.', ' ')}}</span>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-12 text-center"><a href="{{route('truck.show', $truck->id)}}"
                                                      class="btn btn-success m-4">Назад към камиона</a>
                </div>
            </div>
        </div>
@endsection
