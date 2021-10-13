<?php 
include '../controllers/DashboardController.php';
if(!isset($_COOKIE['loggedinuser']))
{
	header("Location:index.php");
	die();
}
$userID = $_COOKIE['loggedinuser'];
$userInfo=getUserInfo($userID);
$student=getStudentFullInfo($_GET['id']);

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Tutor Management System | Student Details</title>
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="styles/bootstrap.min.css">
</head>

<body>
	<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
		<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="dashboard.php">Tutor Management System</a>
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
							<a class="nav-link" href="dashboard.php">
								<span data-feather="home"></span>
								Dashboard <span class="sr-only">(current)</span>
							</a>
						</li>
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
					</ul>
				</div>
			</nav>

			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

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
					<?php else: ?>

						<h2>Student Details</h2>
						<dl class="row">
							<dt class="col-sm-3">Name</dt>
							<dd class="col-sm-9"> <?php echo $student["name"];?> </dd>

							<dt class="col-sm-3">Gender</dt>
							<dd class="col-sm-9">
								<?php echo getGender($student["gender"]);?>
							</dd>

							<dt class="col-sm-3 text-truncate">Class</dt>
							<dd class="col-sm-9">
								<?php echo $student["class"];?>
							</dd>

							<dt class="col-sm-3">Group</dt>
							<dd class="col-sm-9">
								<?php echo getGroup($student["group"]);?>
							</dd>

							<dt class="col-sm-3">Medium</dt>
							<dd class="col-sm-9">
								<?php echo getMedium($student["medium"]);?>
							</dd>

							<dt class="col-sm-3">Institution</dt>
							<dd class="col-sm-9">
								<?php echo $student["institution"];?>
							</dd>

							<dt class="col-sm-3">Contact</dt>
							<dd class="col-sm-9">
								<dl class="row">
									<dt class="col-sm-4">Phone</dt>
									<dd class="col-sm-8">
										<?php echo $student["phone"];?>
									</dd>
									<dt class="col-sm-4">Email</dt>
									<dd class="col-sm-8">
										<?php echo $student["email"];?>
									</dd>
								</dl>
							</dd>

							<dt class="col-sm-3 text-truncate">Address</dt>
							<dd class="col-sm-9">
								<?php echo $student["address"];?>
							</dd>
						</dl>

					<?php endif ?>

				</main>
			</div>
		</div>
	</body>
	</html>
