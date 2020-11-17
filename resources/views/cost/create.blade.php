@extends('layouts.app')

@section('styles')

@endsection

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Добавяне на разходи на камион {{$truck->licence_plate}}</h1>
        <div class="row p-2">
            <div class="col-md-6 ">
                <form method="post" action="{{route('cost.store')}}" class="">
                    @csrf
                    <input type="number" name="truck_id" value="{{$truck->id}}" hidden>
                    <div class="form-group">
                        <h5>Отечетен период</h5>
                        <select class="form-control col-md-6 mb-2 float-left" name="month" id="month">
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
                        <label for="price"><i class="fas fa-euro-sign"></i> Стойност</label>
                        <input type="number" name="price" min="0" step="0.01" placeholder="Цена"
                               class="form-control float-right col-md-6  @error('price') is-invalid @enderror"
                               id="trip" value="{{old('price')}}">
                        @error('price')
                        <div class="col-md-12 float-right text-right text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="note"><i class="fas fa-sticky-note"></i>Бележка</label>
                        <input type="text" placeholder="Бележка"
                               name="note"
                               class="form-control float-right col-md-6  @error('note') is-invalid @enderror"
                               id="price_per_km" value="{{old('note')}}">
                        @error('note')
                        <div class="col-md-12 float-right text-right text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" value="Добави" class="btn btn-success submit mt-4" id="submit">
                    </div>
                </form>

            </div>
            <div class="col-md-6 text-center">
                <h4>Последни разходи за паркинг</h4>
                <div class="costs">
                    <div class="row">
                        <p class="col-md-4 col-sm-4 col-4">Отчетен период</p>
                        <p class="col-md-4 col-sm-3 col-2">Стойност</p>
                        <p class="col-md-4 col-sm-3 col-2">Бележка</p>
                    </div>
                    @foreach($costs as $cost)
                        <div class="border-bottom row">
                            <span class="col-md-4 col-sm-4 col-4 d-inline-block">
                                <a href="{{route('cost.edit', $cost->id)}}">
                                    {{date("F", mktime(0, 0, 0, $cost->reportingPeriod->month, 10))}} {{$cost->reportingPeriod->year}}
                                </a>
                                </span>
                            <span class="col-md-4 col-sm-3 col-2 d-inline-block">{{$cost->price}}</span>
                            <span class="col-md-4 col-sm-3 col-2 d-inline-block">{{$cost->note}}</span>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-12 text-center"><a href="{{route('truck.show', $truck->id)}}"
                                                      class="btn btn-success m-4">Назад към камиона</a>
                </div>
            </div>
        </div>
@endsection
