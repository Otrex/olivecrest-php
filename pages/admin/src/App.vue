<template>
	<div id="app" >
		<TopNav />
		<div class="container-fluid">
			<b-row>
				<SideNav class="col-md-2 d-none d-md-block bg-light sidebar" />
				<MainPanel role="main" class="col-md-10 ml-sm-auto col-lg-10 pt-3 px-3" />
			</b-row>
		</div>
	</div>
</template>

<script>
import TopNav from "./sections/TopNav.vue";
import MainPanel from "./sections/MainPanel.vue";
import SideNav from "./sections/SideNav.vue";

import { mapActions } from 'vuex'

export default {
    name: 'App',
    components : {
		TopNav, SideNav,MainPanel
	},
	methods: {
		...mapActions(['get_plans'])
	},
	created() {
		this.get_plans();
	}
};

</script>

