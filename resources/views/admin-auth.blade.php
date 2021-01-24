@extends('layout')

@section('title', 'Admin Authentication' )

@section('style')
	<style>
		body {
			background-color: orange;
		}
		.display {
			display: block !important;
		}
		.row {
			text-align: center;
		}
		.form-group label {
			display: block;
			color: rgb(10,10,10);
		}
		.form-group small {
			display: block;
		}
		.form-group input {
			width: 100%;
		}
		.col-sm-6 {
			display: inline-block;
			text-align: left;
			width: 60%;
		}

		@media screen (max-width: 500px){
			.row .col-sm-6{
				display: block;
			}
		}

		.admin {
			margin : 30px;
			background-color: white;
			padding: 30px;
			display: none;
			transition: all .3s;
			overflow: hidden;
		}
	</style>
@endsection
@section('body')
    {{ csrf_field() }}
    <button onclick='switchAuth(this)' > Register </button>
    <!-- Input -->
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-12 col-sm-6">
			    <div class="admin login display">
			    <form action='/admin/auth/login' method="POST">
			    	{{ csrf_field() }}
			    	<div class="form-group">
					    <label for="exampleInputEmail1">Email: </label>
					    <input type="text" class="form-control input-lg" id="email" name='email' aria-describedby="emailHelp" placeholder="e.g Abcd@123.com..">
					    <small id="emailHelp" class="form-text text-muted">This must be a valid email..</small>
					</div>
					<div class="form-group">
					    <label for="exampleInputPassword1">Password: </label>
					    <input type="password" class="form-control input-lg" id="password" name='password' aria-describedby="passwordHelp" placeholder="e.g Abcd123..">
					    <small id="passwordHelp" class="form-text text-muted">This must be a valid password..</small>
					</div>
					<button class="btn btn-primary" type='submit'> Submit </button>
			    </form>
				</div>

				<div class="admin register">
			    <form action='/admin/auth/register' method="POST">
			    	{{ csrf_field() }}
			    	<div class="form-group">
					    <label for="exampleInputusername1">Username: </label>
					    <input type="text" class="form-control input-lg" id="username" name='username' aria-describedby="usernameHelp" placeholder="e.g Abcd123..">
					    <small id="UsernameHelp" class="form-text text-muted">This must be a valid username..</small>
					</div>
					<div class="form-group">
					    <label for="exampleInputEmail1">Email: </label>
					    <input type="text" class="form-control input-lg" id="email" name='email' aria-describedby="emailHelp" placeholder="e.g Abcd@123.com..">
					    <small id="emailHelp" class="form-text text-muted">This must be a valid email..</small>
					</div>
					<div class="form-group">
					    <label for="exampleInputPassword1">Password: </label>
					    <input type="password" class="form-control input-lg" id="password" name='password' aria-describedby="passwordHelp" placeholder="e.g Abcd123..">
					    <small id="passwordHelp" class="form-text text-muted">This must be a valid password..</small>
					</div>
					<div class="form-group">
					    <label for="exampleInputPassword1">Retype-Password: </label>
					    <input type="password" class="form-control input-lg" id="rpassword" name='rpassword' aria-describedby="passwordHelp" placeholder="e.g Abcd123..">
					    <small id="passwordHelp" class="form-text text-muted">This must be a valid password..</small>
					</div>
			    	<button class="btn btn-primary" type="submit"> Submit </button>
			    </form>
				</div>
			</div>
		</div>
	</div>
@endsection


@section('script')
<script>
	var on = false
	var login = document.querySelector('.admin.login');
	var register = document.querySelector('.admin.register');

	function switchAuth(btn){
		if (!on) {
			register.classList.add('display')
			login.classList.remove('display')
			btn.innerHTML = 'Login'
			on = true
		} else {
			login.classList.add('display')
			register.classList.remove('display')
			btn.innerHTML = 'Register'
			on = false
		}
	}

</script>
@endsection


