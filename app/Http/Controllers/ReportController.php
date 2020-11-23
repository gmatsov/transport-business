<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Models\Truck;
use App\Services\ReportService;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $trucks = Truck::all(['id', 'licence_plate']);

        return view('report.index', compact('trucks'));
    }

    public function show(ReportRequest $request)
    {
        if ($request->start_year > $request->end_year) {
            return back()->with('error', 'Началния период не може да бъде след крайния период.')->withInput();

        }

        if ($request->start_year == $request->end_year) {
            if ($request->start_month > $request->end_month) {
                return back()->with('error', 'Началния период не може да бъде след крайния период.')->withInput();
            }
        }
        if ($request->truck_id == NULL) {
            $trucks = Truck::all();
            $report_data = [];
            foreach ($trucks as $truck) {
                $data = $request->all();
                $data['truck_id'] = $truck->id;

                array_push($report_data, (new ReportService($data))->create());
            }

        } else {
            $report_data = (object)[(new ReportService($request->all()))->create()];
        }

        return view('report.show', compact('report_data'));
    }
}
