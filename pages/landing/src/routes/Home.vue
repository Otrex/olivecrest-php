<template>
	<div id="home">

		<!-- Header Section -->
			<Nav class='nav-xt'/>
			<Header class="box" />
		<!-- End Of Header section -->

		<section class='box filler' > &nbsp; </section>

		<!-- Body -->
			<About class="box"  v-scrollanime/>
			<Learn class="box" v-scrollanime />
			<Stats class="box" v-scrollanime />
			<!-- <Currency class="box" v-scrollanime /> -->
			<Contact class="box" v-scrollanime />
			<Hwork class="box" v-scrollanime />
			<OurPlans class='box' v-scrollanime />
			<Testimony class="box" v-scrollanime />
			<Benefit class="box" v-scrollanime/>
			<Footer class="box" style='background: rgba(0,0,0,.3);'/>
		<!-- End Of Body -->

		<!-- Widget -->
		<div class='crypto-info' > 
			<coingecko-coin-price-marquee-widget coin-ids="bitcoin,ethereum,eos,ripple,litecoin" 
			currency="usd" background-color="#ffffff" locale="en"></coingecko-coin-price-marquee-widget>
		</div>
		<div class="chat-icon text-center">
			<icon i='chat-left-dots-fill' size='35'/>
		</div>
		<!-- End of Widgets -->

	</div>
</template>

<script>
import Nav from '../sections/Nav.vue' 
import Header from '../sections/Header.vue'
import Footer from '../sections/Footer.vue'
import About from '../sections/About.vue'
import Contact from '../sections/Contact.vue'
import Benefit from '../sections/Benefit.vue'
import Testimony from '../sections/Testimony.vue'
import Hwork from '../sections/Hwork.vue'
import Learn from '../sections/Learn.vue'
import Currency from '../sections/Currency.vue'
import OurPlans from '../sections/OurPlans.vue'
import Stats from '../sections/Stats.vue'

import icon from '../components/icon.vue'

export default {
    name: 'Home',
    components: { 
    	Nav, Learn, Currency, Stats,
    	Header, About, Contact, OurPlans,
    	Hwork, Testimony, Benefit, Footer,
    	icon
    },
    methods : {
    	
    },
    created(){
    	document.body.style.overflowY = 'scroll';
    }
};

</script>

<style>

.chat-icon {
	position: fixed;
	bottom : 80px;
	right: 5%;
	border-radius: 50%;
	background: white;
	box-shadow: 0px 1px 10px rgba(255 ,165 ,0 ,0.5);
	width: 60px;
	height: 60px;
	padding: 10px;
	padding-top: 18px;
	color: orange;
	transition: all .3s;
	/*border: 2px solid rgba(255 ,165 ,0 ,0.8);*/
}
.chat-icon:hover {
	background: orange;
	color: white;
	box-shadow: 0px 1px 20px rgba(255 ,165 ,0 ,0.7);
}
#home {
    text-align: center;
    font-size: 1.2rem;
    color: #2c3e50;
}

.box {
	padding: 100px 20px;
}

.nav-xt {
	position: fixed;
	width: 100%;
	z-index: 300;
}

.filler {
	padding: 12rem 0px 0px 0px;
}

div[id*='home-'] {
	padding: 8rem 0px;
}

.enter {
	opacity: 1;
	transform: translateY(0px);
	transition: all 1s ease-out;
}

.before-enter{
	opacity: 0;
	transform: translateY(100px);
	transition: all 1s ease-out;
}
.nav-spacing {
	padding-top: 70px;
}

.crypto-info {
	position:fixed;
	bottom: 0px;
	width: 100%;
	z-index: 1000;
	background: rgba(255,255,255, 0.3);
}
</style>
