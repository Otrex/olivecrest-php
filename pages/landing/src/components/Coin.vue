<template>
	<div id='coin'>
		<div class='xheader'>
			<h4> {{ data.asset_id }} </h4>
			<b>$</b>{{ price }}
		</div>
		<div>
			<b-row>
				<b-col>
					<div>Name</div>
					<div><b>{{ data.name }}</b></div>
				</b-col>
				<b-col>
					<div>Volume</div>
					<div>{{ volume }}</div>
				</b-col>
			</b-row>
		</div>
	</div>
</template>
<script>

export default {
	name: 'Coin',
	props: {
        data: Object
	},
	computed: {
		price : function () {
			if (this.data.asset_id == 'xrp') return this.data.price_usd
			return Math.round(this.data.price_usd)
		},
		volume : function() {
			let volume = Math.round(this.data.volume)
			volume = ''+volume;
			if (volume.length >= 6){
				volume = volume.substr(0, volume.length-6) + 'K'
			}
			return volume;
		}
	},
	components: {}
};

</script>
<style scoped>
	#coin .xheader {
		text-align: center;
	}

	#coin {
		padding: 1.2rem;
		background: rgba(0,0,0,0.1);
	}
</style>