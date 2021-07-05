require('./bootstrap');

import Main from './mixins/main';

import { createApp } from "vue";
///import VueRouter from "vue-router";
import VueNextSelect from 'vue-next-select'
import queryString from 'query-string';
import 'vue-next-select/dist/index.min.css'

const app = createApp({});

/*const routes = []
const router = new VueRouter({
  routes // short for `routes: routes`
})
*/
app.component('vue-select', VueNextSelect)
app.component('login', require('./components/Auth/Login.vue').default);
app.component('header-component', require('./components/Common/Header.vue').default);
app.component('footer-component', require('./components/Common/Footer.vue').default);
app.component('offers', require('./components/Offer/Offers.vue').default);
app.component('zone-list', require('./components/Location/ZoneList.vue').default);
app.component('restaurent-list', require('./components/Restaurent/RestaurentList.vue').default);
app.component('restaurent-filter', require('./components/Restaurent/RestaurentFilter.vue').default);
app.component('restaurent-card', require('./components/Restaurent/RestaurentCard.vue').default);

app.mixin(Main)
   .use(queryString)
   .mount("#app");


