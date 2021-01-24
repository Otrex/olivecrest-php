<template>
  <div v-if='show'>
  </div>
</template>
<script>
import { mapActions, mapState } from 'vuex';

	export default {
		name : 'errorHandler',
	    props : {
	      action: Function,
	      params: Array
	    },
	    
	    computed : {
	    	...mapState(['err_msg']),
	    	show : function(){
	    		this.alert({bs: this.$bvModal, info : this.err_msg.message})
	    		return this.err_msg;
	    	}
	    },
	    methods: {
	    	...mapActions([
	    		'alert'
	    	])
	    }
	};
</script>

<style scoped>
h3 {
  font-size: 1rem;
}
</style>