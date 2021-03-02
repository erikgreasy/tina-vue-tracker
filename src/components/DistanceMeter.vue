<template>
  <div id="tracking">
      <div>
          speed: <span class="speed">{{ this.speed }}</span>
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
        //   enableHighAccuracy: true,
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
        this.positions.push({
            lat: position.coords.latitude,
            long: position.coords.longitude
        })

        if( position.coords.speed ) {

            this.speed = position.coords.speed;
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