<?php
require_once '../models/database.php';
if(isset($_POST["submit"]) && $_POST["submit"]=="login")
{
	$username=$_POST["username"];
	$password=$_POST["password"];
		// var_dump($_POST);
		#$query="SELECT * FROM LOGIN WHERE username=$username AND password=$password";
	$query="SELECT * FROM `login` WHERE `username`='$username' AND `password`='$password';";
	$data=get($query);
	if($data){
		setcookie("loggedinuser",$data[0]["id"],time()+ 3600*24,"/");
		header("Location:../views/dashboard.php");
		// echo "login successfull";
		// var_dump($data);
		// var_dump($_COOKIE);
		// die();
	}
	else{
		setcookie("error","Incorrect Email or Password",time()+ 1,"/");
		header("Location:../views/index.php");
	}

}
else if(isset($_POST["submit"]) && $_POST["submit"]=="register" && $_POST["type"]=="STUDENT")
{
	// $username=$_POST["username"];
	// $password=$_POST["password"];
	// var_dump             ($_POST);

	$name			=	$_POST["name"];
	$username		=	$_POST["username"];
	$email			=	$_POST["email"];
	$phone			=	$_POST["phone"];
	$address		=	$_POST["address"];
	$gender			=	$_POST["gender"];
	$group			=	$_POST["group"];
	$medium			=	$_POST["medium"];
	$class			=	$_POST["class"];
	$institution	=	$_POST["institution"];
	$password		=	$_POST["password"];

	$hasError = false;
	$error = "";

	$regex='/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/';
	if(!preg_match($regex,$email)){
		$hasError = true;
		$error .= " Invalid email.";
		setcookie("error_email",true,time()+ 1,"/");
	}

	$query2="SELECT * FROM login WHERE username='$username';";
	$double = get($query2);

	if($double){
		$hasError = true;
		$error .= " Username already exist!";
		setcookie("error_username",true,time()+ 1,"/");
	}
	if($hasError){
		setcookie("name",		$name,time()+ 1,"/");
		setcookie("username",	$username,time()+ 1,"/");
		setcookie("email",		$email,time()+ 1,"/");
		setcookie("phone",		$phone,time()+ 1,"/");
		setcookie("address",	$address,time()+ 1,"/");
		setcookie("class",		$class,time()+ 1,"/");
		setcookie("institution",$institution,time()+ 1,"/");
		setcookie("error",$error,time()+ 1,"/");

		header("Location:../views/reg_student.php");
		die();
	}

	$query1="INSERT INTO `student` ( `gender`, `group`, `medium`, `class`, `institution`, `address`) VALUES ( '$gender', '$group', '$medium', '$class', '$institution', '$address');";
	$stuID = executeInsert($query1);

	$query="INSERT INTO `login` (`name`, `username`, `email`, `phone`, `password`, `user_type`, `user_id`, `approval_status`) VALUES ('$name', '$username', '$email', '$phone', '$password', 'STUDENT', '$stuID', '0');";
	$res = execute($query);

	if($res){
		setcookie("success","Registration Successful! Please login",time()+ 1,"/");
		header("Location:../views/index.php");
	}else{
		setcookie("error","Registration failed",time()+ 1,"/");
		header("Location:../views/reg_student.php");
	}

}
else if(isset($_POST["submit"]) && $_POST["submit"]=="register" && $_POST["type"]=="TEACHER")
{
	// $username=$_POST["username"];
	// $password=$_POST["password"];
	var_dump             ($_POST);
	// die();

	$name			=	$_POST["name"];
	$username		=	$_POST["username"];
	$email			=	$_POST["email"];
	$phone			=	$_POST["phone"];
	$address		=	$_POST["address"];
	$gender			=	$_POST["gender"];
	$group			=	$_POST["group"];
	$medium			= 	implode(",", $_POST["medium"]);
	$class			=	implode(",", $_POST["class"]);
	$education		=	$_POST["education"];
	$status			=	$_POST["status"];
	$password		=	$_POST["password"];

	$hasError = false;
	$error = "";

	$regex='/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/';
	if(!preg_match($regex,$email)){
		$hasError = true;
		$error .= " Invalid email.";
		setcookie("error_email",true,time()+ 1,"/");
	}

	$query2="SELECT * FROM login WHERE username='$username';";
	$double = get($query2);

	if($double){
		$hasError = true;
		$error .= " Username already exist!";
		setcookie("error_username",true,time()+ 1,"/");
	}
	if($hasError){
		setcookie("name",		$name,time()+ 1,"/");
		setcookie("username",	$username,time()+ 1,"/");
		setcookie("email",		$email,time()+ 1,"/");
		setcookie("phone",		$phone,time()+ 1,"/");
		setcookie("address",	$address,time()+ 1,"/");
		setcookie("error",$error,time()+ 1,"/");

		header("Location:../views/reg_teacher.php");
		die();
	}

	$query1="INSERT INTO `teacher` ( `gender`, `group`, `medium`, `class`, `status`, `education`, `address`) VALUES ( '$gender', '$group', '$medium', '$class', '$status','$education', '$address');";
	$teaID = executeInsert($query1);

	$query="INSERT INTO `login` (`name`, `username`, `email`, `phone`, `password`, `user_type`, `user_id`, `approval_status`) VALUES ('$name', '$username', '$email', '$phone', '$password', 'TEACHER', '$teaID', '0');";
	$res = execute($query);

	if($res){
		setcookie("success","Registration Successful! Please login",time()+ 1,"/");
		header("Location:../views/index.php");
	}else{
		setcookie("error","Registration failed",time()+ 1,"/");
		header("Location:../views/reg_teacher.php");
	}
}
else if($_GET["submit"]=="logout"){
	setcookie("loggedinuser","",time() - 3600*24,"/");
	setcookie("success","Logout Successful!",time()+ 1,"/");
	header("Location:../views/index.php");
}
else{
	echo "No valid Action";
	die();
}

?>