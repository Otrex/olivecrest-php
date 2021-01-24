<template>
	<div class="container-fluid">
		<nav > 
			<router-link to='/'> <b-icon icon="house-door-fill" style="width: 30px; height: 30px;"> </b-icon> Home </router-link>
			<router-link to='/register'> <b-icon icon="person-plus-fill" style="width: 30px; height: 30px;"> </b-icon> Sign Up </router-link>
		</nav>
		<div class='form'>
		<form id="form" class="mid">
			  <div class="form-group" v-if='!show_token_field'>
			    <label for="exampleInputEmail">Enter Email: </label>
			    <input type="email" class="form-control" 
			    id="email" v-model='form.email' @keydown.enter='sendToken' aria-describedby="emailHelp" placeholder="e.g abc@xyz.co">
			    <small id="emailHelp" class="form-text text-muted">This email field must contain your valid email</small>
			  </div>
			  <div class="form-group" v-if='show_token_field'>
			    <label for="exampleInputPassword1">Enter Token:</label>
			    <input type="password" class="form-control" v-model='form.token' id="password" placeholder="e.g E3df4tg...">
			  </div>
			  <div v-if='show_token_field'>
				  <div class="form-group">
				    <label for="exampleInputPassword1">Enter New Password:</label>
				    <input type="password" class="form-control" v-model='form.password' @keydown.enter='getToken' id="password" placeholder="e.g E3df4tg...">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">Retype New Password:</label>
				    <input type="password" class="form-control" v-model='form.password' id="password" placeholder="e.g E3df4tg...">
				  </div>
			  </div>
			  <button type="submit" class="btn btn-primary" @click.submit.prevent='changePassword'>Submit</button>
		</form>
		</div>

	</div>
</template>
<script >
import axios from 'axios'

export default {
	name : "ForgotPassword",
	data() {
		return {
			boxTwo: '',
			show_token_field: false,
			go_to_dashboard : false,
			submittedNames : {},
			form : {
				csrf_token : document.querySelector("[name='_token']").value,
			}
		}
	},
	components : {
	},
	methods : {
		sendToken : function(){
			axios.get('/auth/send-token/', {
				headers : {
					'email': this.form.email
				}
			}).
			then( res => {
				if ( res.data.msg ) {
					this.show_token_field = true;
					this.showMsgBoxTwo("Sending Token Successful...", true);
				}
				if ( res.data.err ){
					this.showMsgBoxTwo("Sending Token Failed...", true);
				}
			}).catch( e => {
				this.showMsgBoxTwo("Something went wrong...", true);
			})
		}, 
		changePassword : function(){
			axios.post('/auth/reset-password/', {
				...this.form
			}).
			then( res => {
				if ( res.data.msg ) {
					this.show_token_field = true;
					this.showMsgBoxTwo("Password Reset Successful...", true);
				}
				if ( res.data.err ){
					this.showMsgBoxTwo("Password Reset Failed...", true);
				}
			}).catch( e => {
				this.showMsgBoxTwo("Something went wrong...", true);
			})
		},
		showMsgBoxTwo(info, error=false) {
	        this.$bvModal.msgBoxOk(info, {
	          title: 'Confirmation',
	          size: 'sm',
	          buttonSize: 'sm',
	          okVariant: 'success',
	          headerClass: 'p-2 border-bottom-0',
	          footerClass: 'p-2 border-top-0',
	          centered: true
	        })
	          .then(value => {
	          	if (!error) {
	          		this.go_to_dashboard = true
	          	}
	          	this.show_token_entry_form = false
	          })
	          .catch(err => {
	            // An error occurred
	          })
	          return 0;
      	},
	}
};

</script>
<style scoped>
	div {
    	font-family: thasadith, sans-serif;
	}

	.form {
		margin: 50px 15%;
		padding: 20px;
		background: whitesmoke;
	}
	nav {
		text-align: right;
		padding-top: 20px;
		padding-bottom: 20px;
		padding-left: 20px;
		margin-right: 15%;
		margin-top: 50px;
	}
	nav * {
		padding-left: 10px;
		font-size: 1.5rem;
		vertical-align: middle;
	}
</style>