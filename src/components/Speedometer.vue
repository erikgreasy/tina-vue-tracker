<template>
    <div>
        speed: <span class="speed">{{ speed }}</span>kmh
    </div>
</template>

<script>
export default {
    
  name: 'Speedometer',
  props: ['speed']
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .speed {
        font-size: 50px;
    }
</style>
