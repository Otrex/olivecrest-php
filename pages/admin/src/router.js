import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router);


// Pages import
import Home from "./routes/Home.vue";
// import Login from "./routes/Login.vue";
// import Register from "./routes/Register.vue";


const routes = [
	{
		path: '/',
		component: Home
	},
	// {
	// 	path: '/login',
	// 	component: Login
	// },
	// {
	// 	path: '/register',
	// 	component: Register
	// }
]


export default new Router({
	// mode : 'history',
	routes
});