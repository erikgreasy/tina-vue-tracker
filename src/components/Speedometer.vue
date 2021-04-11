<template>
    <div class="speedometer">
        <v-gauge :value="speed" :decimalPlace="2" :unit="'KM/H'" :width="'300px'" />
    </div>
</template>

<script>
import VGauge from 'vgauge';


export default {
    components: {
        VGauge
    },
    data() {
        return {
            value: 35
        };
    },
    name: 'Speedometer',
    props: ['speed'],
    mounted() {
      

    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style>
.speedometer {
    margin-bottom: 30px;
}
    .speed {
        font-size: 50px;
    }

    .gauge-title {
        font-size: 20px;
        margin: 0 auto;
    }

    .gauge-title span:last-child {
        font-size: 30px;
    }
</style>
