<template>
  <div id="app">
    <!-- <img alt="Vue logo" src="./assets/logo.png"> -->
    <!-- <HelloWorld msg="Welcome to Your Vue.js App"/> -->
    <!-- <Speedometer /> -->
    <Clock />
    <Distance-meter />
  </div>
</template>

<script>
// import HelloWorld from './components/HelloWorld.vue'
// import Speedometer from './components/Speedometer.vue';
import Clock from './components/Clock.vue';
import DistanceMeter from './components/DistanceMeter.vue';

export default {
  name: 'App',
  components: {
    // Speedometer,
    Clock,
    DistanceMeter
  }
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
