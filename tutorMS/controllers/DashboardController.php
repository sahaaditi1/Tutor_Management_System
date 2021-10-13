<?php
require_once '../models/database.php';

function getUserInfo($id)
{
	$query="SELECT * FROM `login` WHERE `id`='$id';";
	$data = get($query);
	return $data[0];	
}
function getStudentInfo($id)
{
	$query="SELECT * FROM `student` WHERE `id`='$id';";
	$data = get($query);
	return $data[0];	
}
function getStudentFullInfo($id)
{
	$query="SELECT * FROM `student` INNER JOIN `login` ON `student`.`id`=`login`.`user_id` AND `student`.`id`='$id'";
	$data = get($query);
	return $data[0];	
}
function getTeacherInfo($id)
{
	$query="SELECT * FROM `teacher` WHERE `id`='$id';";
	$data = get($query);
	return $data[0];	
}
function getTeacherFullInfo($id)
{
	$query="SELECT * FROM `teacher` INNER JOIN `login` ON `teacher`.`id`=`login`.`user_id` AND `teacher`.`id`='$id'";
	$data = get($query);
	return $data[0];	
}
function getAllTeachers()
{
	$query="SELECT * FROM `teacher` INNER JOIN `login` ON `teacher`.`id`=`login`.`user_id`";
	$data = get($query);
	return $data;	
}
function getAllStudents()
{
	$query="SELECT * FROM `student` INNER JOIN `login` ON `student`.`id`=`login`.`user_id`";
	$data = get($query);
	return $data;	
}
function getAllNonApprovedUsers()
{
	$query="SELECT * FROM `login` WHERE `approval_status`=0;";
	$data = get($query);
	return $data;	
}
function getGender($id)
{
	return $id==1?"Male":"Female";	
}
function getStatus($id)
{
	return $id==1?"Available":"Not available";	
}
function getGroup($id)
{
	switch ($id) {
		case 1:
			$group = "Science";
			break;
		case 2:
			$group = "Arts";
			break;
		case 3:
			$group = "Commerce";
			break;
		case 4:
			$group = "None";
			break;
		default:
			$group = "Science";
			break;
	}
	return $group;	
}
function getEducation($id)
{
	switch ($id) {
		case 1:
			$group = "HSC";
			break;
		case 2:
			$group = "BSC";
			break;
		case 3:
			$group = "MSC";
			break;
		default:
			$group = "MSC";
			break;
	}
	return $group;	
}

function getMedium($id)
{
	switch ($id) {
		case 1:
			$group = "Bangla";
			break;
		case 2:
			$group = "English";
			break;
		case 3:
			$group = "English Medium";
			break;
		default:
			$group = "Bangla";
			break;
	}
	return $group;	
}


?>