<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $fillable = ['truck_id', 'title', 'description', 'by_date', 'days_before', 'by_odometer', 'km_before', 'note', 'finished_at'];

    public function truckData()
    {
        return $this->belongsTo(Truck::class, 'truck_id');
    }
}
