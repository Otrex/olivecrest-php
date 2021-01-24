
import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)
const loader = require("../../loader");
const catchGetAsync = (context, url , mutation, h) => {
	loader.showloader();
	axios.get(url)
	.then(res => {
		loader.hideloader()
		// console.log([url, mutation, res.data])
		context.commit(mutation, res.data)
	})
	.catch(e=>{
		if (e) {
			loader.hideloader()
			console.log(e)
			context.commit('DB_ERR', e)
		}
		
	})
}

export default new Vuex.Store({
	state: {
		plans : [],
		profile : {},
		transactions : [],
		account : {},
		err_msg : {}
	},
	mutations : {
		DB_GET_TSC : (state, transactions) => {
			state.transactions = transactions
		},
		DB_GET_ACC : (state, account) => {
			state.account = account
		},
		DB_GET_PLANS : (state, plans) => {
			state.plans = plans
		},
		DB_GET_PROFILE : (state, profile) => {
			state.profile = profile
		},
		DB_ERR : (state, err) => {
			state.err_msg = err
		},
		set_error : (state, err) => {
			state.err_msg = {err}
		},
	},
	actions: {
		get_transactions : function (context){
			catchGetAsync(context, '/dashboard/profile/transactions', 'DB_GET_TSC')
		},
		get_account_overview : function (context){
			catchGetAsync(context, '/dashboard/account-overview', 'DB_GET_ACC')
		},
		get_profile : function (context){
			catchGetAsync(context, '/dashboard/profile', 'DB_GET_PROFILE')
		},
		get_plans : function (context){
			catchGetAsync(context, '/investment-plans', 'DB_GET_PLANS')
		},
		alert : function (context, bs) {
			if (!bs.info) return
			if (!bs.params) bs.params = [];

	        bs.bs.msgBoxOk(bs.info, {
	          title: 'Alert',
	          size: 'sm',
	          buttonSize: 'sm',
	          okVariant: 'success',
	          headerClass: 'p-2 border-bottom-0',
	          footerClass: 'p-2 border-top-0',
	          centered: true
	        })
	          .then(value => {
	        	if (bs.action) action(...params)
	          })
	          .catch(err => {
	            // An error occurred
	            console.log(err)
	          })
	          return 0;
	    }
	},
})