<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    use HasFactory;

    protected $table = "locations"
    protected $primaryKey = 'location_id';
    protected $fillable = [
    	'bus_id', 'latitude', 'longitude', 'street', 'location_id'
    ];

   public $timestamps = false;

}
