<?php

namespace App\Services;

use App\Models\PaidTrip;
use App\Models\Parking;
use App\Models\Refuel;
use App\Models\ReportingPeriod;
use App\Models\Truck;
use Illuminate\Support\Facades\DB;

class ReportService
{
    private $truck_id;
    private $month;
    private $year;
    private $km_traveled;
    private $paid_km_traveled;
    private $km_difference;
    private $fuel_consumption;
    private $parking;
    private int $reporting_period_id;

    public function __construct($data)
    {
        $this->truck_id = $data['truck_id'];
        $this->month = $data['month'];
        $this->year = $data['year'];
        $this->km_traveled = $data['km_traveled'];
        $this->paid_km_traveled = $data['paid_km_traveled'];
        $this->km_difference = $data['km_difference'];
        $this->fuel_consumption = $data['fuel_consumption'];
        $this->reporting_period_id = $this->getReportingPeriodId();
        $this->parking = $data['parking'];
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

        if ($this->parking) {
            $result->parking = $this->getParkingData();
        }
        $result->month = $this->month;
        $result->year = $this->year;
        return $result;

    }

    private function getParkingData()
    {
        return Parking::where('truck_id', $this->truck_id)
            ->where('reporting_period_id', $this->reporting_period_id)
            ->pluck('price')
            ->sum();
    }

    private function getPaidKm()
    {
        return PaidTrip::where('truck_id', $this->truck_id)
            ->where('reporting_period_id', $this->reporting_period_id)
            ->pluck('distance')
            ->sum();
    }

    private function paidAmount()
    {
        $paid_mount = DB::select(
            'SELECT sum(distance*price_per_km) as paid_amount FROM paid_trips
                    WHERE truck_id = 1 AND reporting_period_id = 11'
        );

        return $paid_mount[0]->paid_amount;
    }

    private function detailedPaidKm()
    {
        return DB::select(
            'SELECT price_per_km, SUM(distance) AS total_distance FROM paid_trips
                    WHERE truck_id = 1 AND reporting_period_id = 11
                    GROUP BY price_per_km'
        );
    }

    private function getTraveledKm()
    {
        return Refuel::where('truck_id', $this->truck_id)
            ->where('reporting_period_id', $this->reporting_period_id)
            ->pluck('trip_odometer')
            ->sum();
    }

    private function getUsedQuantity()
    {
        return Refuel::where('truck_id', $this->truck_id)
            ->where('reporting_period_id', $this->reporting_period_id)
            ->pluck('quantity')
            ->sum();
    }

    private function getFuelConsumption()
    {
        return number_format(((float)$this->getUsedQuantity() * 100) / $this->getTraveledKm(), 2, '.', ' ');
    }

    private function getReportingPeriodId(): int
    {
        return ReportingPeriod::where('month', $this->month)->where('year', $this->year)->first()->id;
    }
}
