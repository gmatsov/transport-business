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
        $report = (new ReportService($request->all()))->create();

        return view('report.show', compact('report'));
    }
}
