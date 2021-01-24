<template>
	<div class="mainpanel" >
		<TopNav />
		<router-view class='view'/>
	</div>
</template>
<script >
import TopNav from './TopNav.vue'
import { mapState } from 'vuex'

export default {
	name : 'MainPanel',
	components : {TopNav},
	computed : {
		...mapState([
			'err_msg'
		])
	}
};
</script>
<style scoped>
	.mainpanel {
		padding: 0px 10px;
	}
	#panel {
		position: relative;
	}
	.view {
		padding: 10px;
	}
</style>