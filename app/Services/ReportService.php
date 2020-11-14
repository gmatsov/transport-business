<?php

namespace App\Services;

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
    private $reporting_period_id;

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
    }

    public function create(): object
    {
        $query = $this->getSelects();
        $query = $this->getJoins($query);
        $query = $this->getWheres($query);
        $query = $this->getGroups($query);

        $result = DB::select($query);

        if (empty($result)) {
            $result = new \stdClass();
            $result->licence_plate = Truck::where('id', $this->truck_id)->pluck('licence_plate')->first();
        } else {
            $result = $result[0];

        }
        if ($this->km_difference) {
            $result->km_difference = $result->km_traveled - $result->paid_trip_km_traveled;
        }

        $result->month = $this->month;
        $result->year = $this->year;
        return $result;
    }

    private function getReportingPeriodId(): int
    {
        return ReportingPeriod::where('month', $this->month)->where('year', $this->year)->first()->id;
    }

    private function getSelects(): string
    {

        $select = 'SELECT trucks.licence_plate';

        if ($this->km_traveled) {
            $select .= ', SUM(refuels.trip_odometer) AS km_traveled ';
        }

        if ($this->paid_km_traveled) {
            $select .= ', SUM(paid_trips.distance) AS paid_trip_km_traveled ';
        }



        if ($this->fuel_consumption) {
            $select .= ', ';
        }


        $select .= ' FROM trucks';

        return $select;
    }

    private function getJoins(string $query): string
    {
        if ($this->km_traveled) {
            $query .= ' JOIN refuels ON trucks.id = refuels.truck_id';
        }

        if ($this->paid_km_traveled) {
            $query .= ' JOIN paid_trips ON trucks.id = paid_trips.truck_id ';
        }



        if ($this->fuel_consumption) {
            $query .= ', ';
        }


        return $query;
    }

    private function getWheres(string $query): string
    {
        $query .= ' WHERE trucks.id = ' . $this->truck_id;

        if ($this->km_traveled) {
            $query .= ' AND refuels.reporting_period_id =  ' . $this->reporting_period_id;
        }
        if ($this->paid_km_traveled) {
            $query .= ' AND paid_trips.reporting_period_id =  ' . $this->reporting_period_id;
        }

        return $query;
    }

    private function getGroups(string $query)
    {
        $query .= ' GROUP BY ' . $this->truck_id;

        return $query;
    }
}
