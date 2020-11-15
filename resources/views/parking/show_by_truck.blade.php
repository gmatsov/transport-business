@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection
@section('content')
    <h1 class="text-center">
        Платени километри {{count($parking_lots) != NULL ? 'за '. $parking_lots[0]->truckData->licence_plate : ''}}
    </h1>
    <div>
        <table class="table text-center table-striped row-sm">
            <thead>
            <tr>
                <th>Отчетен период</th>
                <th>Сума</th>
                <th>Бележка</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($parking_lots as $parking)
                <tr>
                    <td><a href="{{route('paid-trip.edit', $parking->id)}}">
                            {{date("F", mktime(0, 0, 0, $parking->reportingPeriod->month, 10))}} {{$parking->reportingPeriod->year}}
                        </a>
                    </td>
                    <td>{{$parking->price}}</td>
                    <td>{{$parking->note}}</td>
                    <td>
                        <form action="{{ route('parking.destroy', ['parking_id'=> $parking->id]) }}"
                              method="POST">
                            @method('delete')
                            @csrf
                            <input type="submit" value="Изтрии" class="btn btn-danger btn-sm"
                                   onclick="return confirm('Сигурен ли си че искаш да изтриеш?');">
                        </form>
                    </td>
                </tr>
            @endforeach
            {{ $parking_lots->links() }}
            </tbody>
        </table>
    </div>
    <div class="col-md-12 text-center"><a href="{{route('truck.show', $truck_id)}}"
                                          class="btn btn-success m-4">Назад към камиона</a>
    </div>
@endsection
