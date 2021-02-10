require('./../../bootstrap')
const loader = require('../../loader')
loader.showloader()
window.onload = function(e){ loader.hideloader() }
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

var np = false
router.beforeResolve((to, from, next) => {
  // If this isn't an initial page load.
   try {
    if (to.name) {
    // Start the route progress bar.
      if (NProgress) NProgress.start()
    }
    np = true
  } catch (e) {
    console.log('Nprogress not loaded')
  }
  next();
})

router.afterEach((to, from) => {
  // Complete the animation of the route progress bar.
  if (np) NProgress.done()
})

new Vue({
  render: h => h(App),
  router, store
}).$mount('#app')
