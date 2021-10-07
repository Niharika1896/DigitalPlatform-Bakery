<html>
	<head>
		<title> Menu</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
								<h3 class="text-left"><i>Menu : See Product List</i></h3>
							</div>
							<div class="card-body text-left" style="background-color: #F8DFFC;">
								<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
									<div class="form-row">

										<div class="form-group col-md-3">
											<label for="prodcat">Category</label>
											<select id="prodcat" name="prodcat" class="form-control">
												<option value="" selected>Product Category</option>
												<?php

													require "configM.php";
													$link = mysqli_connect("$host", "$user", "$pass", "$db");
													if ($link == false) {
														die ("ERROR: Could not connect. " . mysqli_connect_error());
													}

													$sql = "SELECT category_name FROM menu_category ORDER BY category_name";
													if($result = mysqli_query($link, $sql)) {
														while($row = mysqli_fetch_array($result)) {
															$name = $row['category_name'];
															echo "<option value='".$name."'>".$name."</option>";
														}
														mysqli_free_result($result);
													}
													mysqli_close($link);
												?>
											</select>
										</div>

										<div class="form-group col-md-3">
											<label for="prodflavour">Flavour</label>
											<input class="form-control" id="prodflavour" type="text" name="prodflavour" placeholder="Product Name">
										</div>

										<div class="form-group col-md-2">
											<label for="prodqty">Quantity</label>
											<select id="prodqty" name="prodqty" class="form-control">
												<option value="" selected>Standard Qty</option>
												<?php

													require "configM.php";
													$link = mysqli_connect("$host", "$user", "$pass", "$db");
													if ($link == false) {
														die ("ERROR: Could not connect. " . mysqli_connect_error());
													}

													$sql = "SELECT qty FROM menu_qty ORDER BY qty";
													if($result = mysqli_query($link, $sql)) {
														while($row = mysqli_fetch_array($result)) {
															$name = $row['qty'];
															echo "<option value='".$name."'>".$name."</option>";
														}
														mysqli_free_result($result);
													}
													mysqli_close($link);
												?>
											</select>
										</div>

										<div class="form-group col-md-2">
											<label for="produom">UOM</label>
											<select id="produom" name="produom" class="form-control">
												<option value="" selected><i>UOM</i></option>
												<?php

													require "configM.php";
													$link = mysqli_connect("$host", "$user", "$pass", "$db");
													if ($link == false) {
														die ("ERROR: Could not connect. " . mysqli_connect_error());
													}

													$sql = "SELECT uom FROM menu_unit_of_measurement ORDER BY uom";
													if($result = mysqli_query($link, $sql)) {
														while($row = mysqli_fetch_array($result)) {
															$name = $row['uom'];
															echo "<option value='".$name."'>".$name."</option>";
														}
														mysqli_free_result($result);
													}
													mysqli_close($link);
												?>
											</select>
										</div>

										<div class="form-group col-md-2">
											<div class="autocomplete">
												<label for="prodrate">Rate (₹)</label>
												<input class="form-control" id="prodrate" type="text" name="prodrate" placeholder="Rate">
											</div>
										</div>

									</div>

									<div align="center">
										<input class="btn btn-primary" type="submit" value="See Menu" name="SEARCH" style="background-color: #43024C;">
									</div>

									<?php
										require "config.php";
										$link = mysqli_connect("$host", "$user", "$pass", "$db");

										if ($link == false) {
											die ("ERROR: Could not connect. " . mysqli_connect_error());
										}


										if(isset($_POST['SEARCH'])) {
											$prodcat = $_POST['prodcat'];
											$prodflavour = strtoupper($_POST['prodflavour']);
											$prodqty = $_POST['prodqty'];
											$produom = $_POST['produom'];
											$prodrate = $_POST['prodrate'];

                      if($prodqty == '' && $prodrate <> '') {
                        $sql = "SELECT category, flavour, std_quantity, unit_of_measure, rate FROM menu WHERE category like '%".$prodcat."' and flavour like '%".$prodflavour."' and unit_of_measure like '%".$produom."' and rate = ".$prodrate." ";
                      }
                      if($prodqty <> '' && $prodrate == '') {
                        $sql = "SELECT category, flavour, std_quantity, unit_of_measure, rate FROM menu WHERE category like '%".$prodcat."' and flavour like '%".$prodflavour."' and unit_of_measure like '%".$produom."' and qty = ".$prodqty." ";
                      }
                      if($prodqty == '' && $prodrate == '') {
                        $sql = "SELECT category, flavour, std_quantity, unit_of_measure, rate FROM menu WHERE category like '%".$prodcat."' and flavour like '%".$prodflavour."' and unit_of_measure like '%".$produom."' ";
                      }

                      $result = mysqli_query($link, $sql);

                      //echo mysqli_num_rows($result);
                      if ($result) {

                        $no_of_cols = 100 / 5;
                        echo "<br><b><h6><i><center>".mysqli_num_rows($result)." products found in matching the search condition</center></i></h6></b>";
                        echo "<div class='table-responsive'>";
    										echo "<table class='table table-bordered'><thead class=\"thead-dark\"><tr>";
    										echo "<th width=\"$no_of_cols%\" class='text-center' style='background-color: #43024C;'><i>Category</i></th>";
    										echo "<th width=\"$no_of_cols%\" class='text-center' style='background-color: #43024C;'><i>Flavour</i></th>";
    										echo "<th width=\"$no_of_cols%\" class='text-center' style='background-color: #43024C;'><i>Quantity</i></th>";
    										echo "<th width=\"$no_of_cols%\" class='text-center' style='background-color: #43024C;'><i>UOM</i></th>";
    										echo "<th width=\"$no_of_cols%\" class='text-center' style='background-color: #43024C;'><i>Rate (₹)</i></th>";

    										echo "</tr></thead>";

                        while($row = mysqli_fetch_array($result)) {
                          $res_pcat = $row['category'];
                          $res_pflav = $row['flavour'];
                          $res_pqty = $row['std_quantity'];
                          $res_puom = $row['unit_of_measure'];
                          $res_prate = $row['rate'];

                          echo "<tr>";

                          echo "<td>$res_pcat</td>";
    											echo "<td>$res_pflav</td>";
    											echo "<td>$res_pqty</td>";
    											echo "<td>$res_puom</td>";
    											echo "<td>$res_prate</td>";

    											echo "</tr>";
                        }

    									echo "</table>";
                      echo "</div>";
    									mysqli_free_result($result);


											mysqli_close($link);

										}
                    else {
                      echo "<br><b><h4><center>0 products found in matching the search condition</center></h4></b>";
                    }
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
