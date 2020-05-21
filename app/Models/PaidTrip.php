<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaidTrip extends Model
{
    protected $fillable = ['truck_id', 'reporting_period_id', 'date', 'distance', 'price_per_km'];

    public function reportingPeriod()
    {
        return $this->belongsTo(ReportingPeriod::class, 'reporting_period_id');
    }
}
