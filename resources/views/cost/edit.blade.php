@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/create-refuel.css') }}" rel="stylesheet">

@endsection

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Промяна на разходи за {{$truck}}</h1>
        <div class="align-content-center">
            <div>
                <form method="post" action="{{route('cost.update', $cost->id)}}">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <h5>Отечетен период</h5>
                        <select class="form-control col-md-6 mb-2 float-left" name="month" id="month">
                            @for($i = 1; $i<= 12; $i++)
                                <option
                                    value="{{$i}}" {{$cost->reportingPeriod->month == $i ? 'selected' : ''}}>{{date("F", mktime(0, 0, 0, $i, 10))}}</option>
                            @endfor
                        </select>
                        <select class="form-control col-md-6" name="year" id="year">
                            @for($i = -1; $i <= 1; $i++)
                                <option value="{{date("Y")+$i}}"
                                    {{(date("Y")+$i == date($cost->reportingPeriod->year)) ? 'selected' : ''}}>
                                    {{date("Y")+$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group row">
                        <label class="d-inline-block col-md-6" for="price"><i class="fas fa-euro-sign"></i> Цена</label>
                        <input type="number" name="price" min="0" step="0.01"
                               placeholder="Цена : {{$cost->price}} "
                               class="form-control  col-md-6  @error('price') is-invalid @enderror"
                               id="price" value="{{old('price') ?  old('price') : $cost->price}}">
                        @error('price')
                        <div class="col-md-12 text-right text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label class="d-inline-block col-md-6" for="note"><i class="fas fa-sticky-note"></i>
                            Бележка</label>
                        <input type="text" step="0.01" min="0.01" max="9.99"
                               placeholder="Старо показание : {{$cost->note}}"
                               name="note"
                               class="form-control col-md-6  @error('note') is-invalid @enderror"
                               id="note"
                               value="{{old('note') ? old('note') : $cost->note}}">
                        @error('note')
                        <div class="col-md-12 text-right text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label class="d-inline-block col-md-6" for="category"><i class="fas fa-clipboard"></i> Категория</label>
                        <select name="category" id="category" class="form-control col-md-6">
                            <option selected disabled>Избери</option>

                            @foreach($categories as $category)
                                <option disabled class="bg-info text-white">{{$category->name}}</option>

                                @foreach($sub_categories as $sub_category)
                                    @if($sub_category->main_category_id == $category->id)
                                        <option value="{{$sub_category->id}}"
                                            {{$cost->sub_category_id == $sub_category->id ? 'selected' : ''}}>
                                            {{$sub_category->name}}
                                        </option>
                                    @endif
                                @endforeach

                            @endforeach
                        </select>

                        @error('category')
                        <div class="col-md-12 float-right text-right text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" value="Промени" class="btn btn-sm blue-btn submit mt-4" id="submit">
                    </div>
                </form>
                <form action="{{ route('cost.destroy', ['cost_id'=> $cost->id]) }}" method="POST">
                    @method('delete')
                    @csrf
                    <input type="submit" value="Изтрии" class="btn btn-sm btn-danger"
                           onclick="return confirm('Сигурен ли си че искаш да изтриеш?');">
                </form>
            </div>
        </div>
@endsection
