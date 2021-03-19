<?php

namespace App\Http\Controllers;

use App\Models\Locations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Location;

class LocationModelController extends Controller
{

    public function saveLocation(Request $request, string $busId){

        if(!preg_match("/[0-9]/", $busId)) return AppHelper::error('Invalid request');

        if(!$request->hasAny(['latitude', 'longitude', 'street'])) return AppHelper::error("Incomplete request");

        $currentLocation = [
            'bus_id' => $busId,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'street' => $request->street
        ];

        $mLocation = Locations::all()
                                    ->where('bus_id', $busId);

            if($mLocation->count() > 1){

                // Delete Previous Record
                if(DB::table('locations')
                                            ->where('bus_id', $busId)
                                            ->delete()){

                    $this->save($currentLocation);

                }else{

                    return AppHelper::error("Unable to save current location");

                }

            }else{

                $this->save($currentLocation);

            }


    }

    public function positions(Request $request){

        $mLocations = Locations::all();

        if($mLocations->count() == 0) return AppHelper::error("No Buses Moving Yet");

        return response()->json($this->processLocations($mLocations->toArray()));

    }

    public function positionAlone(Request $request, $busNumber){

        if(preg_match("/[0-9]/", $busNumber)) return AppHelper::error("Invalid Request");

        $mLocation = Locations::all()
                                    ->where('bus_id', $busNumber);

        if($mLocation->count() != 1) return AppHelper::error("Bus Was Not Found!");

        return response()->json($this->processLocations($mLocation->toArray()));

    }

    private function save(array $location){

        $mLocation = new Locations($location);

        if($mLocation->save()){

            /* Event Will Be Added Here */

            /* Return successful */
            return response()->json([
                'error' => false,
                'message' => 'location saved'
            ]);

        }else{

            return AppHelper::error("Location Saved!");

        }

    }

    public function processLocations(array $locations){

        $resp['message'] = "Buses found";
        $resp['error']   = false;

        foreach ($locations as $location){

            $resp['bus'][] = $this->modelLocations(new Locations($location));

        }

        return $resp;

    }

    public function modelLocations(Locations $location){

        return [

            'bus'   => (new BusModelController())->busModeller($location->bus_id),
            'position' => [
                'latitude' => $location->latitude,
                'longitude'=> $location->longitude,
                'street'   => $location->street
            ]

        ];

    }

}
