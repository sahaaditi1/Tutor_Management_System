<?php
require_once '../models/database.php';

if(isset($_GET["action"]) && $_GET["action"]=="approve")
{
	$id=$_GET["id"];
	$query="UPDATE login SET approval_status=1 WHERE id='$id'";
	execute($query);
	setcookie("success","Approved Successfully",time()+ 1,"/");
	header("Location:../views/dashboard.php");

}
else if(isset($_GET["action"]) && $_GET["action"]=="delete")
{
	$id=$_GET["id"];
	$query="DELETE FROM login WHERE id='$id'";
	execute($query);
	setcookie("success","Deleted Successfully",time()+ 1,"/");
	header("Location:../views/dashboard.php");
}
