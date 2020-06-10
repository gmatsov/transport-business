<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaidTripRequest;
use App\Http\Requests\UpdatePaidTripRequest;
use App\Models\PaidTrip;
use App\Models\ReportingPeriod;
use App\Models\Truck;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PaidTripController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showByTruck($truck_id)
    {
        $trips = PaidTrip::where('truck_id', $truck_id)->orderBy('reporting_period_id', 'desc')->paginate(10);

        return view('paid_trip.show_by_truck', compact('trips'));
    }

    public function create($truck_id)
    {
        $truck = Truck::where('id', $truck_id)->get(['id', 'licence_plate'])->first();

        $trips = PaidTrip::where('truck_id', $truck_id)->orderBy('reporting_period_id', 'desc')->take(8)->get();

        return view('paid_trip.create', compact('truck', 'trips'));
    }

    public function store(PaidTripRequest $request)
    {
        try {
            $reporting_period_id = ReportingPeriod::where('year', $request['year'])->where('month', $request['month'])->firstOrFail()->id;

        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Навалиден отчетен период');
        }

        $request['reporting_period_id'] = $reporting_period_id;

        PaidTrip::create($request->all());

        return redirect()->back()->with('success', 'Успесно добавени платени километри');
    }

    public function edit($id)
    {
        $paid_trip = PaidTrip::where('id', $id)->first();

        $truck_id = PaidTrip::where('id', $id)->pluck('truck_id')->first();

        $truck = Truck::where('id', $truck_id)->pluck('licence_plate')->first();

        return view('paid_trip.edit', compact('paid_trip', 'truck'));
    }

    public function update(PaidTripRequest $request, $id)
    {
        try {
            $reporting_period_id = ReportingPeriod::where('year', $request['year'])->where('month', $request['month'])->firstOrFail()->id;

        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Навалиден отчетен период');
        }

        $request['reporting_period_id'] = $reporting_period_id;

        PaidTrip::where('id', $id)->update([
            'distance' => $request['distance'],
            'price_per_km' => $request['price_per_km'],
            'reporting_period_id' => $request['reporting_period_id'],
        ]);

        return redirect()->back()->with('success', 'Успешно редакция');

    }

    public function destroy($id)
    {
        $truck_id = PaidTrip::where('id', $id)->pluck('truck_id')->first();

        PaidTrip::destroy($id);

        return redirect()->route('paid-trip.create', [$truck_id])->with('success', 'Успешно изтрит запис');
    }
}
