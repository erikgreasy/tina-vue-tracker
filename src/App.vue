<template>
    <div id="app">
        <div id="tracking">
            <Clock />

            <Speedometer :speed="this.speed"/>
            <Distance-meter :distance="this.distance"/>


            <button @click="this.trackPosition">Track</button>
            <button @click="this.stopTracking">Stop tracking</button>

            <!-- {{ positions }} -->
            <button @click="makeRequest">Request</button>
            <div class="request-output"></div>
        </div>
    </div>
</template>

<script>
import Speedometer from './components/Speedometer.vue';
import Clock from './components/Clock.vue';
import DistanceMeter from './components/DistanceMeter.vue';
const axios = require('axios').default;

export default {
    name: 'App',
    components: {
        Clock,
        DistanceMeter,
        Speedometer
    },
    methods: {
        stopTracking() {
            navigator.geolocation.clearWatch(this.trackId);
            alert('tracking stopped');
        },
        makeRequest() {
            axios.post('handle.php')
                .then((res)=>{
                    console.log(res.data)
                }) 
                .catch(err=>{

                        alert(err)
                })
        },
        trackPosition() {
            if (navigator.geolocation) {
                this.trackId = navigator.geolocation.watchPosition(this.successPosition, this.failurePosition, {
                enableHighAccuracy: true,
                timeout: 15000,
                maximumAge: 0,
                })
            } else {
                alert(`Browser doesn't support Geolocation`)
            }
        },

        successPosition: function(position) {
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
            timePassed: 0,
            trackId: null,
        }
    },
    mounted() {
        // this.trackPosition()
        
    },
}
</script>

<style>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
}
</style>
