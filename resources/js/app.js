require('./bootstrap');

import { createApp } from "vue";

const app = createApp({});

app.component('login', require('./components/Auth/Login.vue').default);

app.mount("#app");


