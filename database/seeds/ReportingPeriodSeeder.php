<?php

use App\Models\ReportingPeriod;
use Illuminate\Database\Seeder;

class ReportingPeriodSeeder extends Seeder
{
    private const STARTING_YEAR = 2020;
    private const NUMBER_OF_YEARS = 20;
    private const NUMBER_OF_MONTHS = 12;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reporting_periods = [];

        for ($i = 0; $i < self::NUMBER_OF_YEARS; $i++) {
            for ($current_month = 1; $current_month <= self::NUMBER_OF_MONTHS; $current_month++) {

                $reporting_periods[] = [
                    'year' => self::STARTING_YEAR + $i,
                    'month' => $current_month];
            }
        }

        ReportingPeriod::insert($reporting_periods);
    }
}
