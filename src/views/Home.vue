<template>
    <div>
        <h1>Past trips:</h1>
        <ul v-for="(trip, index) in trips" :key="index">
            <li>
                <router-link :to="{ name: 'SingleTrip', params: {id: index} }">{{ trip.created_at }}</router-link>
            </li>
        </ul>
    </div>
</template>

<script>
const axios = require('axios').default;
import db from '../firebaseinit';
import dbEngine from '../dbConfig';


export default {
    data() {
        return {
            trips: []
        }
    },
    created() {

        if( dbEngine.dbEngine == 'firebase' ) {
            db.ref('trips/').get()
                .then(snap => {
                    this.trips = snap.val()
                    console.log(this.trips)
                })
                .catch(err => {
                    console.log(err)
                })
        } else {
            axios.get('https://tinaapi.greasydesign.sk/api/trips')
            .then(res => {
                this.trips = res.data;
            })
            .catch(err => {
                
                console.log(err)
            })
        }
    }
    
}
</script>