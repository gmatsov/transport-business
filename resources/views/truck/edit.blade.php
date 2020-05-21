@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/edit_truck.js') }}" defer></script>
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center">Камион: {{$truck->brand}} {{$truck->licence_plate}}</h1>

        <form>
            <input type="number" name="truck_id" value="{{$truck->id}}" hidden>
            <div class="form-group">
                <label for="licence_plate"><i class="fas fa-passport mr-2"></i>Регистрационен номер<span
                            class="required">*</span></label>
                <input type="text" class="form-control col-md-6 float-right" name="licence_plate" id="licence_plate"
                       placeholder="Регистрационен номер" value="{{$truck->licence_plate}}" required>
            </div>
            <div class="form-group">
                <label for="brand"><i class="fas fa-truck-moving mr-2"></i>Марка</label>
                <input type="text" class="form-control col-md-6 float-right" name="brand" id="brand"
                       placeholder="Марка" value="{{$truck->brand}}">
            </div>
            <div class="form-group">
                <label for="model"><i class="fas fa-trailer mr-2"></i>Модел</label>
                <input type="text" class="form-control col-md-6 float-right" name="model" id="model"
                       placeholder="Модел" value="{{$truck->model}}">
            </div>
            <div class="form-group">
                <label for="production_year"> <i class="far fa-calendar-alt mr-2"></i>Година на производство</label>
                <select name="production_year" id="production_year" class="form-control col-md-6 float-right">
                    <option value="">Година на производство</option>
                    @for($i= date('Y')- 10; $i <= date('Y'); $i++)
                        <option value="{{$i}}" {{$truck->production_year == $i ? 'selected' : ''}}>{{$i}}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label for="horse_power"><i class="fas fa-horse mr-2"></i>Мощност / К.С.</label>
                <input type="number" name="horse_power" id="horse_power" class="form-control col-md-6 float-right"
                       min="1" max="1500" placeholder="Мощност в К.С." value="{{$truck->horse_power}}">
            </div>

            <div class="form-group">
                <label for="vin"><i class="fas fa-fingerprint mr-2"></i>Рама</label>
                <input type="text" class="form-control col-md-6 float-right" name="vin" id="vin" placeholder="Рама"
                       value="{{$truck->vin}}">
            </div>

            <div class="form-group">
                <label for="emission_class"><i class="fas fa-smog mr-2"></i> Евро категория</label>
                <select name="emission_class" id="emission_class" class="form-control col-md-6 float-right">
                    <option></option>
                    @foreach($emission_classes as $emission_class)
                        <option value="{{$emission_class->id}}" {{$truck->emission_class == $emission_class->id ? 'selected' : ''}}>{{$emission_class->emission_category}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group text-center">
                <input type="button" value="Промени" class="btn btn-success submit mt-4" id="submit">
            </div>
        </form>
    </div>
@endsection
