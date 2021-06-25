require('./bootstrap');

import Main from './mixins/main';

import { createApp } from "vue";

const app = createApp({});

app.component('login', require('./components/Auth/Login.vue').default);
app.component('header-component', require('./components/Common/Header.vue').default);
app.component('footer-component', require('./components/Common/Footer.vue').default);
app.component('offers', require('./components/Offer/OfferList.vue').default);
app.component('restaurent-list', require('./components/Restaurent/RestaurentList.vue').default);
app.component('restaurent-item', require('./components/Restaurent/RestaurentItem.vue').default);

app.mixin(Main)
   .mount("#app");


