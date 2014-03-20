@extends('layouts.master')

@section('content')
	
	<div id="login-form">
		<br>
    	<form class="form-inline pull-right" action="auth/login" method="post">
			<input type="text" name="email" class="input-small" placeholder="Email">
			<input type="password" name="password" class="input-small" placeholder="Password">
			<label class="checkbox">
			<input type="checkbox" name="remember"> Remember me
			</label>
			<button type="submit" class="btn btn-sm btn-primary">Sign in</button>
		</form>
	<br><br>
	<a href="forgotPassword" class="pull-right">Forgot Password?</a> 
	<hr>
	</div>
	
	@if(Session::has('message'))
    <div class="alert-box success">
        <h6>{{ Session::get('message') }}</h6>
    </div>
	@endif	
     <form class="form-signin col-lg-4 pull-right well" id="registration" role="form" action="auth/register" method="post">
        <h2 class="form-signin-heading">Register</h2>
        <input type="text" name="firstname" class="form-control" placeholder="First Name" required="" autofocus=""> <br>
        <input type="text" name="lastname" class="form-control" placeholder="Last Name" required="" autofocus=""><br>
        <input type="email" name="email" class="form-control" placeholder="Email address" required="" autofocus=""><br>
        <input type="password" name="password" class="form-control" placeholder="Password" required="">
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
     </form>  
        
@stop