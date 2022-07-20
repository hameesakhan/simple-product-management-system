import { createApp } from "vue";
import App from "./App.vue";
import store from "./store";
import router from "./router";
import "./assets/css/nucleo-icons.css";
import "./assets/css/nucleo-svg.css";

import MaterialDashboard from "./material-dashboard";

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

const appInstance = createApp(App);
appInstance.use(store);
appInstance.use(router);

appInstance.use(MaterialDashboard);
appInstance.use(VueSweetalert2);

appInstance.mount("#app");
