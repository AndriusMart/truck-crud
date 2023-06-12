<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TruckSubunit extends Model
{
    protected $table = 'truck_subunits';

    protected $fillable = [
        'main_truck_id',
        'subunit_truck_id',
        'start_date',
        'end_date',
    ];

    public function mainTruck()
    {
        return $this->belongsTo(Truck::class, 'main_truck_id', 'id');
    }
    public function subTruck()
    {
        return $this->belongsTo(Truck::class, 'subunit_truck_id', 'id');
    }
}
