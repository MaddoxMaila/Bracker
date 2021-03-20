<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\LocationModelController;
use App\Http\Controllers\AppHelper;
use App\Models\Locations;

class LocationsEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('bus-locations');
    }

    public function broadcastAs(){
        return 'locations';
    }

    public function broadcastWith(){

        $mLocations = Locations::all();

        if($mLocations->count() == 0) return AppHelper::error("No Buses");

        return (new LocationModelController())->processLocations($mLocations->toArray());

    }
}
