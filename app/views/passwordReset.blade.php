<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>

</head>
<body>
	<div class="password-reset">
		<a href="<?php echo url('auth/resetPassword?reset_code='.$reset_code.'&useremail='.$email);?>">Reset Password </a>
	</div>
</body>
</html>
