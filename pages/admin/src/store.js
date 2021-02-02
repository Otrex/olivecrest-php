
import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

const catchGetAsync = (context, url , mutation, i) => {
	axios.get(url)
	.then(res => {
		context.commit(mutation, res.data, i)
	})
	.catch(e=>{
		if (e) {
			console.log(e)
			alert(e)
		}	
	})
}

const store = {
	state : {
		plans : []
	},
	mutations : {
		DB_GET_PLANS : (state, plans) =>{
			state.plans = plans
		},
		DELETE_PLAN : (state, i )=>{
			state.plans.splice(i, 0);
		}
	},
	actions : {
		get_plans : function(context) {
			catchGetAsync(context, '/investment-plans', 'DB_GET_PLANS')
		},
		delete_plan : function(context, i ){
			alert(i)
			catchGetAsync(context, '/delete-plan/'+i, 'DELETE_PLAN', i)
		}
	}

}

export default new Vuex.Store(store)