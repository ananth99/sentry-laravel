@extends ('layouts.master')

@section('content')

<br>
<form class="form-inline" action="auth/forgotPassword" method="post">
	<input type="email" name="email" class="input-small" placeholder="Email" required="">
  	<button type="submit" class="btn btn-sm">Submit</button>
</form>
@stop