@extends('layouts.app')

@section('styles')

@endsection

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Добавяне на разходи на камион {{$truck->licence_plate}}</h1>
        <div class="row">
            <div class="col-md-6 ">
                <form method="post" action="{{route('cost.store')}}" class="">
                    @csrf
                    <input type="number" name="truck_id" value="{{$truck->id}}" hidden>
                    <h5>Отечетен период</h5>
                    <div class="form-group row">
                        <select class="form-control col-md-6" name="month" id="month">
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
                    <div class="form-group row">
                        <label class="d-inline-block col-md-6" for="category"><i class="fas fa-clipboard"></i> Категория</label>
                        <select name="category" id="category" class="form-control col-md-6">
                            <option selected disabled>Избери</option>

                            @foreach($categories as $category)
                                <option disabled class="bg-info text-white">{{$category->name}}</option>

                                @foreach($sub_categories as $sub_category)
                                    @if($sub_category->main_category_id == $category->id)
                                        <option value="{{$sub_category->id}}">{{$sub_category->name}}</option>
                                    @endif
                                @endforeach

                            @endforeach
                        </select>

                        @error('category')
                        <div class="col-md-12 float-right text-right text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label class="d-inline-block col-md-6" for="price"><i class="fas fa-euro-sign"></i>
                            Стойност</label>
                        <input type="number" name="price" min="0" step="0.01" placeholder="Цена"
                               class="form-control col-md-6  @error('price') is-invalid @enderror"
                               id="trip" value="{{old('price')}}">
                        @error('price')
                        <div class="col-md-12 float-right text-right text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label class="d-inline-block col-md-6" for="note"><i class="fas fa-sticky-note"></i>
                            Бележка</label>
                        <input type="text" placeholder="Бележка"
                               name="note"
                               class="form-control col-md-6  @error('note') is-invalid @enderror"
                               id="price_per_km" value="{{old('note')}}">
                        @error('note')
                        <div class="col-md-12 float-right text-right text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" value="Добави" class="btn btn-sm blue-btn submit mt-4" id="submit">
                    </div>
                </form>

            </div>
            <div class="col-md-6 text-center">
                <h4>Последни разходи за паркинг</h4>
                <div class="costs">
                    <div class="row">
                        <p class="col-md-3 col-sm-3 col-3">Отчетен период</p>
                        <p class="col-md-3 col-sm-3 col-3">Стойност</p>
                        <p class="col-md-3 col-sm-3 col-3">Категория</p>
                        <p class="col-md-3 col-sm-3 col-3">Бележка</p>
                    </div>
                    @foreach($costs as $cost)
                        <div class="border-bottom row">
                            <span class="col-md-3 col-sm-3 col-3 d-inline-block">
                                <a href="{{route('cost.edit', $cost->id)}}">
                                    {{date("F", mktime(0, 0, 0, $cost->reportingPeriod->month, 10))}} {{$cost->reportingPeriod->year}}
                                </a>
                                </span>
                            <span class="col-md-3 col-sm-3 col-3 d-inline-block">{{$cost->price}}</span>
                            <span class="col-md-3 col-sm-3 col-3 d-inline-block">{{$cost->category->name}}</span>
                            <span class="col-md-3 col-sm-3 col-3 d-inline-block">{{$cost->note}}</span>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-12 text-center"><a href="{{route('truck.show', $truck->id)}}"
                                                      class="btn btn-sm blue-btn m-4">Назад към камиона</a>
                </div>
            </div>
        </div>
    </div>
@endsection
