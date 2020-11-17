<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $fillable = ['truck_id', 'reporting_period_id', 'price', 'note'];

    protected $table = "costs";

    public function reportingPeriod()
    {
        return $this->belongsTo(ReportingPeriod::class, 'reporting_period_id');
    }
    public function truckData()
    {
        return $this->belongsTo(Truck::class, 'truck_id');
    }
}