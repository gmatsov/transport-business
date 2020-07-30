@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/add_reminder.js') }}" defer></script>
@endsection
@section('styles')

@endsection
@section('content')
    <h1 class="text-center">Добави напомняне</h1>

    <div class="p-4">
        <form method="post" action="{{route('reminder.store')}}">
            @csrf
            <div class="form-group">
                <label for="truck_id">МПС <span class="required">*</span></label>
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
                <label for="title">Заглавие <span class="required">*</span></label>
                <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" name="title"
                       value="{{old('title')}}">
                @error('title')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <hr>
            <div class="alert alert-info">
                Трябва да определиш поне крайна дата или краен километраж. Ако отбележиш и двете, напомнянето ще
                бъде изпратено веднъж - при настъпване на първото.
            </div>
            <div>
                <div class="row">
                    <div class="col-xs-12 col-md-3">
                        <div class="form-group">
                            <input type="hidden" name="remind_by_date" id="remind_by_date_hidden" value="0">
                            <label>

                                <input
                                    type="checkbox"
                                    id="remind_by_date"
                                    name="remind_by_date"
                                    value="1"
                                    aria-invalid="false"
                                    {{!old("remind_by_date") ? "checked" : ""}}
                                    {{old("remind_by_date") == 1 ? "checked" : ""}}
                                >
                                Напомни по дата</label>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-4">
                        <div class="form-group">
                            <label for="by_date">Дата</label>
                            <div class="input-group">
                                <input type="date" id="by_date"
                                       class="form-control  @error('by_date') is-invalid @enderror"
                                       value="{{old("by_date") ? old("by_date") : date('Y-m-d')}}"
                                       name="by_date">
                            </div>
                            @error('by_date')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <div class="form-group">
                            <label for="days_before">Напомни ми</label>
                            <select class="form-control  @error('days_before') is-invalid @enderror" id="days_before"
                                    name="days_before">
                                <option value="0" {{old("days_before") == 0 ? "selected" : ""}}>на самата дата</option>
                                <option value="1" {{old("days_before") == 1 ? "selected" : ""}}>1 ден по-рано</option>
                                <option value="2" {{old("days_before") == 2 ? "selected" : ""}}>2 дни по-рано</option>
                                <option value="3" {{old("days_before") == 3 ? "selected" : ""}}>3 дни по-рано</option>
                                <option value="4" {{old("days_before") == 4 ? "selected" : ""}}>4 дни по-рано</option>
                                <option value="5" {{old("days_before") == 5 ? "selected" : ""}}>5 дни по-рано</option>
                                <option value="6" {{old("days_before") == 6 ? "selected" : ""}}>6 дни по-рано</option>
                                <option value="7" {{old("days_before") == 7 ? "selected" : ""}}>7 дни по-рано</option>
                                <option value="14" {{old("days_before") == 14 ? "selected" : ""}}>14 дни по-рано
                                </option>
                                <option value="21" {{old("days_before") == 21 ? "selected" : ""}}>21 дни по-рано
                                </option>
                                <option value="30" {{old("days_before") == 30 ? "selected" : ""}}>30 дни по-рано
                                </option>
                            </select>
                            @error('days_before')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div id="remind-by-odometer-container">
                <div class="row">
                    <div class="col-xs-12 col-md-3">
                        <div class="form-group">
                            <input type="hidden" name="remind_by_odometer" id="remind_by_odometer_hidden"
                                   value="0">
                            <label>
                                <input
                                    type="checkbox" id="remind_by_odometer" name="remind_by_odometer"
                                    value="1"
                                    aria-invalid="false"
                                    {{old('remind_by_odometer') == 1 ? 'checked' : ''}}>
                                Напомни по километраж
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-6">
                    </div>
                    <div class="col-xs-6 col-md-4">
                        <div class="form-group ">
                            <label for="by_odometer">Краен километраж</label>
                            <input type="number" id="by_odometer"
                                   class="form-control @error('by_odometer') is-invalid @enderror"
                                   name="by_odometer"
                                   {{old('remind_by_odometer') == 1 ? '' : 'disabled'}}
                                   value="{{old("by_odometer")}}">
                            @error('by_odometer')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-4">
                        <div class="form-group ">
                            <label for="km_before">Напомни ми</label>
                            <input type="number" id="km_before"
                                   class="form-control @error('km_before') is-invalid @enderror"
                                   name="km_before"
                                   {{old('remind_by_odometer') == 1 ? '' : 'disabled'}}
                                   value="{{old("km_before")}}"

                            > преди достигане
                        </div>
                        @error('km_before')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label for="note">Бележка (опционално)</label>
                <textarea id="note" class="form-control" name="note"
                          rows="2">{{old("note")}}</textarea>

                <div class="help-block"></div>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-success">Добави напомняне</button>
            </div>
        </form>
    </div>
@endsection
