import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router);


// Pages import
import Home from "./routes/Home.vue";
import Login from "./routes/Login.vue";
import Register from "./routes/Register.vue";
import ForgotPassword from "./routes/ForgotPassword.vue";

const routes = [
	{
		path: '/',
		component: Home
	},
	{
		path: '/login',
		component: Login
	},
	{
		path: '/register',
		component: Register
	},
	{
		path: '/reset-password',
		component: ForgotPassword
	},
	{
	    path: '/:pathMatch(.*)*',
	    component: {
	    	template : "<div class='not-found'> \
	    			<div><img src='/img/logo4.png' /> \
	    			<h1 style='font-size: 15rem;'> 404 </h1>\
	    			<h4> Page Not Found </h4>\
	    			<a href='#/'> Go Back Home </a> </div></div>"
	    }
	}
]


export default new Router({
	// mode : 'history',
	routes
});