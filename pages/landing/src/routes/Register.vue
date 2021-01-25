<template>
	<div class="register container-fluid body-bg">
		<nav class="" > 
			<router-link to='/'>
				<div class="logo">
                    <img src='/img/logo5.png' />
                </div>
            </router-link>
			<router-link to='/'> <b-icon icon="house-door-fill" style="width: 30px; height: 30px;"> </b-icon><span class='s'> Home </span></router-link>
			<router-link to='/login'> <b-icon icon="key-fill" style="width: 30px; height: 30px;"> </b-icon><span class="s"> Log In </span></router-link>
		</nav>
		<b-row>
			<b-col sm='3'>&nbsp;</b-col>
			<b-col sm='6' style='padding-top: 50px;'>
				<h2 v-show='registered'> {{message}} </h2>
		<div class='form mid' v-show='!registered'>
		<form id="form" class="mid">
			<b-row>
			  	<b-col cols='12' sm='6'>
			  		<div class="form-group">
					    <label for="exampleInputFirstname1">First Name:</label>
					    <input type="text" class="form-control input-lg" v-model='form.firstname' id="firstname" placeholder="e.g Frank etc...">
				    </div>
				</b-col>
			  	<b-col cols='12' sm='6'>
			  		<div class="form-group">
					    <label for="exampleInputrLastname">Last Name:</label>
					    <input type="text" class="form-control input-lg" id="lastname" v-model='form.lastname' placeholder="e.g Sam ..">
				    </div>
			  	</b-col>
			  </b-row>
			  <div class="form-group">
			  	<label for='formCountry'>Country: </label>
				  <select id='formCountry' @change="phonefix($event)"  placeholder='Please select a country of your choice' class="form-control input-lg" v-model='form.country'>
				  	<option> Please select a country of your choice </option>
				  	<option :value='data.name' v-for='(data, i) in countrylist' :key='i' :title='data.phone_code'>{{data.name}}</option>
				  </select>
        	  </div>
			  <div class="form-group">
			    <label for="exampleInputusername1">Username: </label>
			    <input type="text" class="form-control input-lg" id="username" v-model='form.username' aria-describedby="usernameHelp" placeholder="e.g Abcd123..">
			    <small id="UsernameHelp" class="form-text text-muted">This must be a valid username..</small>
			  </div>
			  <div class="form-group">
			    <label for="exampleInputusername1">Email: </label>
			    <input type="text" class="form-control input-lg" id="email" v-model='form.email' aria-describedby="emailHelp" placeholder="e.g Abcd123@obi.com..">
			    <small id="emailHelp" class="form-text text-muted">This must be a valid Email..</small>
			  </div>
			  <div class="form-group">
			    <label for="exampleInputcontact1">Contact: </label>
			    <input type="text" class="form-control input-lg" id="contact" 
			    v-model='form.contact' aria-describedby="usernameHelp" placeholder="e.g Abcd123..">
			    <small id="UsernameHelp" class="form-text text-muted">This must be a valid phone number..</small>
			  </div>
			  <b-row>
			  	<b-col cols='6'>
			  		<div class="form-group">
					    <label for="exampleInputPassword1">Password:</label>
					    <input type="password" class="form-control input-lg" v-model='form.password' id="password" placeholder="e.g FirstNAme; Lastname; etc...">
				    </div>
				</b-col>
			  	<b-col cols='6'>
			  		<div class="form-group">
					    <label for="exampleInputrPassword1">Retype Password:</label>
					    <input type="password" class="form-control input-lg" id="rpassword" v-model='form.rpassword' placeholder="e.g Cvd%45687hjdht7...">
				    </div>
			  	</b-col>
			  </b-row>
			  <button type="submit" class="btn btn-primary btn-lg" @click.submit.prevent='register'>Submit</button>
		</form>
		</div>
		</b-col>
		<b-col md='3'>&nbsp;</b-col>
	</b-row>
	</div>
</template>
<script >
// import axios from 'axios'

const loader = require("../../../loader");
export default {
	name : "Register",
	data(){
		return {
			registered : false,
			countrylist : [],
			message : '',
			form : {
				csrf_token : document.querySelector("[name='_token']").value,
				username : '',
				password : '',
				rpassword : '',
				email : '',
				country: ''
			}
		}
	},
	created(){
		document.body.style.overflowY = 'hidden';
		this.countrylist = require('../utilities/xc');
	},
	methods : {
		phonefix : function(e){
			var i = e.target
			console.log(i)
			this.form.contact = i
		},

		isempty : function(){
			for (let field in this.form){
				if (!this.form[field].trim()) {
					this.showMsgBoxTwo(field + " is empty")
					return true
				}
			}
		},

		register : function() {
			loader.showloader('REGISTERING')
			if (this.form.password != this.form.rpassword ) this.$msgalert( "Password Dont Match" , this.bvModal )
			if (this.isempty()) return
			// console.log(this.form)
			axios.post("/auth/register", {
				...this.form
			}).then ((res)=>{
				loader.hideloader()
				let reply = res.data
				if ('msg' in reply){
					this.message = 'Proceed to verify your account...'
					this.$msgalert('Sign Up Successful..Check your Email for further verification', this.$bvModal, ()=>{location.href = '/#/login'})
					this.registered = true
				}
				if ('err' in reply ) this.$msgalert( reply.err , this.$bvModal )

			}).catch((e)=>{
				loader.hideloader()
				if (e) this.$msgalert( "Something went wrong.." , this.$bvModal )
			})
		}
	}
};

</script>
<style scoped>
	a {
		color: white;
		transition: all .3s;
	}
	a:hover {
		color: black;
		transform: translateY(-4px);
	}
	div.body-bg {
		overflow-y: scroll;
	}
	input , select {
		height: 4rem;
	}
	nav {
		text-align: center;
		padding-top: 20px;
		padding-bottom: 20px;
		transform: translateX(-20px);
		margin-top: 50px;
	}
	nav * {
		padding-left: 10px;
		font-size: 1.5rem;
		vertical-align: bottom;
	}
	span.s {
		display: inline-block;
		padding-bottom: .5rem;
	}
</style>