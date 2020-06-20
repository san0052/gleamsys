<!doctype html>
<html lang="en">
  <?
$_SESSION['site']=2;
include_once("includes/frontend.init.php");
include_once("includes/function.php");
  ?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?
    getHeadercss();

    $orderids=$_REQUEST['orderid'];
	$orderid=end(explode('-', $_REQUEST['orderid']));
	$sql_order="SELECT * FROM".$cfg['DB_ORDER']." WHERE od_id='".$orderid."'";
	$res_order=$mycms->sql_select($sql_order);
	$row_order=$res_order[0];
    ?>
	<title>Instant Pay | Rainbow Florist</title>
  </head>
  <body>
	<? include_once('includes/header.php');?>
    <section class="innermaincon">		
		<div class="">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12 breadcust">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Instant Pay</li>
							</ol>
						</nav>
					</div>
				</div>
				<div class="row inspaysec">
					<div class="col-sm-12 col-md-12">
						<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" name="frmqckshop" id="frmqckshop"  onsubmit="return chk_quick_shop()"> 
							<input type="hidden" name="cust_id" id="cust_id" value="<?=$_SESSION['userid']!=''?$_SESSION['userid']:'0'?>"> 
							<input type="hidden" name="email" id="email" value="<?=$row1['email']?>">
							<input type="hidden" name="charge" id="charge" value="0">
							<input type="hidden" name="shipping_type" id="shipping_type" value="<?=$shipping_type?>">
							<input type="hidden" name="extra_charge" id="extra_charge" value="">
							<input type="hidden" name="delivery_time" id="delivery_time" value="<?=$delivery_time?>">
							<input type="hidden" name="delivery_date" id="delivery_date" value="<?=$delivery_date?>">
							<div class="row">
								<div class="col-sm-12 col-md-12">
									<h2 class="desched">Instant Pay</h2>
								</div>
								<div class="col-sm-12 col-md-12 orderinlinebox">
									<div class="form-group orderfrm">
										<input type="text" class="form-control revfrmdec" placeholder="Order ID" name="orderid" id="orderid" value="<?=$_REQUEST['orderid'];?>">
									</div>
									<button type="submit" class="btn pinkbtn subbtn"><span class="faicon"><i class="fas fa-hand-point-up fa-lg"></i></span>Submit</button>
									<div class="clearfix"></div>
								</div>
						</form>

						<div class="col-sm-6 col-md-6">
						<form action="instantpay_process.php" method="post"  onsubmit="return chk_quick_shop()">
						<input type="hidden" name="cust_id" id="cust_id" value="<?=$row_order['cust_id']?>"> 
						<input type="hidden" name="charge" id="charge" value="0">
						<input type="hidden" name="extra_charge" id="extra_charge" value="">
						<input type="hidden" class="form-control" id="hidShippingEmail" name="hidShippingEmail" value="<?=$row_order['od_shipping_email']?>"/>										
						<input name="action" type="hidden" value="checkout">
						<input name="orderId" type="hidden" value="<?=$orderid;?>">
						<input name="order_shipping_sender_name" type="hidden" value="<?=$row_order['order_shipping_sender_name'];?>">
						<input name="grndAmount" type="hidden" value="<?=$row_order['od_amount'];?>">
						<input name="order_msg" type="hidden" value="<?=$row_order['od_shipping_msg'];?>">
								
									<div class="anileft">
										<h4 class="desched">Shipping Details</h4>
										<? 
										$_SESSION['userid'];
										
										$sql1 = "SELECT * FROM ".$cfg['DB_CUSTOMER']." WHERE `id` = '".$row_order['cust_id']."' ";
										$result1 = $mycms->sql_select($sql1);
										$row1 = $result1[0];
										$maxrow_1=$mycms->sql_numrows($result1);
										
										
											if($row_order['cust_id']!=""){
											
												$sql_b= "SELECT  * FROM ".$cfg['DB_CUSTOMER_DETAILS']." WHERE `cust_id` = '".$row_order['cust_id']."' AND `details`= 'billing'";
												$result_b = $mycms->sql_select($sql_b);
												$row_b   = $mycms->sql_fetchrow($result_b);
												
												$sql_s = "SELECT * FROM ".$cfg['DB_CUSTOMER_DETAILS']." WHERE `cust_id` = '".$row_order['cust_id']."' AND `details`= 'shipping' ";
												$result_s = $mycms->sql_select($sql_s);
												$row_s= $mycms->sql_fetchrow($result_s);
											}
											$row_order['od_delivery_date'];
										?>									
										<div class="form-group">
											<input type="text" class="form-control revfrmdec" id="hidShippingFirstName" name="hidShippingFirstName" value="<?=$row_order['od_shipping_first_name']?>" >

												
										</div>
										<div class="form-group">
											<input type="email" class="form-control revfrmdec emailtxt" placeholder="Email" id="hidShippingEmail" name="hidShippingEmail"
											value="<?=$row_order['od_shipping_email']?>"/>
										</div>
										<div class="form-group">
											<input type="text" class="form-control revfrmdec fixcode" id="" placeholder="+91">
											<input type="text" class="form-control revfrmdec mobcode" id="hidShippingPhone" name="hidShippingPhone"
                                             value="<?=$row_order['od_shipping_phone']?>">
											<div class="clearfix"></div>
										</div>
										<div class="form-group">
													<?
														
													$sql_cname="SELECT * FROM ".$cfg['DB_COUNTRY_MASTER']." where `country_id`=1";
													$res_cname=$mycms->sql_select($sql_cname);
													foreach ($res_cname as $key => $value) 
													{
														
													?>
													
													<input type="text" class="form-control revfrmdec" style="background-color: white;" name="hidShippingCountry" id="hidShippingCountry"
											value="<?=$value['country_name']?>" placeholder="Enter Country name " readonly="readonly">
											
											<? 
												} 
											?>
										</div>
										<div class="form-group" id="state_reg_placeholders">
											
												<?
													$sql_sname="SELECT * FROM ".$cfg['DB_STATE']." WHERE `country_id`=1 AND state_name='".$row_order['od_shipping_state']."' ORDER BY `state_name`";
													$res_sname=$mycms->sql_select($sql_sname);
													$numrows=$mycms->sql_numrows($res_sname);
													//while($row_sname=$heart->sql_fetchrow($res_sname)){
												?>
														<input type="text" class="form-control revfrmdec"  style="background-color: white;"  name="hidShippingState" id="hidShippingState"
											value="<?=$row_order['od_shipping_state']?>" placeholder="Enter State name " readonly="readonly">
														
												<? 
													//} 
												?>
								
										</div>
										<div class="form-group" id="city_reg_placeholders">
												<?
													$sql_pd = "SELECT cty.*, cntry.country_name 
																 FROM ".$cfg['DB_CITIES']." cty
													  LEFT OUTER JOIN ".$cfg['DB_STATE']." ste 
															       ON ste.st_id = cty.state_id
												      LEFT OUTER JOIN ".$cfg['DB_COUNTRY_MASTER']." cntry
												                   ON ste.country_id = cntry.country_id
																WHERE cty.state_id IN ( select st_id from ".$cfg['DB_STATE']."WHERE `country_id`='1') 
																  AND cty.status='A'
																  AND cty.ct_id='".$row_order['od_shipping_city']."'
															 ORDER BY country_name, city_name";
													$res_pd = $mycms->sql_select($sql_pd);
													$row_pd = $res_pd[0];	
													$maxrow_pd=$mycms->sql_numrows($res_pd);
													
												?>
												<input type="hidden" class="form-control" name="hidShippingCity" id="hidShippingCity" value="<?=$row_order['od_shipping_city']?>" placeholder="Enter city " readonly="readonly">
											
											<input type="text" class="form-control revfrmdec" style="background-color: white;"   name="hidShippingCityDisplay" id="hidShippingCityDisplay" value="<?=stripslashes($row_pd['city_name'])?>" placeholder="Enter city " readonly="readonly">
											
										
										</div>
										<div class="form-group">
											<input type="text" class="form-control revfrmdec" placeholder="Pincode" name="hidShippingPostalCode" id="hidShippingPostalCode"
											value="<?=$row_order['od_shipping_postal_code']?>" placeholder="Enter Zip Code">
										</div>
										<div class="form-group">
											<textarea class="form-control revfrmdec" rows="2" name="hidShippingAddress1" id="hidShippingAddress1" placeholder="Address"><?=$row_order['od_shipping_address1'];?></textarea>
										</div>
									</div>
								</div>
								<div class="col-sm-6 col-md-6">
									<div class="aniright">
										<h4 class="desched">Billing Details</h4>
										<div class="form-group">
											<input type="text" class="form-control revfrmdec" id="hidPaymentFirstName" 
                                              name="hidPaymentFirstName" value="<?=$row_order['od_payment_first_name']?>">
										</div>
										<div class="form-group">
											<input type="email" class="form-control revfrmdec emailtxt" placeholder="Email" id="hidBillingEmail" name="hidBillingEmail"
											value="<?=$row_order['od_payment_email']?>"/>
										</div>
										<div class="form-group">
											<input type="text" class="form-control revfrmdec fixcode" id="" placeholder="+91">
											<input type="text" class="form-control revfrmdec mobcode" name="hidPaymentPhone" id="hidPaymentPhone" 
												value="<?=$row_order['od_payment_phone'] ?>">
											<div class="clearfix"></div>
										</div>
										<div class="form-group">
											<select class="custom-select" name="hidPaymentCountry" id="hidPaymentCountry">
												<?
													$sql_cname="SELECT * FROM ".$cfg['DB_COUNTRY_MASTER']." ORDER BY `country_name`";
													$res_cname=$mycms->sql_select($sql_cname);
													foreach ($res_cname as $key => $value) {
														
													
												?>
														<option value="<?=$value['country_name']?>" <?=($row_order['od_payment_country']==$value['country_name'])?'selected="selected"':''; ?>><?=$value['country_name']?></option>
												<? 
													} 
												?>
											</select>
										</div>
										<div class="form-group" id="state_reg_placeholder" >
											<select class="custom-select"  name="hidPaymentState" id="hidPaymentState">
												<? 
													$payment_state=$_SESSION['userid']!=''?$row_b['state']:$row_t['od_payment_state'];
													$sql_sname="SELECT * FROM ".$cfg['DB_STATE']." WHERE `country_id`=1 ORDER BY `state_name`";
													$res_sname=$mycms->sql_select($sql_sname);
													foreach ($res_sname as $key => $value) {
														
													
												?>
														<option value="<?=$value['state_name']?>" <?=($row_order['od_payment_state']==$value['state_name'])?'selected="selected"':''?>>
														<?=$value['state_name']?></option>
												<? 
													} 
												?>
											</select>
										</div>
										<div id="city_reg_placeholder" class="form-group">
											<select class="custom-select" name="hidPaymentCity" id="hidPaymentCity" >
												<option value="">Avilable Locations </option>
												<?
													$sql_pd = "SELECT `name` FROM ".$cfg['DB_LOCATION']." ORDER BY `name`";
													$res_pd = $mycms->sql_select($sql_pd);	
													$maxrow_pd=$mycms->sql_numrows($res_pd);
													if($maxrow_pd>0){
														foreach ($res_pd as $key => $value) {
															
													
												?>
															<option value="<?=$value['name']?>" <?=($row_order['od_payment_city']==$value['name'])?'selected="selected"':''?>><?=stripslashes($value['name'])?></option>
												<? 
														}	
													} 
												?>
											</select>
										</div>
										<div class="form-group">
											<input type="text" class="form-control revfrmdec" id="hidPaymentPostalCode" name="hidPaymentPostalCode" placeholder="Pincode" value="<?=$row_order['od_payment_postal_code']?>">
										</div>
										<div class="form-group">
											<textarea class="form-control revfrmdec" rows="2" placeholder="Address" id="hidPaymentAddress1" name="hidPaymentAddress1"><?=$row_order['od_payment_address1'];?></textarea>
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-md-12 paybox">
									<h4 class="heddpay">Select Payment Method</h4>
									<div class="radiopaysec">
										<!-- <div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" value="payu" name="payment_by"  id="Visa1">
											<label class="form-check-label" for="inlineRadio1">
												<img src="images/payyou.jpg">
											</label>
										</div> -->
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" value="paypal" name="payment_by"  id="Visa2">
											<label class="form-check-label" for="inlineRadio2">
												<img src="images/paypal.jpg">
											</label>
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-md-12 text-center">
									<?
									
									
									if($_REQUEST['p_id']!='')
									{
										?>
										<input type="hidden" name="final_subtotal" id="final_subtotal" value="<?=round($prod_subTotal)?>">
										<input type="hidden" name="shipping_charge_checkout" id="shipping_charge_checkout" value="<?=round($_REQUEST['shipping_charge_checkout'])?>">
										<input type="hidden" name="total_final" id="total_final" value="<?=round($prod_subTotal)?>">
										<?
									}
									else
									{
										?>
										<input type="hidden" name="final_subtotal" id="final_subtotal" value="<?=round($_REQUEST['final_subtotal'])?>">
										<input type="hidden" name="shipping_charge_checkout" id="shipping_charge_checkout" value="<?=round($_REQUEST['shipping_charge_checkout'])?>">
										<input type="hidden" name="total_final" id="total_final" value="<?=round($_REQUEST['total_final'])?>">
										<?
									}
									?>
									<button type="submit" class="btn pinkbtn btn-lg"><span class="faicon"><i class="fas fa-hand-point-up fa-lg"></i></span>Pay for Order</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<? include_once('includes/footer.php');?>
	<script src="js/jquery3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script>
			$(function()
			{
				var height=$(window).height();
				var width=$(window).width();
				
				$(window).scroll(function () { 
					if($(this).scrollTop() > 190){
						$( ".navdec" ).addClass('headerbar');				
					
					}
					else {
						$( ".navdec" ).removeClass('headerbar');
					}		
							
				});
			});
  	</script>
	<script>
			$(document).ready(function() {
		 // executes when HTML-Document is loaded and DOM is ready

		// breakpoint and up  
		$(window).resize(function(){
			if ($(window).width() >= 980){	

			  // when you hover a toggle show its dropdown menu
			  $(".navbar .dropdown-toggle").hover(function () {
				 $(this).parent().toggleClass("show");
				 $(this).parent().find(".dropdown-menu").toggleClass("show"); 
			   });

				// hide the menu when the mouse leaves the dropdown
			  $( ".navbar .dropdown-menu" ).mouseleave(function() {
				$(this).removeClass("show");  
			  });
		  
				// do something here
			}	
		});  
		  
		  

		// document ready  
		});
	</script>
  </body>
</html>