<template>
    <div>
        <h1 class="text-center">Trip {{ trip.start_time }}</h1>
        <div id="graph"></div>

        <div>
        </div>
        
    </div>
</template>

<script>
import Plotly from 'plotly.js-dist';


const axios = require('axios').default;

export default {
    components: {
       
    },
    data() {
        return {
            trip: {start_time: ''},
            time: [],
            distance: {
                x: [],
                y: [],
                name: 'Distance'
            },
            speed: {
                x: [],
                y: [],
                name: 'Speed'
            },
            graphEl: null
        }
    },
    created() {
        axios.get('/get_trip.php?id=' + this.$route.params.id)
        .then(res => {
            console.log(res.data)
            this.trip = res.data.trip;
            console.log(this.trip);

            res.data.logs.forEach(log => {
                this.distance.x.push(log.timepassed);
                this.speed.x.push(log.timepassed);

                this.distance.y.push(log.distance);
                this.speed.y.push(log.speed);
            });


            this.graphEl = document.getElementById('graph');
        
            Plotly.newPlot( this.graphEl, [this.distance, this.speed], {
                margin: { t: 0 } } );

            console.log(this.time)
            
            // distance.forEach(dis => {
            //     // this.distance = parseInt(dis.distance);
            //     this.graph.x.push(this.x);
            //     this.x += 1;

            //     this.graph.y.push( parseInt(dis.distance) );
            // });
        })
        .catch(err => {
            console.log(err)
        })


    },

    mounted() {
        
    }


}
</script>