<?php

namespace App\Http\Controllers;

use App\Http\Requests\CostRequest;
use App\Http\Requests\ParkingRequest;
use App\Models\Cost;
use App\Models\Parking;
use App\Models\ReportingPeriod;
use App\Models\Truck;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showByTruck($truck_id)
    {
        $costs = Cost::where('truck_id', $truck_id)->orderBy('reporting_period_id', 'desc')->paginate(15);

        return view('cost.show_by_truck', compact('costs', 'truck_id'));
    }

    public function create($truck_id)
    {
        $truck = Truck::where('id', $truck_id)->get(['id', 'licence_plate'])->first();

        $costs = Cost::where('truck_id', $truck_id)->orderBy('reporting_period_id', 'desc')->take(8)->get();

        return view('cost.create', compact('truck', 'costs'));
    }

    public function store(CostRequest $request)
    {
        try {
            $reporting_period_id = ReportingPeriod::where('year', $request['year'])->where('month', $request['month'])->firstOrFail()->id;

        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Навалиден отчетен период');
        }

        $request['reporting_period_id'] = $reporting_period_id;
        Cost::create($request->all());

        return redirect()->back()->with('success', 'Успесно добавени разходи.');
    }

    public function edit($id)
    {
        $cost = Cost::where('id', $id)->firstOrFail();

        $truck_id = Cost::where('id', $id)->pluck('truck_id')->first();

        $truck = Truck::where('id', $truck_id)->pluck('licence_plate')->first();

        return view('cost.edit', compact('cost', 'truck'));
    }

    public function update(CostRequest $request, $id)
    {
        try {
            $reporting_period_id = ReportingPeriod::where('year', $request['year'])->where('month', $request['month'])->firstOrFail()->id;

        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Навалиден отчетен период');
        }

        $request['reporting_period_id'] = $reporting_period_id;

        Cost::where('id', $id)->update([
            'price' => $request['price'],
            'note' => $request['note'],
            'reporting_period_id' => $request['reporting_period_id'],
        ]);

        return redirect()->back()->with('success', 'Успешно редакция');

    }

    public function destroy($id)
    {
        $truck_id = Cost::where('id', $id)->pluck('truck_id')->firstOrFail();

        Cost::destroy($id);

        return redirect()->route('cost.create', [$truck_id])->with('success', 'Успешно изтрит запис');
    }
}
