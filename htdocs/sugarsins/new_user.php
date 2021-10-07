<html>
	<head>
		<title> New Customer</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<style>
			body {
				background-color: white;
			}
			input[type=text]  {
				width: 40%;
				height: 5%;
				border: 1px;
				border-radius: 05px;
				padding: 8px 15px 8px 15px;
				margin: 10px 0px 10px 0px;
				box-shadow: 1px 1px 2px 1px grey;
			}
			input[type=tel]  {
				width: 40%;
				height: 5%;
				border: 1px;
				border-radius: 05px;
				padding: 8px 15px 8px 15px;
				margin: 10px 0px 10px 0px;
				box-shadow: 1px 1px 2px 1px grey;
			}
			select {
				width: 40%;
				height: 5%;
				border: 1px;
				border-radius: 05px;
				padding: 8px 15px 8px 15px;
				margin: 10px 0px 10px 0px;
				box-shadow: 1px 1px 2px 1px grey;
				<!--background-color: #f1f1f1;-->
			}
			.des {
				width: 80%;
				height: 5%;
			}
		</style>
		<script src="C:/xampp/htdocs/js/jquery.js">

		</script>
	</head>
	<body>
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
					<div class="col-md-12" align="center">
						<div class="card bg-light mb-2">
							<div class="card-header" style="background-color: #F8D6FE;">
								<h3 class="text-center"><i>Adding new customer</i></h3>
							</div>
							<div class="card-body text-center" style="background-color: #F8DFFC;">
								<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
								<!--<div class="form-row">-->

									<label for="cusname">&ensp;&ensp;&ensp;Customer Name<font style="color:red">*</font></label>
									<input type="text" id="cusname" name="cusname" placeholder="Enter Name"/></br>

									<label for="cusphone1">&ensp;&ensp;&ensp;Customer Phone1<font style="color:red">*</font></label>
									<input type="tel" id="cusphone1" name="cusphone1" pattern="[0-9]{10}" placeholder="Enter Phone1"/></br>

									<label for="cusname">&ensp;&ensp;&ensp;Customer Phone2</label>
									<input type="tel" id="cusphone2" name="cusphone2" placeholder="Enter Phone2"/></br>

									<label for="cusname">&ensp;&ensp;&ensp;Customer E-mail</label>
									<input type="text" id="cusemail" name="cusemail" placeholder="Enter E-mail"/></br>

									<label for="cusgender">&ensp;&ensp;&ensp;Customer Gender<font style="color:red">*</font></label>
									<select id="cusgender" name="cusgender" required>
										<option value="" selected></option>
										<option value="M">Male</option>
										<option value="F">Female</option>
										<option value="O">Other</option>
									</select> </br>

									<label for="cuscity">&ensp;&ensp;&ensp;Customer City<font style="color:red">*</font></label>
										<select id="cuscity" name="cuscity">
											<option value="" selected></option>
											<option value="Mumbai">Mumbai</option>
											<option value="Non-Mumbai">Non-Mumbai</option>
										</select></br>

									<label for="cusaddress">&ensp;&ensp;&ensp;Customer Address<font style="color:red">*</font></label>
									<input type="text" id="cusaddress" name="cusaddress" placeholder="Enter Address"/></br>

									<label for="cuscity">Customer Address Identifier<font style="color:red">*</font></label>
									<input type="text" id="cusaddressID" name="cusaddressID" placeholder="Enter Address Identifier"/></br>

									<label for="custype">&ensp;&ensp;&ensp;Customer Type<font style="color:red">*</font></label>
										<select id="custype" name="custype">
											<option value="" selected></option>
											<option value="SO">Shipping-Only (SO)</option>
											<option value="IO">Invoice-Only (IO)</option>
											<option value="SI">Shipping-Invoice (SI)</option>
										</select></br>


									<label for="cusrefby">&ensp;&ensp;&ensp;Lead<font style="color:red">*</font></label>
										<select id="cusrefby" name="cusrefby">
											<option value="" selected></option>
											<option value="Friend">Friend</option>
											<option value="Google">Google</option>
											<option value="Lodha (Colony)">Lodha (Colony)</option>
										</select></br>

									<input class="btn btn-primary" type="submit" value="Submit Details" name="submit">

									<input class="btn btn-primary" type="reset" value="Reset Details" name="reset">

									<?php
										require "config.php";
										$link = mysqli_connect("$host", "$user", "$pass", "$db");

										if ($link == false) {
											die ("ERROR: Could not connect. " . mysqli_connect_error());
										}


										if(isset($_POST['submit'])){
											$cname = trim(strtoupper($_POST['cusname']));			//required
											$cphone1 = trim($_POST['cusphone1']);	//required
											$cphone2 = trim($_POST['cusphone2']);
											$cemail = trim(strtoupper($_POST['cusemail']));
											$ccity = trim(strtoupper($_POST['cuscity']));			//required
											$caddress = trim(strtoupper($_POST['cusaddress']));//required
											$caddressid = trim(strtoupper($_POST['cusaddressID']));//required
											$cref = $_POST['cusrefby'];			//required
											$cgender= $_POST['cusgender'];			//required
											$ctype = $_POST['custype'];			//required

											$customer_id = strtoupper(substr($cname,0,3)) . $cphone1;
											if($cphone2 == ''){
												$cphone2 = null;
											}
											if($cemail == ''){
												$cemail = null;
											}

											$sql = "INSERT INTO customer_master(customer_ID, name, phone1, phone2, email, gender, city, address, address_identifier, customer_type, referenced_by) VALUES ('".$customer_id."','".$cname."','".$cphone1."','".$cphone2."','".$cemail."','".$cgender."','".$ccity."','".$caddress."','".$caddressid."','".$ctype."','".$cref."')";

											if(mysqli_query($link, $sql)) {
												echo '<script>alert("New Customer added!")</script>';
											}
											else {
												if ($cgender <> null && $cname <> null ){
													echo '<script>alert("Error: Record not Inserted!")</script>';
												}
											}


											mysqli_close($link);

										}

									?>

								</form>
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
