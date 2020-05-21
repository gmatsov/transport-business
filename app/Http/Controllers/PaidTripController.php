<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaidTripRequest;
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

    public function create($truck_id)
    {
        $truck = Truck::where('id', $truck_id)->get(['id', 'licence_plate'])->first();
        $trips = PaidTrip::where('truck_id', $truck_id)->orderBy('id', 'desc')->take(8)->get();

        return view('paid_trip.create', compact('truck', 'trips'));
    }

    public function store(CreatePaidTripRequest $request)
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
}
