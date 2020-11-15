@extends('layouts.app')

@section('scripts')
@endsection

@section('content')
    <h1 class="text-center">Репорт</h1>

    <form method='get' action="{{ route('report.show') }}">
        @csrf
        <div class="form-group">
            <label for="truck_id">МПС </label>
            <select id="truck_id" class="form-control @error('truck_id') is-invalid @enderror" name="truck_id">
                <option value="">Избери</option>
                @foreach($trucks as $truck)

                    <option
                        {{old('truck_id') == $truck->id ? 'selected' : ''}} value="{{$truck->id}}">{{$truck->licence_plate}}</option>
                @endforeach
            </select>
            @error('truck_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label class="d-block" for="truck_id">Отчетен период </label>
            <select class="form-control col-md-6  float-left @error('month') is-invalid @enderror" name="month"
                    id="month">
                @for($i = 1; $i<= 12; $i++)
                    <option
                        value="{{$i}}" {{date("F") == date("F", mktime(0, 0, 0, $i, 10)) ? 'selected' : ''}}>{{date("F", mktime(0, 0, 0, $i, 10))}}</option>
                @endfor
            </select>

            <select class="form-control col-md-6 @error('year') is-invalid @enderror" name="year" id="year">
                @for($i = -1; $i<= 1; $i++)
                    <option value="{{date("Y")+$i}}"
                        {{(date("Y")+$i == date("Y")) ? 'selected' : ''}}>
                        {{date("Y")+$i}}</option>
                @endfor
            </select>
            @error('month')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            @error('year')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="alert alert-info">
            Добави нужните опции за репорта
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <input type="hidden" name="km_traveled" id="km_traveled_hidden" value="0">
                <label>
                    <input
                        type="checkbox"
                        id="km_traveled"
                        name="km_traveled"
                        value="1"
                        aria-invalid="false">
                    Изминати километри</label>
            </div>
            <div class="form-group col-md-6">
                <input type="hidden" name="paid_km_traveled" id="paid_km_traveled_hidden" value="0">
                <label>
                    <input
                        type="checkbox"
                        id="paid_km_traveled"
                        name="paid_km_traveled"
                        value="1"
                        aria-invalid="false">
                    Изминати платени километри</label>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <input type="hidden" name="km_difference" id="km_difference_hidden" value="0">
                <label>
                    <input
                        type="checkbox"
                        id="km_difference"
                        name="km_difference"
                        value="1"
                        aria-invalid="false">
                    Разлика между платени и изминати км.</label>
            </div>
            <div class="form-group col-md-6">
                <input type="hidden" name="fuel_consumption" id="fuel_consumption_hidden" value="0">
                <label>
                    <input
                        type="checkbox"
                        id="fuel_consumption"
                        name="fuel_consumption"
                        value="1"
                        aria-invalid="false">
                    Среден разход</label>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <input type="hidden" name="parking" id="parking" value="0">
                <label>
                    <input
                        type="checkbox"
                        id="parking"
                        name="parking"
                        value="1"
                        aria-invalid="false">
                    Паркинги</label>
            </div>
            <div class="form-group col-md-6">
                <input type="hidden" name="costs" id="costs" value="0">
                <label>
                    <input
                        type="checkbox"
                        id="costs"
                        name="costs"
                        value="1"
                        aria-invalid="false">
                    Разходи</label>
            </div>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-success">Генерирай</button>
        </div>
    </form>
@endsection
