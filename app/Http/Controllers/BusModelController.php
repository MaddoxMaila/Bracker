<?php

namespace App\Http\Controllers;

use App\Models\Buses;
use App\Models\Locations;
use App\Http\Controllers\LocationModelController;
use Illuminate\Http\Request;
use App\Http\Controllers\AppHelper;

class BusModelController extends Controller
{

    public function add(Request $request){

      if(!$request->hasAny(['bus_number', 'bus_plate'])) return AppHelper::error("Incomplete request");

      return response()->json($this->saveBus([
        'bus_id'  => null,
        'bus_plate' => $request->bus_plate,
        'bus_number' => $request->bus_number
      ]));

    }

    public function availableBuses(Request $request){

      $mBus = Buses::all();

      if($mBus->count() == 0) return AppHelper::error("No Buses Available");

      return response()->json($this->getAllBuses($mBus->toArray()));

    }

    private function getAllBuses(array $buses){

      $resp = [];

      foreach ($buses as $bus) {

        $mBus = new Buses($bus);

        if(Locations::all()->where('bus_id', $mBus)->count() == 0) continue;

        $resp['buses'][] = [
          'buses' => $this->model($mBus),
          'positions' => (new LocationModelController())->locationByBusId($mBus->bus_id)
        ];

      }

      if(empty($resp)){

        return AppHelper::error("No Buses With Location Found!");

      }else{

        $resp['message'] = "Buses Found";
        $resp['error'] = false;

        return $resp;

      }

    }

    private function saveBus(array $bus){

      $mBus = new Buses($bus);

      if($mBus->save()){

        return [

          'error'   => false,
          'message' => "Bus Saved"

        ];

      }else{

       return AppHelper::error("Bus Not Saved");

      }

    }

    public function busModeller($id){

        $mBus = Buses::all()->where('bus_id', $id);

        if($mBus->count() == 0) return [];

        $mBus = $mBus->first();

        return $this->model($mBus);

    }

    private function model(Buses $bus){

      return [
          'bus_id' => $bus->bus_id,
          'bus_plate' => $bus->bus_plate,
          'bus_number' => $bus->bus_number
        ];

    }

}
