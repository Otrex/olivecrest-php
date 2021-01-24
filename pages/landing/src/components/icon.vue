<template>
	<div style='display:inline-block;' class='text-center'>
		<b-icon :icon="i" :style="csize"> </b-icon>
	</div>
</template>
<script >
export default {
	name : 'icon',
	props : {
		i : String,
		size : String,
	},
	computed: {
		csize : function(){
			return `width:${this.size}; height: ${this.size}`
		}
	}
};

</script>
<style >
	

</style>