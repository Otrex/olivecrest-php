<template>
	<div id="home">
    &nbsp;<br>
		<main>
          <AccountOverview title='Account Overview' :data='account' />
          <TransactionOverview :data='mytransactiondata' />
          <canvas class="my-4" id="myChart" width="900" height="380"></canvas>
    </main>
	</div>
</template>
<script>
import AccountOverview from "../components/AccountOverview.vue";
import TransactionOverview from "../components/TransactionOverview.vue";
import { mapState } from 'vuex'


    export default {
      name : 'Home',
      computed : {
        ...mapState([
          'profile', 'transaction', 'account'
        ]),
      },
      components : {
        AccountOverview,
        TransactionOverview
    },
		data : function() {
			return {
				mytransactiondata : [],
				mydata : [
					{
						name: 'My Available Balance',
						amt : '4000'
					},
					{
						name: 'My Invested Balance',
						amt : '4000'
					},
					{
						name: 'Total Withdrawal',
						amt : '00.0'
					},
					{
						name: 'Referral Bonus',
						amt : '00.0'
					}
				]
			}
		},
	}
</script>