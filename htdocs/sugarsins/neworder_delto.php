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
		<?php $ordered_by_cid = $_GET['ordered_by_cid']; ?>
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
							 <form action="neworder_delto.php?ordered_by_cid=<?php $ordered_by_cid = $_GET['ordered_by_cid']; echo $ordered_by_cid; ?>" method="post">


									<div class="form-row">

										<div class="form-group col-md-4">
											<label for="cusname">Name</label>
											<input class="form-control" id="cusname" type="text" name="cusname" value='<?php echo isset($_POST['cusname']) ? $_POST['cusname'] : ''; ?>' required>
										</div>

										<div class="form-group col-md-4">
											<label for="cusphone">Phone</label>
											<input class="form-control" id="cusphone" type="text" name="cusphone" value='<?php echo isset($_POST['cusphone']) ? $_POST['cusphone'] : ''; ?>' required>
										</div>

										<div class="form-group col-md-2">
											<label for="Search">Check if customer exist</label>
											<input  class="form-control"  id="Check" class="btn btn-primary" type="submit" value="Check" name="Check" style="background-color: #C49BCA;">
										</div>



									</div>



									<?php
										require "config.php";
										$link = mysqli_connect("$host", "$user", "$pass", "$db");

										if ($link == false) {
											die ("ERROR: Could not connect. " . mysqli_connect_error());
										}



										$delivered_to__cid = "";
										$delivered_to__cname = "";

										if(isset($_POST['Check'])){
											$cname = strtoupper($_POST['cusname']);
											$cphone = $_POST['cusphone'];


											$sql = "select * from customer_master where lower(name) like '%".$cname."' and (phone1 like '%".$cphone."' or phone2 like '%".$cphone."') ";

											$result = mysqli_query($link, $sql);
											$nrow = mysqli_num_rows($result);

											if($result) {
												if($nrow == 1) {
													echo "</br><h6 class='text-center'><b>1 Customer Match Found</b></h6></br>";

													while($row = mysqli_fetch_array($result)) {
														$delivered_to_cid = $row['customer_ID'];
														$delivered_to_cname = $row['name'];
													}

													echo "<h5 class='text-left'><i>". strtoupper($delivered_to_cname) . "</i></h5></br>";

													echo "<h3 class='text-right'><b><a href=\"neworder_nop.php?ordered_by_cid=$ordered_by_cid&delivered_to_cid=$delivered_to_cid\" target=\"_self\"><i>>>NEXT</i></a></b></h3></br>";

												} else if($nrow==0) {
														echo "</br><h6 class='text-center'><b>No Customer Match Found.</b></h6></br>";
														echo "</br><h6 class='text-center'><b>Enter new customer details first <a href=\"new_user.php\" target=\"_self\">here</a></b></h6></br>";
												} else {

												}
											} else {




											}




										}

										mysqli_close($link);

									?>

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
