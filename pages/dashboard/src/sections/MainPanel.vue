<template>
	<div class="mainpanel" >
		<TopNav />
		<router-view class='view'/>
		<div class="ball"> 67 </div>
	</div>
</template>
<script >
import TopNav from './TopNav.vue'

export default {
	name : 'MainPanel',
	components : {TopNav},
};
</script>
<!--<style scoped>
	.mainpanel {
		padding: 0px 10px;
	}
	#panel {
		position: relative;
	}
	.view {
		padding: 10px;
	}
</style>-->
<style lang="scss">
  @import '~@/abstracts/_variables.scss';

  nav.top-navigation{
    background-color: $white;
    height: 50px;
    border-bottom: 2px solid $dark-color;
}
	.ball {
		width: 50px;
		height : 5px;
		position : fixed;

		top: 100px;
		left: 200px;
		&::after {
			content : '';
			width : 100px;
			height : 1000px;
			background-color : pink;
		}
	}
</style>