<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Truck extends Model
{
    use SoftDeletes;

    protected $fillable = ['brand', 'model', 'production_year', 'horse_power', 'odometer', 'licence_plate', 'vin', 'emission_class'];

    public function emissionClass()
    {
        return $this->belongsTo(EmissionClass::class, 'emission_class');
    }

    public static function truckStats($id)
    {
        $refuels = Refuel::where('truck_id', $id)->get();

        $paid_trips = PaidTrip::where('truck_id', $id)->get();

        $stats['total_quantity'] = 0;
        $stats['total_mileage'] = 0;
        $stats['total_paid_trips'] = 0;
        $stats['average_price_per_km'] = 0;
        $stats['average_price_per_liter'] = 0;
        foreach ($refuels as $refuel) {
            $stats['total_quantity'] += intval($refuel->quantity);
            $stats['total_mileage'] += intval($refuel->trip_odometer);
            $stats['average_price_per_liter'] += (intval($refuel->price) / intval($refuel->quantity));

        };
        foreach ($paid_trips as $paid_trip) {
            $stats['total_paid_trips'] += intval($paid_trip->distance);
            $stats['average_price_per_km'] += floatval($paid_trip->price_per_km);
        }
        if ($refuels->count() > 0) {
            $stats['average_price_per_liter'] = $stats['average_price_per_liter'] / $refuels->count();
        }

        if ($paid_trips->count() > 0) {
            $stats['average_price_per_km'] = $stats['average_price_per_km'] / $paid_trips->count();
        }

        return $stats;
    }
}
