<template>
  <div>
    <h2> Transaction </h2>
    <icon i='refresh' size="40" @click='get_transactions'/>
    <div style="padding: 1px; overflow: hidden;">
      <transactions :data='trx.data' />
    </div>
  </div>
</template>
<script>
import transactions from '../components/transactions.vue'
import icon from '../components/icon.vue'
import { mapState, mapActions } from 'vuex'

	export default {
		name : 'Transactions',
	    components : {
	      transactions, icon
	    },
	    props : {
	      title : String,
	      data : Array
	    },
	    computed : {
	      ...mapState({
	        	trx: 'transactions' 
	    	}),
	      trx_alert : function(){
	      	if (!this.trx) this.alert({bs: this.$bvModal, info : "No Transactions Made..."})
	      	return this.trx;
	      }
	    },
	    methods : {
	    	...mapActions(['get_transactions', 'alert'])
	    },
	    created() {
	    	this.get_transactions()
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