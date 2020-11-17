@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection
@section('content')
    <h1 class="text-center">
        Разходи {{count($costs) != NULL ? 'за '. $costs[0]->truckData->licence_plate : ''}}
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
            @foreach ($costs as $cost)
                <tr>
                    <td><a href="{{route('paid-trip.edit', $cost->id)}}">
                            {{date("F", mktime(0, 0, 0, $cost->reportingPeriod->month, 10))}} {{$cost->reportingPeriod->year}}
                        </a>
                    </td>
                    <td>{{$cost->price}}</td>
                    <td>{{$cost->note}}</td>
                    <td>
                        <form action="{{ route('cost.destroy', ['cost_id'=> $cost->id]) }}"
                              method="POST">
                            @method('delete')
                            @csrf
                            <input type="submit" value="Изтрии" class="btn btn-danger btn-sm"
                                   onclick="return confirm('Сигурен ли си че искаш да изтриеш?');">
                        </form>
                    </td>
                </tr>
            @endforeach
            {{ $costs->links() }}
            </tbody>
        </table>
    </div>
    <div class="col-md-12 text-center"><a href="{{route('truck.show', $truck_id)}}"
                                          class="btn btn-sm blue-btn m-4">Назад към камиона</a>
    </div>
@endsection
