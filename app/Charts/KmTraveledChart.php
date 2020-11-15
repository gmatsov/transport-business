<?php

namespace App\Charts;

use App\Models\Refuel;
use App\Models\ReportingPeriod;
use App\Models\Truck;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class KmTraveledChart extends BaseChart
{

    /**
     * Determines the chart name to be used on the
     * route. If null, the name will be a snake_case
     * version of the class name.
     */
    public ?string $name = 'km_traveled_chart';

    /**
     * Determines the name suffix of the chart route.
     * This will also be used to get the chart URL
     * from the blade directrive. If null, the chart
     * name will be used.
     */
    public ?string $routeName = 'km_traveled_chart';

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
        $licence_plates = Truck::all('licence_plate')->pluck('licence_plate')->toArray();
        $trucks_id = Truck::all('id')->toArray();
        $km_traveled_this_reporting_period = [];
        $km_traveled_last_reporting_period = [];
        $current_reporting_period = ReportingPeriod::where('year', date('Y'))->where('month', date('m'))->pluck('id')->toArray();

        foreach ($trucks_id as $truck_id) {
            array_push($km_traveled_this_reporting_period, Refuel::where('truck_id', $truck_id)->where('reporting_period_id', $current_reporting_period)->pluck('trip_odometer')->sum());
            array_push($km_traveled_last_reporting_period, Refuel::where('truck_id', $truck_id)->where('reporting_period_id', $current_reporting_period[0] - 1)->pluck('trip_odometer')->sum());

        }

        return Chartisan::build()
            ->labels($licence_plates)
            ->dataset(date('M Y', strtotime('-1 months')), $km_traveled_last_reporting_period)
            ->dataset(date('M Y'), $km_traveled_this_reporting_period);

    }
}
