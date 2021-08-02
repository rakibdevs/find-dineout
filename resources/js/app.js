require('./bootstrap');
import { createApp } from "vue";

import Main from './mixins/main';


import router from './router'
import store from './store';

import VueNextSelect from 'vue-next-select'
import queryString from 'query-string';
import Toaster from "@meforma/vue-toaster";
import 'vue-next-select/dist/index.min.css'

const app = createApp({});

app.component('vue-select', VueNextSelect)
app.component('login', require('./components/Auth/Login.vue').default);
app.component('header-component', require('./components/Common/Header.vue').default);
app.component('footer-component', require('./components/Common/Footer.vue').default);
app.component('offers', require('./components/Offer/Offers.vue').default);
app.component('zone-list', require('./components/Location/ZoneList.vue').default);
app.component('restaurent-list', require('./components/Restaurent/RestaurentList.vue').default);
app.component('restaurent-filter', require('./components/Restaurent/RestaurentFilter.vue').default);
app.component('restaurent-card', require('./components/Restaurent/RestaurentCard.vue').default);

app.component('loading-table', require('./components/Common/LoadingTable.vue').default);

app.component('admin-header', require('./components/Admin/Include/AdminHeader.vue').default);
app.component('admin-sidebar', require('./components/Admin/Include/AdminSidebar.vue').default);

app.component('cuisine-list', require('./components/Admin/Cuisines/CuisineList.vue').default);
app.component('feature-list', require('./components/Admin/Features/FeatureList.vue').default);
app.component('category-list', require('./components/Admin/Categories/CategoryList.vue').default);
app.component('rdata-table', require('./components/Common/RdataTable.vue').default);

app.mixin(Main)
   .use(router)
   .use(store)
   .use(Toaster, {
      position: "top-right",
   })
   .use(queryString)
   .mount("#app");


