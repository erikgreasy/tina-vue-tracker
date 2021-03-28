<template>
    <div>
        <h1>Past trips:</h1>
        <ul v-for="trip in trips" :key="trip.id">
            <li>
                <router-link :to="{ name: 'SingleTrip', params: {id: trip.id} }">{{ trip.start_time }}</router-link>
            </li>
        </ul>
    </div>
</template>

<script>
const axios = require('axios').default;

export default {
    data() {
        return {
            trips: []
        }
    },
    created() {
        axios.get('all_trips.php')
        .then(res => {
            this.trips = res.data;
        })
        .catch(err => {
            console.log(err)
        })
    }
    
}
</script>