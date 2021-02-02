import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router);


// Pages import
import Home from "./routes/Home.vue";
import Users from "./routes/Users.vue";
import Plan from "./routes/Plan.vue";
// import Register from "./routes/Register.vue";


const routes = [
	{
		path: '/',
		component: Home
	},
	{
		path: '/users',
		component: Users
	},
	{
		path: '/plans',
		component: Plan
	},
	// {
	// 	path: '/register',
	// 	component: Register
	// }
]


export default new Router({
	// mode : 'history',
	routes
});