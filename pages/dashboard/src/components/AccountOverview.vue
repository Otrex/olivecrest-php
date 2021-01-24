<template>
  <div>

    <h2> {{title}} </h2>

    <div style="padding: 1px; overflow: hidden;">
      <b-container fluid>
        <b-row>
          <b-col cols='6' md='3' sm='6' class='p-3'>
            <myinfo name='Available Balance' :amount='data.available_balance'/>
          </b-col>

          <b-col cols='6' md='3' sm='6' class='p-3'>
            <myinfo name='Total Balance' :amount='data.total_balance'/>
          </b-col>

          <b-col cols='6' md='3' sm='6' class='p-3'>
            <myinfo name='Invested Balance' :amount='data.invested_balance'/>
          </b-col>

          <b-col cols='6' md='3' sm='6' class='p-3'>
            <myinfo name='Referral Bonus' :amount='data.referal_bonus'/>
          </b-col>
        </b-row>
      </b-container>
    </div>
  </div>
</template>
<script>
import myinfo from './myinfo.vue'
	export default {
		name : 'AccountOverview',
    components : {
      myinfo,
    },
    props : {
      title : String,
      data :Object
    }
	};
</script>

<style scoped>
h3 {
  font-size: 1rem;
}
</style>