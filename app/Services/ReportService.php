<?php

namespace App\Services;

use App\Models\Cost;
use App\Models\PaidTrip;
use App\Models\Refuel;
use App\Models\ReportingPeriod;
use App\Models\Truck;
use Illuminate\Support\Facades\DB;

class ReportService
{
    private $truck_id;
    private $start_month;
    private $start_year;
    private $end_month;
    private $end_year;
    private $km_traveled;
    private $paid_km_traveled;
    private $km_difference;
    private $fuel_consumption;
    private $costs;
    private int $start_reporting_period_id;
    private int $end_reporting_period_id;

    public function __construct($data)
    {
        $this->truck_id = $data['truck_id'];
        $this->start_month = $data['start_month'];
        $this->start_year = $data['start_year'];
        $this->end_month = $data['end_month'];
        $this->end_year = $data['end_year'];
        $this->km_traveled = $data['km_traveled'];
        $this->paid_km_traveled = $data['paid_km_traveled'];
        $this->km_difference = $data['km_difference'];
        $this->fuel_consumption = $data['fuel_consumption'];
        $this->start_reporting_period_id = $this->getStartReportingPeriodId();
        $this->end_reporting_period_id = $this->getEndReportingPeriodId();
        $this->costs = $data['costs'];
    }

    public function create(): object
    {
        $result = new \stdClass();
        $result->licence_plate = Truck::where('id', $this->truck_id)->pluck('licence_plate')->first();

        if ($this->km_traveled) {
            $result->km_traveled = $this->getTraveledKm();
        }

        if ($this->paid_km_traveled) {
            $result->paid_trip_km_traveled = $this->getPaidKm();
            $result->paid_trip_details = $this->detailedPaidKm();
            $result->paid_amount = $this->paidAmount();
        }

        if ($this->km_difference) {
            $result->km_difference = $this->getTraveledKm() - $this->getPaidKm();
        }

        if ($this->fuel_consumption) {
            $result->fuel_consumption = $this->getFuelConsumption();
        }

        if ($this->costs) {
            $result->costs = $this->getCosts();
        }
        $result->start_month = $this->start_month;
        $result->start_year = $this->start_year;
        $result->end_month = $this->end_month;
        $result->end_year = $this->end_year;

        return $result;
    }

    private function getPaidKm()
    {
        return PaidTrip::where('truck_id', $this->truck_id)
            ->where('reporting_period_id', '>=', $this->start_reporting_period_id)
            ->where('reporting_period_id', '<=', $this->end_reporting_period_id)
            ->pluck('distance')
            ->sum();
    }

    private function paidAmount()
    {
        $paid_mount = DB::select(
            'SELECT sum(distance*price_per_km) as paid_amount FROM paid_trips
                   WHERE truck_id = ' . $this->truck_id . '
                   AND reporting_period_id >= ' . $this->start_reporting_period_id . '
                   AND reporting_period_id <= ' . $this->end_reporting_period_id
        );

        return $paid_mount[0]->paid_amount;
    }

    private function detailedPaidKm()
    {
        return DB::select(
            'SELECT price_per_km, SUM(distance) AS total_distance FROM paid_trips
                    WHERE truck_id = ' . $this->truck_id . '
                    AND reporting_period_id >= ' . $this->start_reporting_period_id . '
                    AND reporting_period_id <=' . $this->end_reporting_period_id . '
                    GROUP BY price_per_km'
        );
    }

    private function getTraveledKm()
    {
        return Refuel::where('truck_id', $this->truck_id)
            ->where('reporting_period_id', '>=', $this->start_reporting_period_id)
            ->where('reporting_period_id', '<=', $this->end_reporting_period_id)
            ->pluck('trip_odometer')
            ->sum();
    }

    private function getUsedQuantity()
    {
        return Refuel::where('truck_id', $this->truck_id)
            ->where('reporting_period_id', '>=', $this->start_reporting_period_id)
            ->where('reporting_period_id', '<=', $this->end_reporting_period_id)
            ->pluck('quantity')
            ->sum();
    }

    private function getFuelConsumption()
    {
        if ($this->getUsedQuantity() == 0) {
            return 0;

        }
        return number_format(((float)$this->getUsedQuantity() * 100) / $this->getTraveledKm(), 2, '.', ' ');
    }

    private function getStartReportingPeriodId(): int
    {
        return ReportingPeriod::where('month', $this->start_month)->where('year', $this->start_year)->first()->id;
    }

    private function getEndReportingPeriodId()
    {
        return ReportingPeriod::where('month', $this->end_month)->where('year', $this->end_year)->first()->id;
    }

    private function getCosts()
    {
        $costs['details'] = Cost::where('truck_id', $this->truck_id)
            ->where('reporting_period_id', $this->start_reporting_period_id)
            ->get();
        $costs['total_sum'] = 0;

        foreach ($costs['details'] as $cost) {
            $costs['total_sum'] += intval($cost->price);
        }

        return $costs;
    }
}
