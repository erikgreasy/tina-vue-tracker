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
                name: 'Distance',
                mode: "lines+markers"
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
        if( this.$dbEngine == 'firebase') {
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
                    // console.log(this.distance)
                    // Plotly.newPlot( this.graphEl, [this.distance, this.speed], {
                    //     margin: { t: 0 } } );


                         var layout = { shapes: [{
                                'type': 'line',
                                'x0': 0,
                                'y0': 0,
                                'x1': 10,
                                'y1': .25,
                                'line': {
                                    'color': 'red',
                                    'width': 3,
                                }},
                            ]};
                    var oldData = {};
                    Object.assign(oldData, layout.shapes[0])

                    Plotly.newPlot(this.graphEl, [this.distance, this.speed], layout, {editable: true});
                    this.graphEl.on('plotly_relayout', function(){

                        if(  JSON.stringify(oldData) !== JSON.stringify(layout.shapes[0]) ) {
                            alert( `x0: ${layout.shapes[0].x0}, y0: ${layout.shapes[0].y0}\nx1: ${layout.shapes[0].x1}, y1: ${layout.shapes[0].y1}` );
                            Object.assign(oldData, layout.shapes[0])

                        }

                    });
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
                // console.log(this.distance)
                // Plotly.newPlot( this.graphEl, [this.distance, this.speed], {
                //     margin: { t: 0 } } );

                    // var trace1 = {
                    // x: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                    // y: [10, 15, 13, 17, 9, 12, 13, 15, 10, 9],
                    // mode: 'lines+markers'
                    // };


                    // var data = [ trace1];

                    var layout = { shapes: [{
                                'type': 'line',
                                'x0': 0,
                                'y0': 0,
                                'x1': 10,
                                'y1': .25,
                                'line': {
                                    'color': 'red',
                                    'width': 3,
                                }},
                            ]};
                    var oldData = {};
                    Object.assign(oldData, layout.shapes[0])

                    Plotly.newPlot(this.graphEl, [this.distance, this.speed], layout, {editable: true});
                    this.graphEl.on('plotly_relayout', function(){

                        if(  JSON.stringify(oldData) !== JSON.stringify(layout.shapes[0]) ) {
                            alert( `x0: ${layout.shapes[0].x0}, y0: ${layout.shapes[0].y0}\nx1: ${layout.shapes[0].x1}, y1: ${layout.shapes[0].y1}` );
                            Object.assign(oldData, layout.shapes[0])

                        }

                    });
    
            })
            .catch(err => {
                console.log(err)
            })
        }



    },



}
</script>

<style>
.gtitle.js-placeholder {
    display: none;
}
</style>