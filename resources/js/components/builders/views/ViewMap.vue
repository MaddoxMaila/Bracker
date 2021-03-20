<template>

	<div class="map-wrapper">
		
		<div class="mapper" id="mapper">
  

    </div>

    <div class="navbar fixed-bottom bg-white">
      
      <center>
        
        <button class="btn btn-primary btn-large"></button>

      </center>

    </div>

	</div>

</template>

<script>

   import axios from 'axios'

    export default {
      name: "ViewMap",
      data : () => ({
        map : null,
        BUSES : [],
        messages : '',
        error : false
      }),
      methods : {
        /*Function : function(){

        }*/
        initMap : async function(){

          console.log(await this.mapper)

          this.map = new google.maps.Map(await this.mapper ,{

            center : this.position,
            minZoom : 3,
            maxZoom : 16,
            zoom : 14

          })

          google.maps.event.trigger(this.map, 'resize')

        },
        getInitLocations : function(){
          
          axios.get('/api/locations/positions').then( resp => {
            
            let data = resp.data

            if(data.error){
              console.log(data.error)
            }else{

              console.log(data)

              data.buses.forEach(bus => {

                 let marker = new google.maps.Marker({
                  position: new google.maps.LatLng(bus.position.latitude, bus.position.longitude), 
                  title: bus.bus.bus_number
                  })

                 marker.setMap(this.map)

              })

            }

          });

        },
        realTimeLocations : function(){

          // this.getInitLocations()

          console.log(window.Echo)

          window.Echo
            .channel(`bus-locations`)
            .listen('.locations', data => {

              console.log(data)
                if(data.error){


                }else{

                    if(data.buses.length > 0){

                      data.buses.forEach(bus => {

                        console.log(bus)

                      })

                    }

                }

            })

        }

      },
      computed : {
      	mapper : async function(){
          let MAP = await document.getElementById('mapper')
      		 return MAP
      	},
        position : function(){
          return new google.maps.LatLng(-25.6975497, 28.1590786)  
        }
      },
      mounted : function(){

        setTimeout(() => {

          this.initMap()

          this.getInitLocations();

        },5000)

      }

    };
</script>

<style scoped>

  .mapper{
    height: 600px;
    width: 100%;
    overflow-x: hidden;
    position: fixed;
    bottom: 0;
    left: 0;
    top: 50px;
    right: 0;
  }

  .navbar{

    height: 50px;

  }

</style>



<!-- <google-map id="map" ref="Map">
        
        <google-map-marker
          
          :position="position"
          :visible="true"
          :zIndex="9999"
          
        />

        <google-map-infowindow
          :position="position"
          :show.sync="true"
          :options="{maxWidth: 300}"
      >
        
      </google-map-infowindow>

      </google-map> -->