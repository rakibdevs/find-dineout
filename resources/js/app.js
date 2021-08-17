require('./bootstrap');
import { createApp } from "vue";

import Main from './mixins/main';


import router from './router'
import store from './store';

import queryString from 'query-string';
import Toaster from "@meforma/vue-toaster";
import CKEditor from '@ckeditor/ckeditor5-vue';
import ElementPlus from 'element-plus';
import 'element-plus/lib/theme-chalk/index.css';

const app = createApp({});

app.component('login', require('./components/Auth/Login.vue').default);
app.component('header-component', require('./components/Common/Header.vue').default);
app.component('footer-component', require('./components/Common/Footer.vue').default);
app.component('footer-location', require('./components/Common/FooterLocation.vue').default);
app.component('booking', require('./components/Common/Booking.vue').default);

app.component('offers', require('./components/Offer/Offers.vue').default);
app.component('zone-list', require('./components/Location/ZoneList.vue').default);
app.component('restaurents', require('./components/Restaurent/RestaurentList.vue').default);
app.component('restaurent-filter', require('./components/Restaurent/RestaurentFilter.vue').default);
app.component('restaurent-card', require('./components/Restaurent/RestaurentCard.vue').default);
app.component('restaurent', require('./components/Restaurent/Restaurent.vue').default);

app.component('loading-table', require('./components/Common/LoadingTable.vue').default);

app.component('admin-header', require('./components/Admin/Include/AdminHeader.vue').default);
app.component('admin-sidebar', require('./components/Admin/Include/AdminSidebar.vue').default);
app.component('dashboard', require('./components/Admin/Dashboard/Dashboard.vue').default);

app.component('cuisine-list', require('./components/Admin/Cuisines/CuisineList.vue').default);
app.component('feature-list', require('./components/Admin/Features/FeatureList.vue').default);
app.component('category-list', require('./components/Admin/Categories/CategoryList.vue').default);
app.component('zones-list', require('./components/Admin/Zones/ZoneList.vue').default);
app.component('location-list', require('./components/Admin/Locations/LocationList.vue').default);

app.component('restaurent-list', require('./components/Admin/Restaurents/RestaurentList.vue').default);
app.component('restaurent-create', require('./components/Admin/Restaurents/RestaurentCreate.vue').default);
app.component('restaurent-edit', require('./components/Admin/Restaurents/RestaurentEdit.vue').default);
app.component('rdata-table', require('./components/Common/RdataTable.vue').default);

app.mixin(Main)
   .use(router)
   .use(store)
   .use(Toaster, {
      position: "top-right",
   })
   .use(queryString)
   .use(ElementPlus)
   .use(CKEditor)
   .mount("#app");


