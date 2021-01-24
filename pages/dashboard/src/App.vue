<template>
	<div id="app">
		<refreshBtn/>
		<SideNav class='sidenav' />
		<MainPanel class='mainpanel' />
		<errorHandler v-show='err_msg' />
	</div>
</template>

<script>

import SideNav from './sections/SideNav.vue'
import MainPanel from './sections/MainPanel.vue'
import refreshBtn from './components/refreshBtn.vue'
import errorHandler from './components/errorHandler.vue'
import { mapState, mapActions } from 'vuex'

export default {
    name: 'App',
   
    components : {
		SideNav, refreshBtn,
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
		this.get_plans();
		this.get_account_overview();
		this.get_profile();
		this.get_transactions();
		if (this.err_msg) {
			this.alert({bs :this.$bvModal, info:this.err_msg.err })
		}
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

