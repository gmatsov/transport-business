<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReminderRequest;
use App\Models\Reminder;
use App\Models\Truck;

class ReminderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $reminders = Reminder::all();

        return view('reminder.index', compact('reminders'));
    }

    public function create()
    {
        $trucks = Truck::all(['id', 'licence_plate']);

        return view('reminder.create', compact('trucks'));
    }

    public function store(ReminderRequest $request)
    {
        if ($request->remind_by_odometer) {

            $truck_odometer = Truck::where('id', $request->truck_id)->pluck('odometer')->first();

            if ($request->by_odometer <= $truck_odometer) {
                return redirect()->back()->withInput()->withErrors(["by_odometer" => "Минимален километраж " . ($truck_odometer + 1)]);
            }
        }

        Reminder::create($request->all());

        return redirect()->back()->with('success', 'Успесно добавено напомняне');
    }

    public function show($id)
    {
        $reminder = Reminder::where('id', $id)->first();

        return view('reminder.show', compact('reminder'));
    }

    public function destroy($id)
    {
        Reminder::destroy($id);

        return redirect()->route('reminder.index')->with('success', 'Успешно изтрито напомняне');
    }

    public function edit($id)
    {
        $trucks = Truck::all(['id', 'licence_plate']);
        $reminder = Reminder::where('id', $id)->firstOrFail();

        return view('reminder.edit', compact('reminder', 'trucks'));
    }

    public function markComplete($id)
    {
        $reminder = Reminder::findOrFail($id);

        if ($reminder->finished_at == NULL) {

            $reminder->update(['finished_at' => now()]);

            return back()->with('success', 'Напомнянето е прекратено');
        }
        $reminder->update(['finished_at' => NULL]);

        return back()->with('success', 'Напомнянето е подновено');
    }

    public function update(ReminderRequest $request, $id)
    {
        if ($request->remind_by_odometer) {

            $truck_odometer = Truck::where('id', $request->truck_id)->pluck('odometer')->first();

            if ($request->by_odometer <= $truck_odometer) {
                return redirect()->back()->withInput()->withErrors(["by_odometer" => "Минимален километраж " . ($truck_odometer + 1)]);
            }
        } else {
            $request->request->add(['by_odometer' => NULL]);
            $request->request->add(['km_before' => NULL]);

        }

        if ($request->remind_by_date == 0) {
            $request->request->add(['by_date' => NULL]);
            $request->request->add(['days_before' => 0]);
        }

        Reminder::where('id', $id)->firstOrFail()->update($request->all());

        return redirect()->back()->with('success', 'Успесно променено напомняне');
    }
}
