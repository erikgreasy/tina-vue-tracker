import Vue from 'vue'
import App from './App.vue'
import Home from './views/Home.vue';
import Trip from './views/ViewTrip.vue';
import Track from './views/Track.vue';
import VueRouter from 'vue-router'

Vue.config.productionTip = false
Vue.use(VueRouter)


const routes = [
  { 
    path: '/', 
    name: 'Home',
    component: Home 
  },
  {
    path: '/single/:id',
    name: 'SingleTrip',
    component: Trip
  },
  {
    path: '/track',
    name: 'Track',
    component: Track
  }
]
const router = new VueRouter({
  routes, // short for `routes: routes`
  mode: 'history'
})


new Vue({
  router,
  render: h => h(App),
}).$mount('#app')
