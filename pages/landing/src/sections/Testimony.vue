<template>
	<div id="app-testimony">


		<h5>What our customers says</h5>
		<p><i>Thousands of people get benefit</i></p>
		<!--  -->
		<Testimonies :data='testimonies'/>
		<!--  -->
		<div class='funnel'>
			<b-row>
				<b-col md='2'><h1>Ready<br>To Invest?</h1></b-col>
				<b-col md='8'><p>Having gone through our website, we strongly believe that you are convinced to get started investing right away.</p></b-col>
				<b-col md='2'><button> Get Started </button></b-col>
			</b-row>
		</div>


	</div>
</template>

<script>
import Testimonies from "../components/Testimonies.vue";

export default {
    name: 'Testimony',
    data: function(){
    	return {
    		testimonies : [
                [
                    {
                        name : 'Jodi A.',
                        testimony : 'I made back the capital price in just 1 month! Not able to tell you how happy I am with Starshinebot . I use Starshinebot often.'
                    },
                    {
                        name : 'Ethelind V.',
                        testimony : '"I could probably go into sales for you. No matter where you go, Starshinebot is the coolest, most happening thing around! Thank you for making it painless,  pleasant and most of all hassle free for me in crypto trading ! Nice work on your Starshinebot ."'
                    },
                    {
                        name : 'Chalmers C.',
                        testimony : '"Starshinebot has completely surpassed our expectations."'
                    },
                ],
                [
                    {
                        name : 'Drea Q.',
                        testimony : '"I can\'t say enough about Starshinebot . Great job, I will definitely be investing again!"'
                    },
                    {
                        name : 'Stan P.',
                        testimony : '"Starshinebot saved my crypto currency. We can\'t understand how we\'ve been living without Starshinebot . We\'re loving it."'
                    },
                    {
                        name : 'Rosy.',
                        testimony : '"I will let my friends know about this, they could really make use of Starshinebot !"'
                    },
                ],
                [
                    {
                        name : 'Drea Q.',
                        testimony : '"I can\'t say enough about Starshinebot . Great job, I will definitely be investing again!"'
                    },
                    {
                        name : 'Stan P.',
                        testimony : '"Starshinebot saved my crypto currency. We can\'t understand how we\'ve been living without Starshinebot . We\'re loving it."'
                    },
                    {
                        name : 'Rosy.',
                        testimony : '"I will let my friends know about this, they could really make use of Starshinebot !"'
                    },
                ],

    			
    		]
    	}
    },
    components: { 
    	Testimonies,
    }
};

</script>

<style>
#app-testimony {
    padding: 5rem 4%;
}

.funnel {
	margin-top: 8rem;
	background: black;
	color: white;
	text-align: left;
	padding: 1rem;
	vertical-align: middle;
}
</style>
