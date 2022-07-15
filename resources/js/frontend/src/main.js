import { createApp } from 'vue';
const Vue = createApp({});

import router from './router'

import BootstrapVue3 from "bootstrap-vue-3"

import App from './App.vue'

import Default from './Layout/Wrappers/baseLayout.vue';
import Pages from './Layout/Wrappers/pagesLayout.vue';

Vue.config.productionTip = false;

Vue.use(BootstrapVue3);
Vue.use(router);

Vue.component('default-layout', Default);
Vue.component('userpages-layout', Pages);
Vue.component('app-component', App);

Vue.mount('#app')
