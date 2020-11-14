<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRefuelRequest;
use App\Http\Requests\UpdateRefuelRequest;
use App\Models\PaidTrip;
use App\Models\Refuel;
use App\Models\Reminder;
use App\Models\ReportingPeriod;
use App\Models\Truck;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RefuelController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function showByTruck($truck_id)
    {
        $refuels = Refuel::where('truck_id', $truck_id)->orderBy('id', 'desc')->paginate(15);

        return view('refuel.show_by_truck', compact('refuels', 'truck_id'));
    }

    public function create($truck_id)
    {
        $truck = Truck::where('id', $truck_id)->get(['id', 'licence_plate', 'odometer'])->first();
        $refuels = Refuel::where('truck_id', $truck_id)->orderBy('id', 'desc')->take(8)->get();

        if (!$truck) {
            return back()->with('error', 'Няма такъв камион');
        }
        return view('refuel.create', compact('truck', 'refuels'));
    }

    public function store(CreateRefuelRequest $request)
    {
        $old_odometer = Truck::where('id', $request['truck_id'])->pluck('odometer')->first();

        try {
            $reporting_period_id = ReportingPeriod::where('year', $request['year'])->where('month', $request['month'])->firstOrFail()->id;

        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Навалиден отчетен период');
        }

        $last_refuel_of_this_truck = Refuel::where('truck_id', $request->truck_id)->latest('date')->pluck('date')->first();
        if ($request->date < $last_refuel_of_this_truck) {
            return redirect()->back()->with('error', 'Не може да въвеждате зареждане с по-малка дата от последното зареждане')->withInput();
        }

        $request['reporting_period_id'] = $reporting_period_id;
        $request['trip_odometer'] = $request['current_odometer'] - $old_odometer;

        Truck::where('id', $request['truck_id'])->update(['odometer' => $request['current_odometer']]);
        Refuel::create($request->all());

        return redirect()->back()->with('success', 'Успесно добавено зареждане');

    }

    public function edit($id)
    {
        $refuel = Refuel::where('id', $id)->firstOrFail();

        return view('refuel.edit', compact('refuel'));
    }

    public function update(UpdateRefuelRequest $request, $refuel_id)
    {

        $old_trip_odometer = Refuel::findOrFail($refuel_id)->trip_odometer;
        $old_current_odometer = Refuel::findOrFail($refuel_id)->current_odometer;
        $new_trip_odometer = $old_trip_odometer + ($request->current_odometer - $old_current_odometer);

        if ($this->isLastRefuel($refuel_id)) {

            $old_trip_odometer = Refuel::findOrFail($refuel_id)->trip_odometer;
            $old_current_odometer = Refuel::findOrFail($refuel_id)->current_odometer;
            $new_trip_odometer = $old_trip_odometer + ($request->current_odometer - $old_current_odometer);
            $truck_id = Refuel::findOrFail($refuel_id)->truck_id;

            if ($new_trip_odometer < 1) {
                $min_current_odometer = Refuel::where('truck_id', $truck_id)->orderBy('created_at', 'desc')->offset(1)->take(1)->pluck('current_odometer')->first() + 1;

                return back()->with('error', 'Минимална стойност на километража: ' . $min_current_odometer . ' км');
            }
            $request->request->add(['trip_odometer' => $new_trip_odometer]);

            Refuel::findOrFail($refuel_id)->update($request->all());
            Truck::findOrFail($truck_id)->update(['odometer' => $request->current_odometer]);

            return redirect()->back()->with('success', 'Успешно променено зареждане');

        }

        $next_refuel_trip_odometer = Refuel::where('id', $this->nextRefuelIdByTruck($refuel_id))->pluck('trip_odometer')->first();
        $data['date'] = $request->date;
        $data['quantity'] = $request->quantity;
        $data['price'] = $request->price;
        $data['trip_odometer'] = $new_trip_odometer;
        $data['current_odometer'] = $old_current_odometer + ($new_trip_odometer - $old_trip_odometer);
        $data['note'] = $request->note;

        Refuel::where('id', $refuel_id)->update($data);
        Refuel::where('id', $this->nextRefuelIdByTruck($refuel_id))->update(['trip_odometer' => ($next_refuel_trip_odometer - ($new_trip_odometer - $old_trip_odometer))]);

        return redirect()->back()->with('success', 'Успешно променено зареждане');

    }

    public function destroy($id)
    {
        $truck_id = Refuel::where('id', $id)->pluck('truck_id')->first();
        $refuel = Refuel::where('id', $id)->first();

        if ($this->isLastRefuel($id)) {
            $updated_odometer = $refuel->current_odometer - $refuel->trip_odometer;

            Truck::where('id', $truck_id)->update(['odometer' => $updated_odometer]);
            Refuel::where('id', $id)->delete();

            return back()->with('success', 'Успешно изтрито зареждане');;
        }

        $next_refuel_trip = Refuel::where('id', $this->nextRefuelIdByTruck($id))->pluck('trip_odometer')->first();

        Refuel::where('id', $this->nextRefuelIdByTruck($id))->update(['trip_odometer' => $next_refuel_trip + $refuel->trip_odometer]);
        Refuel::where('id', $id)->delete();

        return back()->with('success', 'Успешно изтрито зареждане');

    }

    private function nextRefuelIdByTruck($id)
    {
        $truck_id = Refuel::where('id', $id)->pluck('truck_id')->first();
        return Refuel::where('truck_id', $truck_id)->where('id', '>', $id)->pluck('id')->first();
    }

    private function isLastRefuel($current_refuel_id)
    {
        $truck_id = Refuel::where('id', $current_refuel_id)->pluck('truck_id')->first();
        $last_inserted_by_truck = Refuel::where('truck_id', $truck_id)->latest('date')->pluck('id')->first();

        if ($last_inserted_by_truck == $current_refuel_id) {
            return true;
        }
        return false;
    }
}
