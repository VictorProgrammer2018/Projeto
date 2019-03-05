import Vue from "vue";
import './plugins/vuetify'
import App from "./App.vue";
import router from "./router";

//store
import store from "./store";

//axios
import axios from 'axios';

Vue.config.productionTip = false;

//configurando axios para api do lumen
Vue.prototype.$http = axios;
Vue.prototype.$urlAPI = 'http://localhost:8000/api/';

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app");
