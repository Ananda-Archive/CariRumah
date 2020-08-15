import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import vuetify from './plugins/vuetify'
import axios from 'axios'
import firebase from'firebase';

Vue.config.productionTip = false
axios.defaults.baseURL = 'https://api.cari-rumah.com/api'

const firebaseConfig = {
  apiKey: "AIzaSyBUHrynLM_optOeIXSvBOzvI-MZhsQh068",
  authDomain: "carirumah-45009.firebaseapp.com",
  databaseURL: "https://carirumah-45009.firebaseio.com",
  projectId: "carirumah-45009",
  storageBucket: "carirumah-45009.appspot.com",
  messagingSenderId: "693309178392",
  appId: "1:693309178392:web:26340b65c913cc5534b96d",
  measurementId: "G-FXHCRVLE5X"
};

firebase.initializeApp(firebaseConfig)

new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')
