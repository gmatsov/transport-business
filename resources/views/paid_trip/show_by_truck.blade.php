@extends('layouts.app')

@section('styles')

@endsection
@section('content')
    <h1 class="text-center">Платени километри</h1>
    <div>
        <table class="table table-responsive text-center ">
            <thead>
            <tr>
                <th>Отчетен период</th>
                <th>Километри</th>
                <th>Цена на км.</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($trips as $trip)
                <tr>
                    <td><a href="{{route('paid-trip.edit', $trip->id)}}">
                            {{date("F", mktime(0, 0, 0, $trip->reportingPeriod->month, 10))}} {{$trip->reportingPeriod->year}}
                        </a>
                    </td>
                    <td>{{$trip->distance}}</td>
                    <td>{{$trip->price_per_km}}</td>
                    <td>
                        <form action="{{ route('paid-trip.destroy', ['paid_trip_id'=> $trip->id]) }}"
                              method="POST">
                            @method('delete')
                            @csrf
                            <input type="submit" value="Изтрии" class="btn btn-danger"
                                   onclick="return confirm('Сигурен ли си че искаш да изтриеш?');">
                        </form>
                    </td>
                </tr>
            @endforeach
            {{ $trips->links() }}
            </tbody>
        </table>
    </div>
    <div class="col-md-12 text-center"><a href="{{route('truck.show', $trips->first()->truck_id)}}"
                                          class="btn btn-success m-4">Назад към камиона</a>
@endsection
