<template>
	<div id='home'>
		<TopNav />
		<b-row>
			<SideNav class="col-md-2 d-none d-md-block bg-light sidebar" />
			<MainPanel role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4" />
		</b-row>
	</div>
</template>
<script >
import TopNav from "../sections/TopNav.vue";
import SideNav from "../sections/SideNav.vue";
import MainPanel from "../sections/MainPanel.vue";

export default {
	name : 'Home',
	components : {
		TopNav, SideNav,
		MainPanel
	}
};
</script>
<style type="text/css">
	
</style>