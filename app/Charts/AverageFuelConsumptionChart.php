<?php

declare(strict_types=1);

namespace App\Charts;

use App\Models\Refuel;
use App\Models\ReportingPeriod;
use App\Models\Truck;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AverageFuelConsumptionChart extends BaseChart
{

    public ?string $name = 'avg_fuel_consumption_chart';
    public ?string $routeName = 'avg_fuel_consumption_chart';
    public ?array $middlewares = ['auth'];

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $months = [];
        $trucks_data = Truck::all('id','licence_plate');
        $current_reporting_period = ReportingPeriod::where('year', date('Y'))->where('month', date('m'))->pluck('id')->first();

        for ($i = 5; $i >= 0; $i--) {
            array_push($months, date('M Y', strtotime('-' . $i . ' months')));
        }

        $chart = Chartisan::build()
            ->labels($months);

        foreach ($trucks_data as $truck_data) {
            $data = [];

            for ($i = $current_reporting_period - 5; $i <= $current_reporting_period; $i++) {
                $avg_fuel_cons = DB::select(
                    'SELECT ROUND((SUM(refuels.quantity) / SUM(refuels.trip_odometer))* 100,2) as avg_fuel_consumption
                        FROM refuels
                        WHERE refuels.truck_id = ' . $truck_data->id .
                    ' AND refuels.reporting_period_id = ' . $i . ' ')[0]->avg_fuel_consumption;
                array_push($data, $avg_fuel_cons);
            }

            $chart->dataset($truck_data->licence_plate, $data);
        }
        return $chart;
    }
}
