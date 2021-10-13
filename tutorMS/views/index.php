<?php
if(isset($_COOKIE['loggedinuser']))
{
	header("Location:dashboard.php");
	// echo "Logined user,go dashboard";
	die();
}
?>

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Tutor Management System | Login</title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="styles/bootstrap.min.css">

	<!-- Custom styles for this template -->
	<link href="styles/signin.css" rel="stylesheet">
</head>

<body class="text-center">
	<form method="post" action="../controllers/AuthController.php" class="form-signin">
		<h4 class="h3 mb-12 font-weight-bold">Tutor Management System</h4>
		<br/>

		<span class="text-danger"><?php if(isset($_COOKIE['error'])) echo $_COOKIE['error'];?></span>
		<span class="text-success"><?php if(isset($_COOKIE['success'])) echo $_COOKIE['success'];?></span>
		<br>
		<br>
		<label for="username" class="sr-only">Username</label>
		<input type="text" id="username" class="form-control" placeholder="Username" name="username" required autofocus>
		<label for="password" class="sr-only">Password</label>
		<input type="password" id="password" class="form-control" placeholder="Password" name="password" required>
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="login">Log in</button>
		<br/>
		<p>or</p>
		<a class="btn btn-lg btn-warning btn-block" href="reg_teacher.php">Registration as Teacher	</a>
		<a class="btn btn-lg btn-info btn-block" href="reg_student.php">Registration as Student	</a>
	</form>


</body>
</html>
