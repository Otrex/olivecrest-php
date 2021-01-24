<template>
	<div id="profile">
		<b-card >
			<div >
				<p v-for='(detail, tag) in data' :key='tag'>
					{{tag}} : {{detail}}<br>
				</p>
			</div>
		</b-card>
	</div>
</template>
<script>
import { mapState } from 'vuex'

	export default {
		name : 'Profile',
		computed : {
			...mapState({
				data: 'profile'
			})
		},
		data : function() {
			return {
				empty : null
			}
		},
		methods : {
		
		},
		components : {

		}
	};
</script>

<style scoped>
	.cards {
		width: 50%;
		padding: 20px 20px;
		display: inline-block;
	}
	.cards::nth-child(2) {
		padding: 20px 0px;
	}
</style>