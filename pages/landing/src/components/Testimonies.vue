<template>
	<div id='testimonies'>
		<b-row>
			<b-col v-for='t in data' :key='t.name'>
				<b-card>
					<div><h2>{{t.name}}</h2></div>
					<div>{{t.testimony}}</div>
				</b-card>
			</b-col>
		</b-row>
	</div>
</template>
<script>

export default {
	name: 'Testimonies',
	props: {
        data: Array
	},
	components: {}
}

</script>
<style scoped>
	#testimonies {

	}
</style>