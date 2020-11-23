<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $fillable = ['truck_id', 'reporting_period_id', 'price', 'note', 'sub_category_id'];

    protected $table = "costs";

    public function reportingPeriod()
    {
        return $this->belongsTo(ReportingPeriod::class, 'reporting_period_id');
    }

    public function truckData()
    {
        return $this->belongsTo(Truck::class, 'truck_id');
    }

    public function category()
    {
        return $this->belongsTo(CostSubCategory::class, 'sub_category_id');
    }
}
