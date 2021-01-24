<template>
	<div id="home">
		<Nav class='nav-xt'/>
		<Header class="box" />
		<b-container>
			<About class="box"  v-scrollanime/>
			<Learn class="box" v-scrollanime />
			<Currency class="box" v-scrollanime />
			<Contact class="box" v-scrollanime />
			<Hwork class="box" v-scrollanime />
			<Testimony class="box" v-scrollanime />
			<Benefit class="box" v-scrollanime/>
		</b-container>
		<Footer class="box" style='background: rgba(0,0,0,.3);'/>
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
import Message from '../sections/Message.vue'

export default {
    name: 'Home',
    components: { 
    	Nav, Learn, Currency,
    	Header, About, Contact, Message,
    	Hwork, Testimony, Benefit, Footer
    },
    methods : {
    	
    },
    created(){
    	document.body.style.overflowY = 'scroll';
    }
};

</script>

<style>
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

div[id*='home-'] {
	padding: 8rem 0px;
}

.enter {
	opacity: 1;
	transform: translateY(0px);
	transition: all 2s ease-out;
}

.before-enter{
	opacity: 0;
	transform: translateY(100px);
	transition: all 2s ease-out;
}
.nav-spacing {
	padding-top: 70px;
}
</style>
