<?php 
include '../controllers/DashboardController.php';
if(!isset($_COOKIE['loggedinuser']))
{
	header("Location:index.php");
	die();
}
$userID = $_COOKIE['loggedinuser'];
$userInfo=getUserInfo($userID);

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Tutor Management System | Update Profile</title>
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
							<a class="nav-link active" href="#">
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
				<span class="text-success"><?php if(isset($_COOKIE['success'])) echo $_COOKIE['success'];?></span>

				<h2>Update Profile</h2>

				<div class="row justify-content-center">
					<div class="col-md-12 order-md-1">

						<!-- <h4 class="mb-3">Billing address</h4> -->
						<form class="needs-validation" method="post" action="../controllers/ProfileController.php" novalidate>
							<div class="mb-3">
								<label for="name">Name</label>
								<input type="text" class="form-control" id="name" placeholder="Name" value="<?php if(isset($userInfo['name'])) echo $userInfo['name'];?>" name="name" required>
								<div class="invalid-feedback">
									Valid Name is required.
								</div>
							</div>

							<div class="mb-3">
								<label for="email">Email</label>
								<input type="email" class="form-control" id="email" placeholder="you@gmail.com" name="email" value="<?php if(isset($userInfo['email'])) echo $userInfo['email'];?>" required>
								<div class="invalid-feedback <?php if(isset($_COOKIE['error_email'])) echo 'd-block';?>">
									Please enter a valid email address.
								</div>
							</div>


							<div class="mb-3">
								<label for="phone">Phone</label>
								<input type="number" class="form-control" id="phone" placeholder="01XXXXXXXXX" value="<?php if(isset($userInfo['phone'])) echo '0'.$userInfo['phone'];?>" name="phone" required>
								<div class="invalid-feedback">
									Valid Phone number is required.
								</div>
							</div>

							


							<hr class="mb-4">

							<input type="hidden" name="id" value="<?php echo $userID;?>">
							<button class="btn btn-primary btn-lg" type="submit" name="submit" value="update">Update</button>
							<br>
							<br>
							<br>
						</form>
					</div>
				</div>

			</main>
		</div>
	</div>
</body>
</html>
