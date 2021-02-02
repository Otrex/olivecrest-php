<template>
	<div class="plans container-fluid">
		<div class="header">
			<h1> Plan </h1>
		</div>
		<b-row>
			<b-col cols='12' md='5'>
				<div class="allplans">
					<h1 v-if='!plans'> No Plans Added Yet </h1>
					<ul>
						<li v-for='( plan , i ) in plans' :key='i' >
							<b-card >
								<icon i="x-circle-fill" size='25' @click='delete_plan(i)'></icon>
								<h1>{{plan.name}}</h1>
								<h1 class="large-xx"> {{plan.percent_returns}} </h1>
								<p> {{plan.desc}} </p>
								<ul class="features" v-html='plan.feat' > </ul>
							</b-card>
							<br>
						</li>
					</ul>
				</div>
			</b-col>

			<b-col cols='12' md='7'>
				<div class="entry card">
					<form id="form" class="mid">
						<b-row >
							<b-col cols='12' md='6'>
							  <div class="form-group">
							    <label for="exampleInputEmail">Enter Plan Name: </label>
							    <input type="email" class="form-control input-lg" id="email" v-model='form.name' aria-describedby="emailHelp" placeholder="e.g abc@xyz.co">
							  </div>
							</b-col>
							<b-col cols='12' md='6'>
							  <div class="form-group">
							    <label for="exampleInputEmail">Enter Percentage Returns: </label>
							    <input type="email" class="form-control input-lg" id="email" v-model='form.percentageReturns' aria-describedby="emailHelp" placeholder="e.g abc@xyz.co">
							  </div>
							</b-col>
						</b-row>

					  <div class="form-group">
					    <label for="exampleInputPassword1">Enter Description:</label>
					    <textarea class="form-control" v-model='form.description' id="password" placeholder="e.g E3df4tg..."></textarea>
					  </div>

					  <div class="form-group" v-for='(field , i) in featuresfield'>
					  	<div v-html='field' ></div>
					  </div>
					  <button  class="btn btn-primary" @click.submit.prevent='addfeature'>Add features </button>
			
						  <button type="submit" class="btn btn-primary" @click.submit.prevent='addplan'>Submit</button>
					</form>
				</div>
			</b-col>

		</b-row>
	</div>
</template>
<script >

import { mapState, mapActions } from 'vuex'
import icon from '../components/icon'

	export default {
		name : 'Plan',
		data(){ 
			return  {
				form : {...require('../csrftoken'), feat: ''},
				plan : {},
				featuresfield : [],
				feat :[] 
			}
		},
		components : {
			icon
		},
		computed : {
			...mapState(['plans']),
			getfeatures : function(){
				this.form.feat = this.feat.join('')
			}
		},
		methods : {
			...mapActions(['get_plans', 'delete_plan']),
			addfeature : function(){
				var l = this.featuresfield.length
				var form = document.querySelector('.feat'+(l-1))
				if (l>0) this.form.feat += `<li> ${form.value} </li>`
				this.featuresfield.push ('<label for="exampleInputEmail">Enter Feature: </label>\
					    <input type="email" class="form-control input-lg feat' + l +' " "\
					    v-model="feat" aria-describedby="emailHelp" id="feat' + l +'"\
					    placeholder="e.g abc@xyz.co">')
			},
			addplan : function() {
				axios.post('/admin/addplan', {...this.form})
				.then( res => {
					if (res.data.msg) {
						this.get_plans()
						alert('Plan Added Successfully..')
					}
					if (res.data.err) alert(res.data.err)
					
				})
				.catch( err => {
					if (err) alert (err)
				})
			},
			showplan : function(i) {
				this.plan = this.plans[i]
				this.form = this.plan
			}
		}
	};
</script>
<style >
	.header {
		margin-bottom: 50px;
	}
	.entry {
		padding: 10px;
	}
	.mid {
		padding: 20px;
	}
</style>