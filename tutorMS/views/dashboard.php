<?php 
include '../controllers/DashboardController.php';
if(!isset($_COOKIE['loggedinuser']))
{
	header("Location:index.php");
	die();
}
$userID = $_COOKIE['loggedinuser'];
$userInfo=getUserInfo($userID);
if($userInfo['user_type']=="STUDENT"){
	$teachers = getAllTeachers();
}
else if($userInfo['user_type']=="TEACHER"){
	$students = getAllStudents();
}
else if($userInfo['user_type']=="ADMIN"){
	$users = getAllNonApprovedUsers();
}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Tutor Management System | Dashboard</title>
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="styles/bootstrap.min.css">
</head>

<body>
	<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
		<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Tutor Management System</a>
		<ul class="navbar-nav px-3">
			<li class="nav-item text-nowrap">
				<a class="nav-link" href="../controllers/AuthController.php?submit=logout">Log out</a>
			</li>
		</ul>
	</nav>

	<div class="container-fluid">
		<div class="row">
			<nav class="col-md-2 d-none d-md-block bg-light sidebar">
				<div class="sidebar-sticky">
					<br>
					<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 my-100 mt-10 mb-1">
						<span>Hi, <?php echo $userInfo['name'];?> </span>
					</h6>
					<ul class="nav flex-column">
						<li class="nav-item">
							<a class="nav-link active" href="#">
								<span data-feather="home"></span>
								Dashboard <span class="sr-only">(current)</span>
							</a>
						</li>

						<?php
						if($userInfo['approval_status']!=0 && $userInfo['user_type']!="ADMIN"):?>
							<li class="nav-item">
								<a class="nav-link" href="update_profile.php">
									<span data-feather="file"></span>
									Update Profile
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="search_profile.php">
									<span data-feather="file"></span>
									Search Profile
								</a>
							</li>
						<?php endif ?>
					</ul>
				</div>
			</nav>

			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
				<span class="text-success"><?php if(isset($_COOKIE['success'])) echo $_COOKIE['success'];?></span>

				<?php
				if($userInfo['approval_status']==0):?>
					<div class="jumbotron">
						<h1 class="display-4">On Approval!</h1>
						<p class="lead">Please wait, we are working to approve your id.</p>
						<hr class="my-4">
						<p>After approval you can use full service.</p>
						<p class="lead">
							<a class="btn btn-primary btn-lg" href="../controllers/AuthController.php?submit=logout" role="button">Logout For Now</a>
						</p>
					</div>
					<?php elseif($userInfo['user_type']=="STUDENT"): ?>

						<h2>Teachers List</h2>
						<div class="table-responsive">
							<table class="table table-striped table-sm">
								<thead>
									<tr>
										<th>Name</th>
										<th>Group</th>
										<th>Education</th>
										<th>Prefered Classes</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach($teachers as $teacher)
									{
										echo "<tr>";
										echo "<td>".$teacher["name"]."</td>";
										echo "<td>".getGroup($teacher["group"])."</td>";
										echo "<td>".getEducation($teacher["education"])."</td>";
										echo "<td>".$teacher["class"]."</td>";
										echo '<td><a href="viewTeacher.php?id='.$teacher["user_id"].'" class="btn btn-success">View Details</a></td>';
										echo "</tr>";
									}
									?>
								</tbody>
							</table>
						</div>
						<?php elseif($userInfo['user_type']=="TEACHER"): ?>

							<h2>Student List</h2>
							<div class="table-responsive">
								<table class="table table-striped table-sm">
									<thead>
										<tr>
											<th>Name</th>
											<th>Class</th>
											<th>Group</th>
											<th>Medium</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach($students as $student)
										{
											echo "<tr>";
											echo "<td>".$student["name"]."</td>";
											echo "<td>".$student["class"]."</td>";
											echo "<td>".getGroup($student["group"])."</td>";
											echo "<td>".getMedium($student["medium"])."</td>";
											echo '<td><a href="viewStudent.php?id='.$student["user_id"].'" class="btn btn-success">View Details</a></td>';
											echo "</tr>";
										}
										?>
									</tbody>
								</table>
							</div>
							<?php elseif($userInfo['user_type']=="ADMIN"): ?>

								<h2>Approval List</h2>
								<div class="table-responsive">
									<table class="table table-striped table-sm">
										<thead>
											<tr>
												<th>Name</th>
												<th>Username</th>
												<th>Type</th>
												<th>Phone</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											if($users){
												foreach($users as $user)
												{
													echo "<tr>";
													echo "<td>".$user["name"]."</td>";
													echo "<td>".$user["username"]."</td>";
													echo "<td>".$user["user_type"]."</td>";
													echo "<td>".$user["phone"]."</td>";
													echo '<td><a href="../controllers/AdminController.php?action=approve&id='.$user["id"].'" class="btn btn-success">Approve</a></td>';
													echo '<td><a href="../controllers/AdminController.php?action=delete&id='.$user["id"].'" class="btn btn-danger">Delete</a></td>';
													echo "</tr>";
												}
											}
											?>
										</tbody>
									</table>
								</div>

							<?php endif ?>

						</main>
					</div>
				</div>
			</body>
			</html>
