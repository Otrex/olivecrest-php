<template>
	<div class="container-fluid body-bg">
		
		<b-row>
			<b-col md='6'>
				<nav > 
					<div class="logo">
	                    <img src='/img/logo5.png' />
	                </div>
					<router-link to='/'> <b-icon icon="house-door-fill" style="width: 30px; height: 30px;"> </b-icon><span class="s"> Home </span></router-link>
					<router-link to='/register'> <b-icon icon="person-plus-fill" style="width: 30px; height: 30px;"> </b-icon><span class="s"> Sign Up </span></router-link>
				</nav>
					<!--  -->
					<div class="step-cont">
						<div class="step active"> 1 </div>
						<div :class="loggedin ? 'step active': 'step'"> 2 </div>
					</div>

			</b-col>


			<b-col md='6'>
			
				<div class='form mid'>
				<form id="form" class="mid" v-if='!loggedin'>
					  <div class="form-group">
					    <label for="exampleInputEmail">Enter Email: </label>
					    <input type="email" class="form-control input-lg" id="email" v-model='form.email' aria-describedby="emailHelp" placeholder="e.g abc@xyz.co">
					    <small id="emailHelp" class="form-text text-muted">This email field must contain your valid email</small>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Enter Password:</label>
					    <input type="password" class="form-control input-lg" v-model='form.password' id="password" placeholder="e.g E3df4tg...">
					  </div>
					  <button type="submit" class="btn btn-primary" @click.submit.prevent='login'>Submit</button>
				</form>
				<transition name="slide-fade" >
					<form class="mid" v-if='loggedin'>
						<div class="form-group">
						    <label for="exampleInputEmail">Enter Token: </label>
						    <input type="email" class="form-control input-lg" id="email" v-model='token' aria-describedby="emailHelp" placeholder="e.g abc@xyz.co">
						    <small id="emailHelp" class="form-text text-muted">Note: The token has been sent to your email address.</small>
						    <button type="submit" class="btn btn-primary" @click.submit.prevent='verifyToken(token)'>Submit</button>
						</div>
					</form>
				</transition>
				</div>
		</b-col>
	</b-row>

	</div>
</template>
<script >
import axios from 'axios'
const loader = require("../../../loader");
// Add a logger route to be able to logg the errors
export default {
	name : "Login",
	data() {
		return {
			loggedin:false,
			token: '',
			form : {
				csrf_token : document.querySelector("[name='_token']").value,
				email : '',
				password : ''
			}
		}
	},
	methods : {
		verifyToken : function(data){
			loader.showloader('AUTHENTICATING...')
			axios.post('/auth/check-token', {
				csrf_token : this.form.csrf_token,
				token : data.trim()
			}).then( res => {
				loader.hideloader()
				if ( res.status == 200 && res.data.msg){
					location.href = '/dashboard'
				} else {
					this.$msgalert("Token is invalid..Type in the correct token", this.$bvModal)
				}
			}).catch( e => {
				loader.hideloader()
				if (e) this.$msgalert("Something went Wrong..", this.bvModal)
			})
      	},
		login : function() {
			loader.showloader('AUTHENTICATING...')
			axios.post("/auth/login", {
				...this.form
			}).then( res => {
				loader.hideloader()
				if (res.data.msg) {
					this.loggedin = true
					this.form = {
						csrf_token : document.querySelector("[name='_token']").value
					}
				}
				if (res.data.err) {
					this.$msgalert(res.data.err, this.$bvModal)
				}
			}).catch(e => {
				loader.hideloader()
				if (e) this.$msgalert("Something Went Wrong... ", this.$bvModal)
			})
		}
	}
};

</script>
<style scoped>

	.form {
		margin: 40px 10%;
		padding: 20px;
		background: white;
	}
	input {
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
		vertical-align: middle;
	}
	span.s {
		display: inline-block;
		padding-bottom: 2rem;
	}
	a {
		color: white;
		transition: all .3s;
	}
	a:hover {
		color: black;
		transform: translateY(-4px);
	}
.slide-fade-enter-active {
  transition: all .3s ease;
}
.slide-fade-leave-active {
  transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active below version 2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}

.step-cont {
	text-align: center;
}

.step {
	display: inline-block;
	width: 40px;
	height: 40px;
	border-radius: 50%;
	background-color: white;
	text-align: center;
	vertical-align: middle;
	border : 5px solid black;
	font-weight: bolder;
	padding-top: 5px;
	font-size: 25px;
}

.step::first-child{
	margin-left: 10px;
}
.step.active {
	background-color: orange;
}

</style>