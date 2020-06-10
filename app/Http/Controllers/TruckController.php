<?php

namespace App\Http\Controllers;

use App\Models\EmissionClass;
use App\Http\Requests\CreateTruckRequest;
use App\Http\Requests\UpdateTruckRequest;
use App\Models\Truck;

class TruckController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $trucks = Truck::all();

        return view('truck.index', compact('trucks'));
    }

    public function create()
    {
        $emission_classes = EmissionClass::all();

        return view('truck.create', compact('emission_classes'));
    }

    public function store(CreateTruckRequest $request)
    {
        Truck::create($request->all());

        return response()->json(['success' => 'Успешно добавен камион с рег. № ' . $request['licence_plate']]);
    }

    public function show($id)
    {
        $truck = Truck::where(['id' => $id])->first();

        $stats = Truck::truckStats($id);

        return view('truck.show', compact('truck', 'stats'));
    }

    public function edit($id)
    {
        $emission_classes = EmissionClass::all();
        $truck = Truck::where(['id' => $id])->first();

        return view('truck.edit', compact('truck', 'emission_classes'));
    }

    public function update(UpdateTruckRequest $request)
    {
        Truck::find($request->truck_id)->update($request->all());

        return response()->json(['success' => 'Успешно променени данни']);

    }

    public function destroy($id)
    {
        Truck::destroy($id);

        return redirect()->route('truck.index');
    }
}
