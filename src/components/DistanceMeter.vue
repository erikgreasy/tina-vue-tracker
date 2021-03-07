<template>
  <div id="tracking">
      <div>
          speed: <span class="speed">{{ this.speed }}</span>kmh
      </div>
      <div>
          Distance: <span class="distance">{{ this.distance }}</span>km
      </div>
      <div>
        <!-- distance: {{ this.distance }} -->
      </div>
      {{ positions }}
  </div>
</template>
<script>

export default {
//   components: {
//     'DistanceMeter'
//   },
  methods: {
    trackPosition() {
      if (navigator.geolocation) {
        navigator.geolocation.watchPosition(this.successPosition, this.failurePosition, {
          enableHighAccuracy: true,
          timeout: 15000,
          maximumAge: 0,
        })
      } else {
        alert(`Browser doesn't support Geolocation`)
      }
    },
    successPosition: function(position) {
        // console.log( 'change of watch position' )
        console.log( position.coords )
        


        if( this.positions.length > 0 ) {
          var lastCoords = this.positions.pop();
          this.distance += this.countDistance( lastCoords.lat, lastCoords.long, position.coords.latitude, position.coords.longitude )
        }


        this.positions.push({
            lat: position.coords.latitude,
            long: position.coords.longitude
        })
        if( position.coords.speed ) {

            this.speed = parseFloat( position.coords.speed*18/5 ).toFixed(2);
        } else {
            this.speed = 0
        }
        // this.speed = position.
    //   this.positions.push({
    //     lat: position.coords.latitude,
    //     lng: position.coords.longitude,
    //   })
    //   this.centerPosition = {lat: position.coords.latitude, lng: position.coords.longitude}
    },
    failurePosition: function(err) {
      alert('Error Code: ' + err.code + ' Error Message: ' + err.message)
    },
    degreesToRadians(degrees) {
      return degrees * Math.PI / 180;
    },

    countDistance(lat1, lon1, lat2, lon2) {
      var earthRadiusKm = 6371;
      var dLat = this.degreesToRadians(lat2-lat1);
      var dLon = this.degreesToRadians(lon2-lon1);

      lat1 = this.degreesToRadians(lat1);
      lat2 = this.degreesToRadians(lat2);

      var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
              Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2); 
      var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
      return earthRadiusKm * c;
    }
  },
  computed: {},
  data() {
      return {

          positions: [],
          speed: 0,
          distance: 0,
      }
    // centerPosition: {
    //   lat: 10.762622,
    //   lng: 106.660172,
    // },
    // lat: 0,
    // long: 0,
    // zoom: 16,
    // positions: [],
  },
  mounted() {
    this.trackPosition()
  },
}
</script>

<style scoped>
  .speed {
    font-size: 50px;
  }
</style>