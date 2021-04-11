<template>
    <div class="row">
        <div class="col-sm-12 offset-lg-2 col-lg-8 text-center">

            <h1>Track your trip</h1>
            <div id="tracking" class="row">

                <div class="col-12">
                    <Clock :timePassed="this.timePassed" />
                </div>

                <div class="col-6">
                    <Speedometer :speed="this.speed"/>
                </div>

                <div class="col-6">
                    <Distance-meter :distance="this.distance"/>
                </div>

                <button @click="this.trackPosition" id="track" class="btn btn-info btn-block">Track</button>
                <button @click="this.stopTracking" id="stop" class="btn btn-danger btn-block">Stop tracking</button>

            </div>

        </div>

    </div>
</template>


<script>
import Speedometer from './../components/Speedometer.vue';
import Clock from './../components/Clock.vue';
import DistanceMeter from './../components/DistanceMeter.vue';
import db from '../firebaseinit';

const axios = require('axios').default;


export default {
    name: 'App',
    components: {
        Clock,
        DistanceMeter,
        Speedometer,
    },
    data() {
        return {

            positions: [],
            speed: 0,
            distance: 0,
            timePassed: 0,
            trackId: null,
            tripId: null,
            intervalId: null,
        }
    },
    methods: {
        stopTracking() {
            navigator.geolocation.clearWatch(this.trackId);
            clearInterval(this.intervalId);
            axios.post('add_log.php', {
                    trip_id: this.tripId,
                    speed: this.speed,
                    distance: this.distance,
                    timepassed: this.timePassed
                })
                .then(res => {
                    console.log(res)
                })
                .catch(err => {
                    console.log(err)
                })
            db.ref('trips/' + this.tripId + '/logs').push({
                speed: this.speed,
                distance: this.distance,
                timePassed: this.timePassed,
            });

            document.querySelector( '#stop' ).classList = 'd-none';

            window.location.href = window.location.origin + '/single/' + this.tripId;

        },
        trackPosition() {
            if (navigator.geolocation) {
                axios.post('add_trip.php')
                .then(res => {
                    if( res ) {
                        this.tripId = res.data
                        this.trackId = navigator.geolocation.watchPosition(this.successPosition, this.failurePosition, {
                            enableHighAccuracy: true,
                            timeout: 15000,
                            maximumAge: 0,
                        })
                        db.ref('trips/' + this.tripId).set({
                            start_time: new Date().getTime(),
                        });
                    }
                })
                .catch(err => {
                    console.log(err)
                })
                
                

                let self = this;
                this.intervalId = setInterval(function() {
                    self.timePassed += 1;
                    // console.log(self.timePassed)
                }, 1000)

                
            } else {
                alert(`Browser doesn't support Geolocation`)
            }

            document.querySelector( '#track' ).classList.add('d-none');
            document.querySelector( '#stop' ).classList.add('d-block');

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

         
            axios.post('add_log.php', {
                    trip_id: this.tripId,
                    speed: this.speed,
                    distance: this.distance,
                    timepassed: this.timePassed
                })
                .then(res => {
                    console.log(res)
                })
                .catch(err => {
                    console.log(err)
                })


            db.ref('trips/' + this.tripId + '/logs').push({
                speed: this.speed,
                distance: this.distance,
                timePassed: this.timePassed,
            });
            
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
    
    mounted() {

     

    },
}
</script>

<style scoped>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
}

#stop {
    display: none;
}
</style>
