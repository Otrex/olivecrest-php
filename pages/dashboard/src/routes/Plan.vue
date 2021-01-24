<template>
	<div id="plans">
		<b-card-group>
			<b-card v-for="( plan , i ) in plans" :key='i'  :header="plan.name+ ' Plan'" text-variant="black" class='text-center' >
				<b-card-text> 
					<h1 class='enlarge-xx'> {{plan.percent_returns}}% </h1>
					{{plan.desc}}
					<ul v-html='plan.feat'></ul>
				</b-card-text>
				<b-button :value='plan.btn_link' > Button </b-button>
			</b-card>
		</b-card-group>
	</div>
</template>
<script>
import { mapState } from 'vuex'

export default {
	name : 'Plans',
	computed : {
		...mapState([
			'plans'
		]),

		plan_name : function(i){
			return `${i} Plan`;
		}
	},
};
</script>

<style scoped>
	.cards {
		width: 50%;
		padding: 20px 20px;
		display: inline-block;
	}
	.card-header {
		font-weight: bold;
	}
	.cards::nth-child(2) {
		padding: 20px 0px;
	}
</style>