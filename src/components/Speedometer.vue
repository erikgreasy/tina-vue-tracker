<template>
    <div>
        long: {{ long }}
        <br>
        lat: {{ lat }}
        <br>
        <button @click="getLocation">Get location</button>
    </div>
</template>

<script>
export default {
    
  name: 'Speedometer',
  data() {
      return {
          speed: 20,
          long: 0,
          lat: 0
      }
  },
    methods: {
        error() {
            alert( 'Unable to retrieve your location' );
        },
        success(position) {
            const latitude  = position.coords.latitude;
            const longitude = position.coords.longitude;

            this.long = longitude;
            this.lat = latitude;
        },
        getLocation() {
            if(!navigator.geolocation) {
                    status.textContent = 'Geolocation is not supported by your browser';
                } else {
                    // status.textContent = 'Locating…';
                    navigator.geolocation.getCurrentPosition(this.success, this.error);
                }
        }
  },
  props: {
    // msg: String
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
