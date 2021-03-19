<?php

namespace App\Http\Controllers;

use App\Models\Buses;
use Illuminate\Http\Request;

class BusModelController extends Controller
{

    /*public function add(Request $request){



    }*/



    public function busModeller($id){

        $mBus = Buses::all()->where('bus_id', $id);

        if($mBus->count() == 0) return [];

        $mBus = $mBus->first();

        return [
          'bus_id' => $mBus->bus_id,
          'bus_plate' => $mBus->bus_plate,
          'bus_number' => $mBus->bus_number
        ];

    }

}
