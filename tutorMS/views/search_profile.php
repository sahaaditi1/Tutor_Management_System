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
	<title>Tutor Management System | Search Profile</title>
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="styles/bootstrap.min.css">

	<script>
		
		function onKey(){

			var name= document.getElementById("name").value;
			var user_type = document.getElementById("user_type").value;

			// user_type=user_type=="TEACHER"?"STUDENT":"TEACHER";

			console.log("send req with type="+user_type);

			var xhttp=new XMLHttpRequest();
			xhttp.onreadystatechange=function()
			{
				if(xhttp.readyState ==4 && xhttp.status==200)
				{
					document.getElementById("tbody").innerHTML=xhttp.responseText;
				}
			}
			xhttp.open("GET","../controllers/ProfileController.php?submit=search&name="+name+"&user_type="+user_type,true);
			xhttp.send();
		}
	</script>

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
							<a class="nav-link active" href="#">
								<span data-feather="file"></span>
								Search Profile
							</a>
						</li>
					</ul>
				</div>
			</nav>

			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
				<span class="text-success"><?php if(isset($_COOKIE['success'])) echo $_COOKIE['success'];?></span>

				<h2>Search <?php echo $userInfo['user_type']=="TEACHER"?"Student":"Teacher";?> Profile</h2>

				<div class="row justify-content-center">
					<div class="col-md-12 order-md-1">

						<div class="mb-3">
							<label for="name">Name</label>
							<input type="text" class="form-control" id="name" placeholder="Name" value="" name="name" onkeyup="onKey()">
							<input type="hidden" name="user_type" id="user_type" value="<?php echo $userInfo['user_type'];?>">
						</div>

						<div class="table-responsive">
							<table class="table table-striped table-sm">
								<thead>
									<tr>
										<th>Name</th>
										<th>Phone</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="tbody">
								</tbody>
							</table>
						</div>

					</div>
				</div>

			</main>
		</div>
	</div>
</body>
</html>
