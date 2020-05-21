<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refuel extends Model
{
    protected $fillable = ['date', 'quantity', 'price', 'current_odometer', 'trip_odometer', 'truck_id', 'note', 'reporting_period_id'];
}
