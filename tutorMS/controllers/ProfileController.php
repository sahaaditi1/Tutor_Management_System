<?php
require_once '../models/database.php';
if(isset($_POST["submit"]) && $_POST["submit"]=="update")
{

	$id				=	$_POST["id"];
	$name			=	$_POST["name"];
	$email			=	$_POST["email"];
	$phone			=	$_POST["phone"];

	$hasError = false;
	$error = "";

	$regex='/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/';
	if(!preg_match($regex,$email)){
		$hasError = true;
		$error .= " Invalid email.";
		setcookie("error_email",true,time()+ 1,"/");
		setcookie("error",$error,time()+ 1,"/");
		header("Location:../views/update_profile.php");
		die();
	}

	$query="UPDATE `login` SET `name` = '$name', `email` = '$email', `phone` = '$phone' WHERE `login`.`id` = '$id';";
	$res = execute($query);

	if($res){
		setcookie("success","Profile Update Successful!",time()+ 1,"/");
		header("Location:../views/update_profile.php");
	}else{
		setcookie("error","Updating failed",time()+ 1,"/");
		header("Location:../views/update_profile.php");
	}

}
else if(isset($_GET["submit"]) && $_GET["submit"]=="search"){

	$name			=	$_GET["name"];
	$user_type		=	$_GET["user_type"];
	$alter_type = $user_type=="TEACHER"?"STUDENT":"TEACHER";
	

	$query="SELECT * FROM `login` WHERE `name` LIKE '%$name%' AND `user_type`='$alter_type';";
	$data = get($query);
	if($data){
		foreach ($data as $key => $value) {
			echo "<tr>";
			echo "<td>".$value["name"]."</td>";
			echo "<td> 0".$value["phone"]."</td>";
			if($user_type=="TEACHER"){
				echo '<td><a href="viewStudent.php?id='.$value["user_id"].'" class="btn btn-success">View Details</a></td>';
			}else{
				echo '<td><a href="viewTeacher.php?id='.$value["user_id"].'" class="btn btn-success">View Details</a></td>';
			}
			echo "</tr>";
		}
	}
	else{
			echo "<tr>No Profile Found</tr>";
	}
}
else{
	echo "No valid Action";
	die();
}

?>