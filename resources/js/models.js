

class BusModel{

  constructor(args) {

    if(args.toString() == 0){
      return
    }

    this.bus = {
      busId : args.bus.bus_id,
      busNum : args.bus.bus_number,
    }

    this.position = {
      latitude : args.position.latitude,
      longitude : args.position.longitude,
      street : args.position.street
    }

  }

}
