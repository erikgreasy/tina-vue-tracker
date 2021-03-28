<template>
    <div>
        Distance: <span class="distance">{{ distance }}</span>km
        <div id="tester" style="width:600px;height:250px;"></div>
        {{getgraph}}
    </div>
</template>
<script>
import Plotly from 'plotly.js-dist';

export default {
    name: 'DistanceMeter',
    props: ['distance', 'getgraph'],
    watch: {
        distance: function(newVal, oldVal) {
            console.log(`New: ${newVal}, old: ${oldVal}`);
            this.graph.x.push(this.x)
            this.graph.y.push(newVal)
            this.x++;
            // alert(this.graph.y)
            Plotly.redraw(this.TESTER)
        }
    },
    data() {
        return {
            graph: {
                x: [0],
                y: [0]
            },
            TESTER: null,
            x: 1
        }
    },
    mounted() {
        this.TESTER = document.getElementById('tester')
        
            Plotly.newPlot( this.TESTER, [this.graph], {
                margin: { t: 0 } } );
    },
    updated() {
        if( this.getgraph != null ) {

            Plotly.newPlot( this.TESTER, [this.getgraph], {
                margin: { t: 0 } } );
        }
    }
}
</script>

<style scoped>
  
</style>