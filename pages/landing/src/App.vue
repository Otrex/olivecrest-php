<template>
	<div id="app" x='alert'>
		<router-view />
	</div>
</template>

<script>
export default {
    name: 'App',
    computed : {
    	alert(){
    		this.$alert('This is treasure');
    	}
    }
};
</script>

<style type="text/css">
	#app h3, #app h4, #app h5 {
		line-height: 3rem;
	}
</style>

