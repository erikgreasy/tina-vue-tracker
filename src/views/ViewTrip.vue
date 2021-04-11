<template>
    <div>
        <h1 class="text-center">Trip {{ trip.created_at }}</h1>
        <div id="graph"></div>

        <div>
        </div>
        
    </div>
</template>

<script>
import Plotly from 'plotly.js-dist';
import db from '../firebaseinit';
import dbEngine from '../dbConfig';

const axios = require('axios').default;


export default {
    components: {
       
    },
    data() {
        return {
            trip: {created_at: ''},
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
    mounted() {
        if( dbEngine.dbEngine == 'firebase') {
            db.ref('trips/' + this.$route.params.id).get()
                .then(snap => {
                    this.trip = snap.val();
                    this.trip.logs = Object.values( this.trip.logs );
                    console.log(this.trip)
                    this.trip.logs.forEach(log => {
                        // console.log(log)
                        this.distance.x.push(log.timepassed);
                        this.speed.x.push(log.timepassed);

                        this.distance.y.push(log.distance);
                        this.speed.y.push(log.speed);
                    })

                    this.graphEl = document.getElementById('graph');
                    console.log(this.distance)
                    Plotly.newPlot( this.graphEl, [this.distance, this.speed], {
                        margin: { t: 0 } } );
                })
                .catch(err => {
                    console.log(err)
                })
        } else {

            axios.get('https://tinaapi.greasydesign.sk/api/trip/' + this.$route.params.id)
            .then(res => {
                this.trip = res.data;
    
                this.trip.logs.forEach(log => {
                    this.distance.x.push(log.timepassed);
                    this.speed.x.push(log.timepassed);
    
                    this.distance.y.push(log.distance);
                    this.speed.y.push(log.speed);
                });
    
    
                this.graphEl = document.getElementById('graph');
                console.log(this.distance)
                Plotly.newPlot( this.graphEl, [this.distance, this.speed], {
                    margin: { t: 0 } } );
    
            })
            .catch(err => {
                console.log(err)
            })
        }



    },



}
</script>