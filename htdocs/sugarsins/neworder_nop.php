<html>
	<head>
		<title> New Order</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<style>
			/* unvisited link */
			a:link {
				color: #43024C;
			}

			/* visited link */
			a:visited {
				color: #43024C;
			}

			/* mouse over link */
			a:hover {
				color: #733E7B;
			}

			/* selected link */
			a:active {
				color: #43024C;
		}
		</style>
	</head>
	<body>
		<?php
			$ordered_by_cid = $_GET['ordered_by_cid'];
			$delivered_to_cid = $_GET['delivered_to_cid'];
		?>
		<nav class="navbar navbar-expand-lg sticky-top navbar-dark" style="background-color: #43024C;">
			<a class="navbar-brand" href="home.php">SugarSins Admin</a>
			<div class="navbar-nav">
				<div class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><b><font color="white">Order</font></b></a>
					<div class="dropdown-menu">
						<a href="neworder.php" class="dropdown-item">New Order</a>
						<a href="updateorder.php" class="dropdown-item">Update Order</a>
					</div>
				</div>
				</div>
				<div>
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link" href="new_user.php"><b><font color="white">Customer</font></b></a>
						</li>
					</ul>
				</div>
				<div class="navbar-nav">
					<div class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><b><font color="white">Menu</font></b></a>
						<div class="dropdown-menu">
							<a href="newmenuitem.php" class="dropdown-item">Add New Items</a>
							<a href="viewmenu.php" class="dropdown-item">View Menu</a>
						</div>
					</div>
				</div>
			</div>
		</nav>
		<center>
			<div class="container-fluid" style="margin-top: 20px;" align="center">
				<div class="row">
					<div class="col-md-8" align="center">
						<div class="card bg-light mb-2">
							<div class="card-header" style="background-color: #F8D6FE;">
								<h3 class="text-left"><i>Shipping Address</i></h3>
							</div>
							<div class="card-body text-left" style="background-color: #F8DFFC;">
							 <form action="neworder_nop.php?ordered_by_cid=<?php $ordered_by_cid = $_GET['ordered_by_cid']; echo $ordered_by_cid; ?>&delivered_to_cid=<?php $delivered_to_cid = $_GET['delivered_to_cid']; echo $delivered_to_cid; ?>" method="post">


									<div class="form-row">

										<div class="form-group col-md-4">
											<label for="cusname">No. of Products</label>
											<input class="form-control" id="nop" type="number" name="nop" value='<?php echo isset($_POST['nop']) ? $_POST['nop'] : ''; ?>' required>
										</div>





									</div>
									<div class="form-row">



									<?php
										require "config.php";
										$link = mysqli_connect("$host", "$user", "$pass", "$db");

										if ($link == false) {
											die ("ERROR: Could not connect. " . mysqli_connect_error());
										}

										if(isset($_POST['nop'])){
												$nop = $_POST['nop'];
												echo "<h3 class='text-right'><b><a href=\"neworder_submit.php?ordered_by_cid=$ordered_by_cid&delivered_to_cid=$delivered_to_cid&nop=$nop\" target=\"_self\"><i>>>NEXT</i></a></b></h3></br>";
										}


										mysqli_close($link);

									?>

								</div>

								</form>
							</div>
						</div>
					</div>

				</div>

			</div>
		</div>
	</center>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
</html>
