<?php

namespace App\Http\Controllers;

use App\Models\PaidTrip;
use App\Models\Refuel;
use App\Models\ReportingPeriod;
use App\Models\Truck;
use Chartisan\PHP\Chartisan;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function AvgFuelConsumptionChart()
    {
        $months = [];
        $trucks_data = Truck::all('id', 'licence_plate');
        $current_reporting_period = ReportingPeriod::where('year', date('Y'))->where('month', date('m'))->pluck('id')->first();

        for ($i = 5; $i >= 0; $i--) {
            array_push($months, date('M Y', strtotime('-' . $i . ' months')));
        }

        $chart = array(
            "chart" => array(
                "labels" => $months
            ),
            "datasets" => array()
        );

        foreach ($trucks_data as $truck_data) {
            $data = [];

            for ($i = $current_reporting_period - 5; $i <= $current_reporting_period; $i++) {
                $avg_fuel_cons = DB::select(
                    'SELECT ROUND((SUM(refuels.quantity) / SUM(refuels.trip_odometer))* 100,2) as avg_fuel_consumption
                        FROM refuels
                        WHERE refuels.truck_id = ' . $truck_data->id .
                    '   AND refuels.reporting_period_id = ' . $i . ' ')[0]->avg_fuel_consumption;
                array_push($data, $avg_fuel_cons);
            }

            array_push($chart['datasets'], (array('name' => $truck_data->licence_plate, 'values' => $data)));
        }
        return $chart;
    }

    public function AvgFuelPriceChart()
    {
        $months = [];
        $data = [];
        $current_reporting_period = ReportingPeriod::where('year', date('Y'))->where('month', date('m'))->pluck('id')->first();

        for ($i = 11; $i >= 0; $i--) {
            array_push($months, date('M Y', strtotime('-' . $i . ' months')));
        }

        $chart = array(
            "chart" => array(
                "labels" => $months
            ),
            "datasets" => array()
        );

        for ($i = $current_reporting_period - 11; $i <= $current_reporting_period; $i++) {
            $avg_fuel_price = DB::select(
                'SELECT ROUND((SUM(refuels.quantity)/ SUM(refuels.price)),2) AS avg_fuel_price FROM refuels WHERE refuels.reporting_period_id =' . $i)[0]->avg_fuel_price;
            array_push($data, $avg_fuel_price);
        }
        array_push($chart['datasets'], (array('name' => 'Цена в Евро', 'values' => $data)));
        return $chart;
    }

    public function NumberOfTrucksChart()
    {
        $number_of_trucks = [Truck::all(['id'])->count()];

        return array(
            "chart" => array(
                "labels" => $number_of_trucks
            ),
            "datasets" => array(
                array("name" => 'Брой камиони', "values" => $number_of_trucks),
            )
        );
    }

    public function KmTraveledChart()
    {
        $licence_plates = Truck::all('licence_plate')->pluck('licence_plate')->toArray();
        $trucks_id = Truck::all('id')->toArray();
        $km_traveled_this_reporting_period = [];
        $km_traveled_last_reporting_period = [];
        $current_reporting_period = ReportingPeriod::where('year', date('Y'))->where('month', date('m'))->pluck('id')->toArray();

        foreach ($trucks_id as $truck_id) {
            array_push($km_traveled_this_reporting_period, Refuel::where('truck_id', $truck_id)->where('reporting_period_id', $current_reporting_period)->pluck('trip_odometer')->sum());
            array_push($km_traveled_last_reporting_period, Refuel::where('truck_id', $truck_id)->where('reporting_period_id', $current_reporting_period[0] - 1)->pluck('trip_odometer')->sum());

        }

        return array(
            "chart" => array(
                "labels" => $licence_plates
            ),
            "datasets" => array(
                array("name" => date('M Y', strtotime('-1 months')), "values" => $km_traveled_last_reporting_period),
                array("name" => date('M Y'), "values" => $km_traveled_this_reporting_period),
            )
        );
    }

    public function PaidTripsChart()
    {
        $months = [];
        $trucks_data = Truck::all('id', 'licence_plate');
        $current_reporting_period = ReportingPeriod::where('year', date('Y'))->where('month', date('m'))->pluck('id')->first();

        for ($i = 5; $i >= 0; $i--) {
            array_push($months, date('M Y', strtotime('-' . $i . ' months')));
        }

        $chart = array(
            "chart" => array(
                "labels" => $months
            ),
            "datasets" => array()
        );

        foreach ($trucks_data as $truck_data) {
            $data = [];

            for ($i = $current_reporting_period - 5; $i <= $current_reporting_period; $i++) {
                $paid_trip = PaidTrip::where('truck_id', $truck_data->id)
                    ->where('reporting_period_id', $i)
                    ->pluck('distance')
                    ->sum();
                array_push($data, $paid_trip);
            }
            array_push($chart['datasets'], (array('name' => $truck_data->licence_plate, 'values' => $data)));
        }

        return $chart;
    }
}
