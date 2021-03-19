<?php

namespace App\Http\Controllers;

use App\Models\Locations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

}
