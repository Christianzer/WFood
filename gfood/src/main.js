import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import vuetify from "./plugins/vuetify";
import axios from "axios";
const http = axios.create({
  baseURL: "http://127.0.0.1:8000/api", // Remplacer par l'URL de votre API
});

Vue.prototype.$http = http;

Vue.config.productionTip = false;

new Vue({
  router,
  store,
  vuetify,
  render: (h) => h(App),
}).$mount("#app");
