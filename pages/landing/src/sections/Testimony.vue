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
    			{
    				name : 'Jones',
    				testimony : 'Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.'
    			},
    			{
    				name : 'Sam',
    				testimony : 'Praesent sapien sapien massa, convallis  massa, convallis a pellentesque nec, egestas non nisi.'
    			},
    			{
    				name : 'Jones K',
    				testimony : 'Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.'
    			},
    		]
    	}
    },
    components: { 
    	Testimonies,
    }
}

</script>

<style>
#app-testimony {
    
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
