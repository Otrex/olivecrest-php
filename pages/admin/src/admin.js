require('./../../bootstrap')
/*--------------------------------------------------------------------------------------------*/
// Requirements
import Vue from 'vue'
import { 
	BootstrapVue, 
	IconsPlugin } from 'bootstrap-vue'

// Router & App & Store
import store from "./store"
import router from "./router"
import App from './App.vue'

// Directives & CSS imports
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.config.productionTip = false


new Vue({
  render: h => h(App),
  router, store
}).$mount('#app')
