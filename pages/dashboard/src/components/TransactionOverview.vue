<template>
  <div>
    <h2> Recent Transaction </h2>
    <div style="padding: 1px; overflow: hidden;">
    <b-row>
      <b-col cols='8' class='transactions' >
        <b-card>
        <div id='chart'>
          &nbsp;
        </div>
        </b-card>
      </b-col>
      <b-col cols='4' class='accstats'>
        <b-card>
        <div id='achart'>
          &nbsp;
        </div>
        </b-card>
      </b-col>

    </b-row>
    </div>
  </div>
</template>
<script>
import transactions from './transactions.vue'
import accstats from './accstats.vue'

	export default {
		name : 'TransactionOverview',
    components : {
      transactions, accstats
    },
    props : {
      title : String,
      data : Array
    }
	};
</script>

<style scoped>
h3 {
  font-size: 1rem;
}
</style>