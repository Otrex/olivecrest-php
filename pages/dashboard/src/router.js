import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router);


// Pages import
import Home from "./routes/Home.vue";
import Plan from "./routes/Plan.vue";
import Profile from "./routes/Profile.vue";
import Settings from "./routes/Settings.vue";
import Transactions from "./routes/Transactions.vue";
import MakeTransaction from "./routes/MakeTransaction.vue";

// Err
import NotFound from "./routes/NotFound.vue";

const routes = [
	{
		name: 'Home',
		path: '/',
		component: Home
	},
	{
		name: 'Investment-Plans',
		path: '/plans',
		component: Plan
	},
	{
		name: 'My-Profile',
		path: '/profile',
		component: Profile
	},
	{
		name: 'Settings',
		path: '/settings',
		component: Settings
	},
	{
		name: 'Transaction-Overview',
		path: '/transactions',
		component: Transactions
	},
	{
		name: 'Make-Transactions',
		path: '/make-transaction',
		component: MakeTransaction
	},
	{
	    path: '/:pathMatch(.*)*',
	    component: NotFound
	}
]


export default new Router({
	// mode : 'history',
	routes
});