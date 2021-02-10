<template>
	<div id="app">
		<SideNav class='sidenav' />
		<MainPanel class='mainpanel' />
		<errorHandler v-show='err_msg' />
	</div>
</template>

<script>

import SideNav from './sections/SideNav.vue'
import MainPanel from './sections/MainPanel.vue'
import errorHandler from './components/errorHandler.vue'
import { mapState, mapActions } from 'vuex'

export default {
    name: 'App',
    components : {
		SideNav,
    	MainPanel, errorHandler
    },
    computed : {
    	...mapState([
    		'err_msg', 'plans', 'account', 'profile'
    	]),
    },
    methods : {
		...mapActions([
			'get_plans', "get_account_overview", 
			'get_profile', 'get_transactions', 'alert'
		]),
	},
	created: function(){
		let self = this
		window.addEventListener('load', function(e){
			self.get_plans();
			self.get_account_overview();
			self.get_profile();
			self.get_transactions();
		})
	},
};
</script>

<style scoped>
.scroll-area {
  position: relative;
  margin: auto;
  width: 600px;
  height: 400px;
}

.sidenav {
	max-width: 200px;
	height: 100vh;
	float:left;
	padding-left: 5px;
	padding-bottom: 5px;
	padding-top: 5px;
	transition: all .3s;
	overflow-y: scroll;
}

.sidenav .text {
	position: relative;
	left: -100%;
}


.mainpanel {
	margin-left: 50px;
	height: 100vh;
	overflow-y: scroll;
	overflow-x: hidden;
}
</style>

