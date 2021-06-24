require('./bootstrap');

import { createApp } from "vue";

const app = createApp({});

app.component('login', require('./components/Auth/Login.vue').default);
app.component('header-component', require('./components/Common/Header.vue').default);
app.component('footer-component', require('./components/Common/Footer.vue').default);

app.mount("#app");


