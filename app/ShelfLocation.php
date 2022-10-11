<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShelfLocation extends Model
{
    use HasFactory;

    protected $table = 'shelf_location';

    protected $fillable =[
        "customer_id", "date", "warehouse_id", "location_a", "location_fridge", "location_cd", "payment_status", "status", "document", "note"
    ];

    public function warehouse()
    {
    	return $this->belongsTo('App\Warehouse');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

}
