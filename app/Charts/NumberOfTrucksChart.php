<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Truck;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class NumberOfTrucksChart extends BaseChart
{

    public ?string $name = 'number_of_trucks_chart';
    public ?string $routeName = 'number_of_trucks_chart';
    public ?array $middlewares = ['auth'];

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $number_of_trucks = Truck::all()->count();


        return Chartisan::build()
            ->labels([$number_of_trucks])
            ->dataset('Брой камиони', [$number_of_trucks]);
    }
}
