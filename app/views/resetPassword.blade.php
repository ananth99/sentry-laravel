@extends('layouts.master')

@section('content')
<div class="well col-lg-4">
	<form class="form-horizontal" action="{{url('auth/resetPassword')}}" method="post">
		<br><br>
		<input type="password" name="password" id="password" class="input-small" placeholder="New password" required="">
		<br><br>
		<input type="password" name="confirm-password" class="input-small" placeholder="Confirm password" required="" oninput="check(this);">
		
		<script type="text/javascript">
			function check(input){
				if(input.value != document.getElementById('password').value){
					input.setCustomValidity('The two passwords must match.');
				}
				else{
					input.setCustomValidity('');
				}
			}
		</script>
		<br><br>
		<input type="hidden" name="email" value="{{$email}}">
	  	<button type="submit" class="btn btn-sm btn-primary">Reset</button>
	</form>
</div>
@stop