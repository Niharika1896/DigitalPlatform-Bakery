<html>
	<head>
		<title> Order Status</title>
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
      <?php
      $order_id = $_GET['order_id'];
      $errorstr = $_GET['errorstr'];
      if($errorstr == ''){
        $order_status = 'Successful';
      } else {
        $order_status = 'Unsuccessful';
      }
      ?>
			<div class="container-fluid" style="margin-top: 20px;" align="center">
				<div class="row">
					<div class="col-md-12" align="center">
						<div class="card bg-light mb-2">
							<div class="card-header" style="background-color: #F8D6FE;">
								<?php
                echo '<h3 class="text-left"><i>Order Status: '.$order_status.'</i></h3>';
                ?>
							</div>
							<div class="card-body text-left" style="background-color: #F8DFFC;">
                <?php
                if($order_status == 'Successful'){
									require "config.php";
									$link = mysqli_connect("$host", "$user", "$pass", "$db");

									if ($link == false) {
										die ("ERROR: Could not connect. " . mysqli_connect_error());
									}

									$sql = "select ordered_by, delivered_to, delivery_address, address_identifier, delivery_date, delivery_time from order_master where order_id = '".$order_id."' ";
									$result = mysqli_query($link, $sql);

									while($row = mysqli_fetch_array($result)) {
										$ordered_by = $row['ordered_by'];
										$delivered_to = $row['delivered_to'];
										$delivery_address = $row['delivery_address'];
										$delivery_date = $row['delivery_date'];
										$delivery_time = $row['delivery_time'];

									}

									$sql = "select name from customer_master where customer_ID = '".$delivered_to."'";
									$result = mysqli_query($link, $sql);
									while($row = mysqli_fetch_array($result)) {
										$delivered_to_name = $row['name'];
									}

									$sql = "select name from customer_master where customer_ID = '".$ordered_by."'";
									$result = mysqli_query($link, $sql);
									while($row = mysqli_fetch_array($result)) {
										$ordered_by_name = $row['name'];
									}

									$sql = "select product_charge, total_design_charge, total_fondant_charge, delivery_charge, total_bill, payment_method, paid FROM order_finance Where order_id= '".$order_id."' ";
									$result = mysqli_query($link, $sql);

									while($row = mysqli_fetch_array($result)) {
										$total_bill = $row['total_bill'];
										$delivery_charge = $row['delivery_charge'];

									}

                  echo '<h5 class="text-left">Hi '.$ordered_by_name.', Your order with SugarSins is confirmed :)</h5>';
									echo '<h5 class="text-left">Your Order ID is '.$order_id.'</h5>';
									echo '<h5 class="text-left">Order to be delivered to '.$delivered_to_name.' on '.$delivery_date.' at time '.$delivery_time.' hrs. Delivery address: '.$delivery_address.'</h5>';
									echo '<h5 class="text-left">Total Bill: ₹'.$total_bill.'</h5>';
                  echo '<a href="https://api.whatsapp.com/send?phone=8369657140?text=hi whatsup" target="_blank" class="social-icon whatsapp">Whatsapp';
                  echo '<i class="fa fa-whatsapp my-float"></i>';
                  echo '<img src="whatsapp.jpg" class="float" width=100% height=100%';
                  echo '</a>';
                } else {
                  echo '<h5 class="text-left">Some error occured while entering the following info-</h5>';
                  if (strpos($errorstr, 'master') >= 0){
                    echo 'Customer or Delivery Details';
                  }
                  if (strpos($errorstr, 'line') >= 0){
                    echo 'Product Details';
                  }
                  if (strpos($errorstr, 'finance') >= 0){
                    echo 'Error encountered while calculating Bill Amount';
                  }
                }
                ?>
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
