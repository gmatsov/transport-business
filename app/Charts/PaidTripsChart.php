<?php

declare(strict_types=1);

namespace App\Charts;

use App\Models\PaidTrip;
use App\Models\Refuel;
use App\Models\ReportingPeriod;
use App\Models\Truck;
use Chartisan\PHP\Chartisan;
use Chartisan\PHP\DatasetData;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaidTripsChart extends BaseChart
{
    /**
     * Determines the chart name to be used on the
     * route. If null, the name will be a snake_case
     * version of the class name.
     */
    public ?string $name = 'paid_trips_chart';

    /**
     * Determines the name suffix of the chart route.
     * This will also be used to get the chart URL
     * from the blade directrive. If null, the chart
     * name will be used.
     */
    public ?string $routeName = 'paid_trips_chart';

    /**
     * Determines the prefix that will be used by the chart
     * endpoint.
     */
//    public ?string $prefix = 'some_prefix';

    /**
     * Determines the middlewares that will be applied
     * to the chart endpoint.
     */
    public ?array $middlewares = ['auth'];

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $months = [];
        $trucks_data = Truck::all('id', 'licence_plate');
        $current_reporting_period = ReportingPeriod::where('year', date('Y'))->where('month', date('m'))->pluck('id')->first();

        for ($i = 5; $i >= 0; $i--) {
            array_push($months, date('M Y', strtotime('-' . $i . ' months')));
        }

        $chart = Chartisan::build()
            ->labels($months);

        foreach ($trucks_data as $truck_data) {
            $data = [];

            for ($i = $current_reporting_period - 5; $i <= $current_reporting_period; $i++) {
                $paid_trip = PaidTrip::where('truck_id', $truck_data->id)
                    ->where('reporting_period_id', $i)
                    ->pluck('distance')
                    ->sum();
                array_push($data, $paid_trip);
            }
            $chart->dataset($truck_data->licence_plate, $data);
        }
        return $chart;
    }
}
