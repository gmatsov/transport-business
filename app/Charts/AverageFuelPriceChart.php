<?php

declare(strict_types=1);

namespace App\Charts;

use App\Models\ReportingPeriod;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AverageFuelPriceChart extends BaseChart
{

    public ?string $name = 'avg_fuel_price_chart';
    public ?string $routeName = 'avg_fuel_price_chart';
    public ?array $middlewares = ['auth'];

    public static function __set_state(array $array)
    {
    }

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $months = [];
        $data = [];
        $current_reporting_period = ReportingPeriod::where('year', date('Y'))->where('month', date('m'))->pluck('id')->first();

        for ($i = 11; $i >= 0; $i--) {
            array_push($months, date('M Y', strtotime('-' . $i . ' months')));
        }

        $chart = Chartisan::build()
            ->labels($months);
        for ($i = $current_reporting_period - 11; $i <= $current_reporting_period; $i++) {
            $avg_fuel_price = DB::select(
                'SELECT ROUND((SUM(refuels.quantity)/ SUM(refuels.price)),2) AS avg_fuel_price FROM refuels WHERE refuels.reporting_period_id =' . $i)[0]->avg_fuel_price;
            array_push($data, $avg_fuel_price);
        }

        $chart->dataset('Цена в Евро', $data);

        return $chart;
    }
}
