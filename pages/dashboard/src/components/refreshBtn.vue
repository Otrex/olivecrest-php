<template>
	<div class="floater">
		<a @click='refresh' class='floater-btn circle'><icon i='arrow-counterclockwise' size='30' /> </icon>{{text || ''}} </a>
		<a href='/auth/logout' class='floater-btn'><icon i='box-arrow-right' size='30' /> </icon></a>
	</div>
</template>
<script >
import icon from "./icon.vue"
import { mapActions } from 'vuex'

export default {
	name : 'refreshBtn',
	props : {
		text : String
	},
	components : {
		icon
	},
	methods : {
		...mapActions([
			'get_profile',
			'get_account_overview', 'get_plans'
		]),

		refresh : function() {
			this.get_plans();
			this.get_profile();
			this.get_account_overview();
		},
	}
};

</script>
<style scoped>
.floater {
	position: fixed;
	top: 50px;
	right: -118px;
	width: 130px;
	transition: all .3s;
	z-index: 10;
	box-shadow: 0px 0px 3px rgba(0,0,0,.3);
	padding: 5px;
	border-radius: 5px 0px 0px 5px;
	background-color: orange;
}
.floater:hover {
	right: 0px;
	background-color: rgba(0,0,0,1);
}
.floater-btn {
	display: inline-block;
	padding: 5px;
	width: 40px;
	height: 40px;
	color: orange;
}
.circle {
	border-radius: 50%;
}
.floater-btn:hover {
	background-color: orange;
	border-radius: 5px;
	color: white;
}

</style>