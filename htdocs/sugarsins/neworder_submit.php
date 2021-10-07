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
		<script src="js/jquery.js"></script>
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
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
					<div class="col-md-12" align="center">
						<div class="card bg-light mb-2">
							<div class="card-header" style="background-color: #F8D6FE;">
								<h3 class="text-left"><i>Add Order Details</i></h3>
							</div>
							<div class="card-body text-left" style="background-color: #F8DFFC;">
								<form action="neworder_submit.php?ordered_by_cid=<?php $ordered_by_cid = $_GET['ordered_by_cid']; echo $ordered_by_cid; ?>&delivered_to_cid=<?php $delivered_to_cid = $_GET['delivered_to_cid']; echo $delivered_to_cid; ?>&nop=<?php $nop = $_GET['nop']; echo $nop; ?>" method="post">
									<div class="form-row">
										<h6><b>PRODUCT INFO</b></h6>
									</div>
									<?php
										require "config.php";
										$link = mysqli_connect("$host", "$user", "$pass", "$db");

										if ($link == false) {
											die ("ERROR: Could not connect. " . mysqli_connect_error());
										}

										require "configM.php";
										$linkM = mysqli_connect("$host", "$user", "$pass", "$db");

										if ($linkM == false) {
											die ("ERROR: Could not connect. " . mysqli_connect_error());
										}

										$prod_category = array();
										$prod_qty = array();
										$prod_uom = array();

										$sql = "SELECT category_name FROM menu_category ORDER BY category_name";
										if($result = mysqli_query($linkM, $sql)) {
										while($row = mysqli_fetch_array($result)) {
											$cat_name = $row['category_name'];
											array_push($prod_category,$cat_name);
										}
										mysqli_free_result($result);
									}

										$sql = "SELECT qty FROM menu_qty ORDER BY qty";
										if($result = mysqli_query($linkM, $sql)) {
										while($row = mysqli_fetch_array($result)) {
											$qty = $row['qty'];
											array_push($prod_qty,$qty);
										}
										mysqli_free_result($result);
									}

										$sql = "SELECT uom FROM menu_unit_of_measurement ORDER BY uom";
										if($result = mysqli_query($linkM, $sql)) {
										while($row = mysqli_fetch_array($result)) {
											$uom = $row['uom'];
											array_push($prod_uom,$uom);
										}
										mysqli_free_result($result);
									}

											for ($i = 1; $i <= $nop; $i++){
												echo '<div class="form-row">';
												echo '<h7><i>Product '.$i.'</i></h7>';
												echo '</div>';
												echo '<div class="form-row">';
												$cat = "prodcat".$i;
												$fla = "prodflavour".$i;
												$qty = "prodqty".$i;
												$uom = "produom".$i;
												$designdesc = "designdesc".$i;
												$designcharge = "designcharge".$i;
												$fondantdesc = "fondantdesc".$i;
												$fondantcharge = "fondantcharge".$i;
												//echo $cat;echo $fla;echo $qty;echo $uom;


												echo '<div class="form-group col-md-2">';
												$val = isset($_POST[$cat]) ? $_POST[$cat] : 'Product Category';
												$val2 = isset($_POST[$cat]) ? $_POST[$cat] : '';
													echo '<select id="'.$cat.'" name="'.$cat.'" class="form-control" required>';
														echo '<option value="'.$val2.'" selected>'.$val.'</option>';
														for($j=0 ; $j < sizeof($prod_category) ; $j++){
															echo "<option value='".$prod_category[$j]."'>".$prod_category[$j]."</option>";
														}
													echo '</select>';
												echo '</div>';


												echo "<div class='form-group col-md-2'>";
												$val = isset($_POST[$fla]) ? $_POST[$fla] : 'Product Flavour';
												$val2 = isset($_POST[$fla]) ? $_POST[$fla] : '';
													echo '<input class="form-control" id="'.$fla.'" type="text" name="'.$fla.'" value="'.$val2.'" placeholder="'.$val.'" required>';
												echo '</div>';

												echo '<div class="form-group col-md-1">';
												$val = isset($_POST[$qty]) ? $_POST[$qty] : 'Product Quantity';
												$val2 = isset($_POST[$qty]) ? $_POST[$qty] : '';
													echo '<select id="'.$qty.'" name="'.$qty.'" class="form-control" required>';
														echo '<option value="'.$uom.'" selected>'.$val.'</option>';
														for($j=0 ; $j < sizeof($prod_qty) ; $j++){
															echo "<option value='".$prod_qty[$j]."'>".$prod_qty[$j]."</option>";
														}
													echo '</select>';
												echo '</div>';

												echo '<div class="form-group col-md-1">';
												$val = isset($_POST[$uom]) ? $_POST[$uom] : 'Product UOM';
												$val2 = isset($_POST[$uom]) ? $_POST[$uom] : '';
													echo '<select id="'.$uom.'" name="'.$uom.'" class="form-control" required>';
														echo '<option value="'.$val2.'" selected>'.$val.'</option>';
														for($j=0 ; $j < sizeof($prod_uom) ; $j++){
															echo "<option value='".$prod_uom[$j]."'>".$prod_uom[$j]."</option>";
														}
													echo '</select>';
												echo '</div>';

												echo "<div class='form-group col-md-2'>";
												$val = isset($_POST[$designdesc]) ? $_POST[$designdesc] : 'Design Description';
												$val2 = isset($_POST[$designdesc]) ? $_POST[$designdesc] : '';
													echo '<input class="form-control" id="'.$designdesc.'" type="text" name="'.$designdesc.'" value="'.$val2.'" placeholder="'.$val.'">';
												echo '</div>';

												echo "<div class='form-group col-md-1'>";
												$val = isset($_POST[$designcharge]) ? $_POST[$designcharge] : 'Design Charge';
												$val2 = isset($_POST[$designcharge]) ? $_POST[$designcharge] : '';
													echo '<input class="form-control" id="'.$designcharge.'" type="text" name="'.$designcharge.'" value="'.$val2.'" placeholder="'.$val.'">';
												echo '</div>';

												echo "<div class='form-group col-md-2'>";
												$val = isset($_POST[$fondantdesc]) ? $_POST[$fondantdesc] : 'Fondant Description';
												$val2 = isset($_POST[$fondantdesc]) ? $_POST[$fondantdesc] : '';
													echo '<input class="form-control" id="'.$fondantdesc.'" type="text" name="'.$fondantdesc.'" value="'.$val2.'" placeholder="'.$val.'">';
												echo '</div>';

												echo "<div class='form-group col-md-1'>";
												$val = isset($_POST[$fondantcharge]) ? $_POST[$fondantcharge] : 'Fondant Charge';
												$val2 = isset($_POST[$fondantcharge]) ? $_POST[$fondantcharge] : '';
													echo '<input class="form-control" id="'.$fondantcharge.'" type="text" name="'.$fondantcharge.'" value="'.$val2.'" placeholder="'.$val.'">';
												echo '</div>';

											echo '</div>';



										}

									?>
									<div class="form-row">
										</br></br>
									</div>
									<div class="form-row">
										<h6><b>DELIVERY INFO</b></h6>
									</div>
									<div class="form-row">

										<div class="form-group col-md-2">
											<!--<label for="date" class="control-label requiredField">Date<span class="asteriskField">*</span></label>-->
											<input class="form-control" id="date" name="date" placeholder="MM/DD/YYYY" type="text" required>
									 </div>

									 <div class="form-group col-md-2">
										 <!--<label for="time" class="control-label">Time</label>-->
										 <input class="form-control" id="time" name="time" placeholder="24HH:MM" type="text" required/>
									</div>

									<div class="form-group col-md-4">
										<!--<label for="deladd" class="control-label">Delivery Address</label>-->
									 <input type="text" class="form-control" id="deladd" placeholder="Delivery Address" name="deladd" required></input>
									</div>

									<div class="form-group col-md-2">
										<!--<label for="addid" class="control-label">Address Identifier</label>-->
									 <input class="form-control" id="addid" name="addid" placeholder="Address Identifier" type="text" required/>
									</div>

									<div class='form-group col-md-2'>
										<input class="form-control" id="delcharge" type="text" name="delcharge" placeholder="Delivery Charge">
									</div>

								</div>

								<div class="form-row">
									</br></br>
								</div>
								<div class="form-row">
									<h6><b>EVENT INFO</b></h6>
								</div>
								<div class="form-row">
									<?php
										require "config.php";
										$link = mysqli_connect("$host", "$user", "$pass", "$db");

										if ($link == false) {
											die ("ERROR: Could not connect. " . mysqli_connect_error());
										}

										require "configM.php";
										$linkM = mysqli_connect("$host", "$user", "$pass", "$db");

										if ($linkM == false) {
											die ("ERROR: Could not connect. " . mysqli_connect_error());
										}

										$event_category = array();

										$sql = "SELECT event FROM event_masterwx order by event";
										if($result = mysqli_query($link, $sql)) {
											while($row = mysqli_fetch_array($result)) {
												$event = $row['event'];
												array_push($event_category,$event);
											}
										mysqli_free_result($result);
										}

										echo '<div class="form-group col-md-3">';
											echo '<select id="event" name="event" class="form-control">';
												echo '<option value="" selected>Events</option>';
												for($j=0 ; $j < sizeof($event_category) ; $j++){
													echo "<option value='".$event_category[$j]."'>".$event_category[$j]."</option>";
												}
											echo '</select>';
										echo '</div>';

										?>

										<div class=" col-md-3">
											<input class="form-control" id="date2" name="date2" placeholder="MM/DD/YYYY" type="text">
									 </div>

									 <div class=" col-md-3">
										 <!--<label for="date" class="control-label requiredField">Date<span class="asteriskField">*</span></label>-->
										 <input class="form-control" id="event_relation" name="event_relation" placeholder="Relation" type="text">
									</div>

									<div class=" col-md-3">
										<!--<label for="date" class="control-label requiredField">Date<span class="asteriskField">*</span></label>-->
										<input class="form-control" id="event_startyr" name="event_startyr" placeholder="YYYY" type="text">
								 </div>

								 <div class="form-row">
 									</br></br>
 								</div>

								<div class="form-row" align="right">
									<!--<div class=" col-md-5">
									</div>
									<div align="right" class="form-control">-->
										<input class="btn btn-primary" type="submit" value="Submit Order" name="submitorder" style="background-color: #43024C;">
									<!--</div>-->
								</div>

								<?php
								require "config.php";
								$link = mysqli_connect("$host", "$user", "$pass", "$db");

								if ($link == false) {
									die ("ERROR: Could not connect. " . mysqli_connect_error());
								}

								require "configM.php";
								$linkM = mysqli_connect("$host", "$user", "$pass", "$db");

								if ($linkM == false) {
									die ("ERROR: Could not connect. " . mysqli_connect_error());
								}

								$ordered_by_cid = $_GET['ordered_by_cid'];
								$delivered_to_cid = $_GET['delivered_to_cid'];
								$nop = $_GET['nop'];
								//$nop = 2;

								if(isset($_POST['submitorder'])){
									$delivery_date = trim(strtoupper($_POST['date']));
									$delivery_time = trim(strtoupper($_POST['time']));
									$delivery_address = trim(strtoupper($_POST['deladd']));
									$delivery_addID = trim(strtoupper($_POST['addid']));
									$event_name = $_POST["event"];
									$event_date = trim(strtoupper($_POST["date2"]));
									$event_relation = trim(strtoupper($_POST["event_relation"]));
									$event_start_year = trim(strtoupper($_POST["event_startyr"]));
									$delivery_charge = trim(strtoupper($_POST["delcharge"]));

									//$event_date = STR_TO_DATE($event_date, '%m/%d/%Y');
									//$delivery_date = STR_TO_DATE($delivery_date, '%m/%d/%Y');

									//echo $delivery_date . " " . $delivery_time . " " . $delivery_address . " " . $delivery_addID . " " . $event_name . " ";
									//echo $event_date . " " . $event_relation . " " . $event_start_year ;

									$product_category = array();
									$product_flavour = array();
									$product_qty = array();
									$product_uom = array();
									$product_design_desc = array();
									$product_design_charge = array();
									$product_fondant_desc = array();
									$product_fondant_charge = array();
									$product_id = array();
									$product_charge = array();

									for ($i = 1 ; $i <= $nop ; $i++){
										array_push($product_category, $_POST["prodcat".$i]);
										array_push($product_flavour, trim(strtoupper($_POST["prodflavour".$i])));
										array_push($product_qty, $_POST["prodqty".$i]);
										array_push($product_uom, $_POST["produom".$i]);
										array_push($product_design_desc, trim(strtoupper($_POST["designdesc".$i])));
										array_push($product_design_charge, trim($_POST["designcharge".$i]));
										array_push($product_fondant_desc, trim(strtoupper($_POST["fondantdesc".$i])));
										array_push($product_fondant_charge, trim($_POST["fondantcharge".$i]));

									}
									// for ($k = 0 ; $k < $nop ; $k++){
									// 	echo $product_qty[$k];
									// 	echo '<br>';
									// }

									for ($k = 0 ; $k < $nop ; $k++){
										if($product_qty[$k] == 0.50) {
											$temp = strtoupper($product_category[$k].$product_flavour[$k].$product_qty[$k] . $product_uom[$k]);
											array_push($product_id,$temp);
										} else {
											$temp = strtoupper($product_category[$k].$product_flavour[$k]."1.00". $product_uom[$k]);
											array_push($product_id,$temp);
										}

										//echo $product_category[$k] . " " . $product_flavour[$k] . " " . $product_qty[$k] . " " . $product_uom[$k] . " " ;
										//echo $product_design_desc[$k] . " " . $product_design_charge[$k] . " " . $product_fondant_desc[$k] . " " . $product_fondant_charge[$k];
									}

									//1- INSERT INTO order_for(invoice_customer, shipping_customer, order_id) VALUES ([value-1],[value-2],[value-3])
									//2- INSERT INTO order_line(order_id, product_id, quantity, design_description, design_charge, fondant_description, fondant_charge) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7])
									//3- INSERT INTO order_master(order_id, ordered_by, delivered_to, delivery_address, address_identifier, delivery_date, delivery_time) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7])
									//4- INSERT INTO order_event(order_id, customer_id, event, event_date, relation, event_start_year) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6])
									//5- INSERT INTO order_finance(order_id, product_charge, total_design_charge, total_fondant_charge, delivery_charge, payment_method, paid) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7])
									//6- INSERT INTO customer_event_master(customer_id, event, event_date, relation, event_start_year) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5])

									$dateAsUnixTimestamp = strtotime($delivery_date);
									$delivery_month = date('m',$dateAsUnixTimestamp);
									$delivery_day = date('d',$dateAsUnixTimestamp);
									$delivery_year = date('y',$dateAsUnixTimestamp);

									$order_id = strtoupper($delivery_day.$delivery_month.$delivery_year.$ordered_by_cid);

									$check_array = array();

									$sql = 'INSERT INTO order_master(order_id, ordered_by, delivered_to, delivery_address, address_identifier, delivery_date, delivery_time)
								 	VALUES ("'.$order_id.'","'.$ordered_by_cid.'","'.$delivered_to_cid.'","'.$delivery_address.'","'.$delivery_addID.'",STR_TO_DATE("'.$delivery_date.'","%m/%d/%Y") ,"'.$delivery_time.'")';

									//echo $sql . "<br>";
									if(mysqli_query($link, $sql)) {
										echo "Order Master Updated    <br>";
									 	array_push($check_array, 'order_master');
								 	}
								 	else {
										array_push($check_array, '');
									}

									$sql = 'INSERT INTO order_for(invoice_customer, shipping_customer, order_id) VALUES ("'.$ordered_by_cid.'","'.$delivered_to_cid.'","'.$order_id.'")';

									//echo $sql."<br>";
									if(mysqli_query($link, $sql)) {
										echo "Order CR Updated   <br>";
									 	array_push($check_array, 'order_for');
									}
									else {
										array_push($check_array, '');
										$sql = 'delete from order_master where order_id like "'.$order_id.'" ';
										mysqli_query($link, $sql);
									}


									for ($k = 0 ; $k < $nop ; $k++){
										$sql = 'INSERT INTO order_line(order_id, product_id, qty, design_description, design_charge, fondant_description, fondant_charge)
										VALUES ("'.$order_id.'","'.$product_id[$k].'","'.$product_qty[$k].'","'.$product_design_desc[$k].'","'.$product_design_charge[$k].'","'.$product_fondant_desc[$k].'","'.$product_fondant_charge[$k].'")';
										//echo $sql."<br>";
										if(mysqli_query($link, $sql)) {
											echo "Order product Line Updated  <br>";
											array_push($check_array, 'order_line'.$k);
										}
										else {
											array_push($check_array, '');
											$sql = 'delete from order_master where order_id like "'.$order_id.'" ';
											mysqli_query($link, $sql);
											$sql = 'delete from order_for where order_id like "'.$order_id.'" ';
											mysqli_query($link, $sql);
											$sql = 'delete from order_line where order_id like "'.$order_id.'" ';
											mysqli_query($link, $sql);
										}
									}


									$sql = 'INSERT INTO order_event(order_id, customer_id, event, event_date, relation, event_start_year)
									VALUES ("'.$order_id.'","'.$ordered_by_cid.'","'.$event_name.'",STR_TO_DATE("'.$event_date.'","%m/%d/%Y"),"'.$event_relation.'","'.$event_start_year.'")';
									//echo $sql . "<br>";
									if(mysqli_query($link, $sql)) {
										echo "Order Event Updated <br>";
									}
									else {}


									//5- INSERT INTO order_finance(order_id, product_charge, total_design_charge, total_fondant_charge, delivery_charge, payment_method, paid) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7])
									//6- INSERT INTO customer_event_master(customer_id, event, event_date, relation, event_start_year) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5])


									$sql = "select * from customer_event_master where customer_id like '".$ordered_by_cid."' and event like '".$event_name."' and event_date = STR_TO_DATE('".$event_date."','%m/%d/%Y') and relation like '".$event_relation."'";
									$result = mysqli_query($link, $sql);
									$existing_events = mysqli_num_rows($result);
									if($existing_events == 0) {
										$sql = 'INSERT INTO customer_event_master(customer_id, event, event_date, relation, event_start_year)
										VALUES ("'.$ordered_by_cid.'","'.$event_name.'",STR_TO_DATE("'.$event_date.'","%m/%d/%Y"),"'.$event_relation.'","'.$event_start_year.'")';
										//echo $sql . "<br>";
										if(mysqli_query($link, $sql)) {
											echo "Customer Event Master Updated <br>";
										}
										else {
											$sql = 'delete from order_event where order_id like "'.$order_id.'" ';
											mysqli_query($link, $sql);
											$sql = 'delete from customer_event_master where customer_id like "'.$ordered_by_cid.'" and event like "'.$event_name.'" and relation like "'.$event_relation.'" and event_start_year="'.$event_start_year.'" and event_date=STR_TO_DATE("'.$event_date.'","%m/%d/%Y")';
											mysqli_query($link, $sql);
										}
								}

								$total_order_bill = 0;

								$design_charge = array();
								$total_design_charge = 0;

								$fondant_charge = array();
								$total_fondant_charge = 0;

								$product_charge = array();
								$total_product_charge = 0;


									for ($k = 0; $k < $nop; $k++) {
										array_push($design_charge,(float)$product_design_charge[$k]);
										array_push($fondant_charge,(float)$product_fondant_charge[$k]);
										$temp_charge = 0;
										//echo 'round'.$k.'rate is'.$temp_charge;
										//$temp_charge = (float)$product_design_charge[$k]  +(float)$product_fondant_charge[$k];

										if($product_uom[$k] == 'kg(s)' ) {
											if($product_qty[$k] == 0.50 || $product_qty[$k] == 1.00) {
												//$sql = 'select rate from menu where category like "'.$product_category[$k].'"  and flavour like "'.$product_flavour[$k].'" and std_quantity='.$product_qty[$k].' and unit_of_measure like "'.$product_uom[$k].'"';
												$sql = 'select rate from menu where product_id like "'.$product_id[$k].'"';
												$result = mysqli_query($link, $sql);
												if ($result) {
													while($row = mysqli_fetch_array($result)) {
														$rate = $row['rate'];
													}
												}
												//echo 'round'.$k.'rate is'.$rate;
												$temp_charge += (float)$rate;
												echo 'round'.$k.'temp_charge is'.$temp_charge.'<br>';

											//} else if ($product_qty > 1.00) {
											} else {
												$sql = 'select rate from menu where category like "'.$product_category[$k].'"  and flavour like "'.$product_flavour[$k].'" and unit_of_measure like "'.$product_uom[$k].'" where std_quantity=1.00';
												$result = mysqli_query($link, $sql);
												if ($result) {
													while($row = mysqli_fetch_array($result)) {
														$rate = $row['rate'];
													}
												}
												//echo 'round'.$k.'rate is'.$rate;
												$temp_price = (float)$rate * (float)$product_qty[$k];
												//echo 'round'.$k.'temp price is'.$temp_price;
												$temp_charge += (float)$temp_price;
												echo 'round'.$k.'temp_charge is'.$temp_charge.'<br>';

											}
										} else {
											$sql = 'select rate from menu where category like "'.$product_category[$k].'"  and flavour like "'.$product_flavour[$k].'" and unit_of_measure like "'.$product_uom[$k].'" and std_quantity=1.00';
											//echo $sql;

											$result = mysqli_query($link, $sql);
											if ($result) {
												while($row = mysqli_fetch_array($result)) {
													$rate = $row['rate'];
													echo $rate;
												}
											}
											//echo 'round'.$k.'rate is'.$rate;
											$temp_price = (float)$rate * (float)$product_qty[$k];
											//echo 'round'.$k.'temp price is'.$temp_price;
											$temp_charge += (float)$temp_price;
											echo 'round'.$k.'temp_charge is'.$temp_charge.'<br>';

										}

										array_push($product_charge, $temp_charge);
									}

									$total_design_charge = array_sum($design_charge);
									$total_fondant_charge = array_sum($fondant_charge);
									$total_product_charge = array_sum($product_charge);

									if($delivery_charge == ''){
										$delivery_charge = 0;
									}
									$total_order_bill = $total_design_charge + $total_fondant_charge + $total_product_charge + (float)$delivery_charge;

									$sql = 'INSERT INTO order_finance(order_id, product_charge, total_design_charge, total_fondant_charge, delivery_charge, total_bill, payment_method, paid)
									VALUES ("'.$order_id.'","'.$total_product_charge.'","'.$total_design_charge.'","'.$total_fondant_charge.'","'.$delivery_charge.'","'.$total_order_bill.'", null, null)';

									//echo $sql . "<br>";
									if(mysqli_query($link, $sql)) {
										echo "Order Finance Updated<br>";
										array_push($check_array, 'order_finance');
									}
									else {
										array_push($check_array, '');
										$sql = 'delete from order_master where order_id like "'.$order_id.'" ';
										mysqli_query($link, $sql);
										echo "Order Master Rollbacked<br>";
										$sql = 'delete from order_for where order_id like "'.$order_id.'" ';
										mysqli_query($link, $sql);
										echo "Order CR Rollbacked<br>";
										$sql = 'delete from order_line where order_id like "'.$order_id.'" ';
										mysqli_query($link, $sql);
										echo "Order Product Line Rollbacked<br>";
										$sql = 'delete from order_event where order_id like "'.$order_id.'" ';
										mysqli_query($link, $sql);
										echo "Order Event Rollbacked<br>";
										$sql = 'delete from customer_event_master where customer_id like "'.$ordered_by_cid.'" and event like "'.$event_name.'" and relation like "'.$event_relation.'" and event_start_year="'.$event_start_year.'" and event_date=STR_TO_DATE("'.$event_date.'","%m/%d/%Y")';
										mysqli_query($link, $sql);
										echo "Customer Master Rollbacked<br>";
									}

									$checkvar = 0;
									$errorin = '';
									if($check_array[0] == 'order_master' && $check_array[1] == 'order_for') {
										for($k=0; $k<$nop; $k++){
											if($check_array[2+$k] == ('order_line'.$k)){
												continue;
											} else {
												$checkvar++;
												$errorin = ' line ';
											}
										}
										if($check_array[2+$nop] == 'order_finance'){
											// go to another page
											//pass order ID
											//echo "HURRAY!!!!!!!!".$order_id;
											echo "<h3 class='text-right'><b><a href=\"order_status.php?order_id=$order_id&errorstr=$errorin\" target=\"_self\"><i>>>ORDER STATUS</i></a></b></h3></br>";


										} else {
											$checkvar++;
											$errorin = ' finance ';
										}
									} else {
										$checkvar++;
										$errorin = ' master ';
									}

									if($checkvar > 0 ){
										//go to another page
										//print details entered are not correct
										// pass $errorin
										//echo "WHY IS THIS NOT WORKING !!!!!!!!!";
										echo "<h3 class='text-right'><b><a href=\"order_status.php?order_id=$order_id&errorstr=$errorin\" target=\"_self\"><i>>>ORDER STATUS</i></a></b></h3></br>";
									}
									//echo '<script>alert("'.$msg.'")</script>';




								}







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
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script>
		$(document).ready(function(){
			var date_input=$('input[name="date"]'); //our date input has the name "date"
			var date_input2 = $('input[name="date2"]');
			var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
			var options={
				format: 'mm/dd/yyyy',
				container: container,
				todayHighlight: true,
				autoclose: true,
			};
			date_input.datepicker(options);
			date_input2.datepicker(options);
		})
	</script>
</body>
</html>
