<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaidTripRequest;
use App\Http\Requests\ParkingRequest;
use App\Http\Requests\UpdateParkingRequest;
use App\Models\PaidTrip;
use App\Models\Parking;
use App\Models\ReportingPeriod;
use App\Models\Truck;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ParkingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showByTruck($truck_id)
    {
        $parking_lots = Parking::where('truck_id', $truck_id)->orderBy('reporting_period_id', 'desc')->paginate(15);

        return view('parking.show_by_truck', compact('parking_lots', 'truck_id'));
    }

    public function create($truck_id)
    {
        $truck = Truck::where('id', $truck_id)->get(['id', 'licence_plate'])->first();

        $parking_lots = Parking::where('truck_id', $truck_id)->orderBy('reporting_period_id', 'desc')->take(8)->get();

        return view('parking.create', compact('truck', 'parking_lots'));
    }

    public function store(ParkingRequest $request)
    {
        try {
            $reporting_period_id = ReportingPeriod::where('year', $request['year'])->where('month', $request['month'])->firstOrFail()->id;

        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Навалиден отчетен период');
        }

        $request['reporting_period_id'] = $reporting_period_id;
        Parking::create($request->all());

        return redirect()->back()->with('success', 'Успесно добавени разходи за паркинг');
    }

    public function edit($id)
    {
        $parking = Parking::where('id', $id)->first();

        $truck_id = Parking::where('id', $id)->pluck('truck_id')->first();

        $truck = Truck::where('id', $truck_id)->pluck('licence_plate')->first();

        return view('parking.edit', compact('parking', 'truck'));
    }

    public function update(ParkingRequest $request, $id)
    {
        try {
            $reporting_period_id = ReportingPeriod::where('year', $request['year'])->where('month', $request['month'])->firstOrFail()->id;

        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Навалиден отчетен период');
        }

        $request['reporting_period_id'] = $reporting_period_id;

        Parking::where('id', $id)->update([
            'price' => $request['price'],
            'note' => $request['note'],
            'reporting_period_id' => $request['reporting_period_id'],
        ]);

        return redirect()->back()->with('success', 'Успешно редакция');

    }

    public function destroy($id)
    {
        $truck_id = Parking::where('id', $id)->pluck('truck_id')->first();

        Parking::destroy($id);

        return redirect()->route('parking.create', [$truck_id])->with('success', 'Успешно изтрит запис');
    }
}
