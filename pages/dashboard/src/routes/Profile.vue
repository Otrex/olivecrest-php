<template>
	<div id="profile">
		<small> OVERVIEW </small>
		<h1 > User Profile </h1>
		<b-container fluid>
			<b-row>
				<b-col cols='12' md='4' class='p-3'>
					<b-card class='text-center'>
						<div class="img-container">
							<img src='#' />
						</div>
						<div class="card-text">
							<h1 > {{fullname}} </h1>
							<h4 > {{ occupation ? occupation : 'No Data'}} </h4>
							<div class='bar-complete' ></div>
							<small>COMPLETED XX% OF PROFILE</small>
							<p > {{description}} </p>
						</div>
					</b-card>
				</b-col>
				<b-col cols='12' md='8'>
					<b-card>
						<div class="card-header">
							<h1> User Details </h1>
						</div>
						<b-row >
							<b-col cols='12' sm='6' >
								<div class="form-group">
								    <label for="exampleInputEmail">First Name: </label>
								    <input type="email" class="form-control input-lg" id="email" v-model='form.email' aria-describedby="emailHelp" placeholder="e.g abc@xyz.co">
								    <small id="emailHelp" class="form-text text-muted">This email field must contain your valid email</small>
								</div>
							</b-col>
							<b-col cols='12' class='pr-3' sm='6' >
								<div class="form-group">
								    <label for="exampleInputEmail">Last Name: </label>
								    <input type="email" class="form-control input-lg" id="email" v-model='form.email' aria-describedby="emailHelp" placeholder="e.g abc@xyz.co">
								    <small id="emailHelp" class="form-text text-muted">This email field must contain your valid email</small>
								</div>
							</b-col>
						</b-row>

						<b-row >
							<b-col cols='12' sm='6' >
								<div class="form-group">
								    <label for="exampleInputEmail">Country: </label>
								    <input type="email" class="form-control input-lg" id="email" v-model='form.email' aria-describedby="emailHelp" placeholder="e.g abc@xyz.co">
								    <small id="emailHelp" class="form-text text-muted">This email field must contain your valid email</small>
								</div>
							</b-col>
							<b-col cols='12' class='pr-3' sm='6' >
								<div class="form-group">
								    <label for="exampleInputEmail">Enter Email: </label>
								    <input type="email" class="form-control input-lg" id="email" v-model='form.email' aria-describedby="emailHelp" placeholder="e.g abc@xyz.co">
								    <small id="emailHelp" class="form-text text-muted">This email field must contain your valid email</small>
								</div>
							</b-col>
						</b-row>

						<div class="form-group">
						    <label for="exampleInputEmail">Enter Email: </label>
						    <input type="email" class="form-control input-lg" id="email" v-model='form.email' aria-describedby="emailHelp" placeholder="e.g abc@xyz.co">
						    <small id="emailHelp" class="form-text text-muted">This email field must contain your valid email</small>
						</div>

						<div class="form-group">
						    <label for="exampleInputEmail">Enter Email: </label>
						    <input type="email" class="form-control input-lg" id="email" v-model='form.email' aria-describedby="emailHelp" placeholder="e.g abc@xyz.co">
						    <small id="emailHelp" class="form-text text-muted">This email field must contain your valid email</small>
						</div>
					</b-card>
				</b-col>
			</b-row>
		</b-container>
	</div>
</template>
<script>
import { mapState } from 'vuex'

	export default {
		name : 'Profile',
		computed : {
			...mapState({
				data: 'profile'})
			,
			fullname: function(){},
			occupation: function(){},
			description: function(){}
		},
		data : function() {
			return {
				empty : null,
				form : {}
			}
		},
		methods : {
		
		},
		components : {

		}
	};
</script>

<style scoped>
	.cards {
		width: 50%;
		padding: 20px 20px;
		display: inline-block;
	}
	.cards::nth-child(2) {
		padding: 20px 0px;
	}
	.bar-complete {
		width: 80%;
		height: 5px;
		border-radius: 2px;
		background-color: green;
	}
</style>