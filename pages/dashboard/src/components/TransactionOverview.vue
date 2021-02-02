<template>
  <div>
    <h2> Recent Transaction </h2>
    <div style="padding: 1px; overflow: hidden;">
    <b-row>
      <b-col cols='8' class='transactions' >
        <b-card>
          <div class="card-header">
            Overall Portfolio
          </div>
        <div id='chart'>
          Active <div class="rec active"> </div> Inactive <div class="rec inactive"></div> Earnings <div class="rec earnings"></div>
        </div>
        </b-card>
      </b-col>
      <b-col cols='4' class='accstats'>
        <b-card>
        <div id='achart'>
          <div class="card-header">
            Earning History
          </div>
            <table border='1'>
              <th> TRX ID </th><th> AMOUNT </th><th> DATE </th>
            </table>
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
.rec {
  display: inline-block;
  width: 50px;
  height: 30px;
  background-color: grey;
}
</style>