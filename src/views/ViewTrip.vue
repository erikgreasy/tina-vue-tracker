<template>
    <div>
        <h1>Trip {{ trip.start_time }}</h1>
        <div>
            Total time:
            <Clock :timePassed="this.timePassed" />


        </div>
        <div>
            Average speed:
            <Speedometer :speed="this.trip.avg_speed"/>
        </div>

        <div>
            <Distance-meter :distance="this.distance" :getgraph="this.graph" />
        </div>
        
    </div>
</template>

<script>
import Speedometer from './../components/Speedometer.vue';
import DistanceMeter from './../components/DistanceMeter.vue';
import Clock from './../components/Clock.vue';


const axios = require('axios').default;

export default {
    components: {
        Speedometer,
        DistanceMeter,
        Clock
    },
    data() {
        return {
            trip: {start_time: ''},
            distance: 0,
            timePassed: null,
            graph: {
                x: [0],
                y: [0]
            },
            x: 1
        }
    },
    created() {
        axios.get('/get_trip.php?id=' + this.$route.params.id)
        .then(res => {
            console.log('got rsponse')
            this.trip = res.data.trip;
            this.timePassed = parseInt(res.data.trip.time_passed)
            let distance = res.data.distance;
            
            distance.forEach(dis => {
                // this.distance = parseInt(dis.distance);
                this.graph.x.push(this.x);
                this.x += 1;

                this.graph.y.push( parseInt(dis.distance) );
            });
        })
        .catch(err => {
            console.log(err)
        })


    }


}
</script>