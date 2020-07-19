<?php 
@session_start();
include_once('../includes/configure.php');
include_once('../includes/configure.override.php');

if(isset($_GET['token']) && isset($_GET['paymentId']) && !empty($_SESSION['gleam_cart_session'])) {
	$paypal_response = 'paymentId='.base64_encode($_GET['paymentId']).'&token='.base64_encode($_GET['token']).'&PayerID='.base64_encode($_GET['PayerID']);

	$conn = mysqli_connect($cfg['DB_SERVER'],$cfg['DB_SERVER_USERNAME'],$cfg['DB_SERVER_PASSWORD'],$cfg['DB_DATABASE']);
	if (!$conn) {
	  header("location: ".$cfg['base_url']);exit();
	}
	$sqlOrderUpdate = "UPDATE ".$cfg['DB_ORDER']." SET `paymentId` = '".$_GET['paymentId']."',`od_status` = 'Paid', `paypal_response` = '".$paypal_response."' WHERE `paypalId` = '".$_GET['token']."' ";
	$update = mysqli_query($conn,$sqlOrderUpdate);

	if ($update) {
			$sql_get_user   = " SELECT 
									`order`.`od_status`,
									`order`.`od_shipping_first_name`,
									`order`.`od_id` AS `orderId`,
									`order`.`od_shipping_email`,
									`order`.`od_shipping_address1`,
									`order`.`od_shipping_landmark`,
									`order`.`od_shipping_phone` ,
									`order`.`od_shipping_city`,
									`order`.`od_shipping_state`,
									`order`.`od_shipping_country`,
									`order`.`od_shipping_postal_code`,
									`order`.`od_shipping_cost`,
									`order`.`cust_id`,
									`order`.`od_date`,
									`order`.`paypalId`,
									`order`.`paymentId`,
									`order`,`or_pattern`

							FROM ".$cfg['DB_ORDER']." AS `order`
							WHERE `order`.`paypalId` = '".$_GET['token']."' 
							AND `order`.`od_status` = 'Paid' 
							";

		$res_sql_user 	= mysqli_query($conn,$sql_get_user);
		$rows_user 		= mysqli_fetch_assoc($res_sql_user);
		$user_order_email = $rows_user['od_shipping_email'];
		$user_order_name = $rows_user['od_shipping_first_name'];
		$paymentId = $rows_user['paymentId'];
		$Order_Id = $rows_user['or_pattern'];

		if($rows_user['orderId']){
			$sql_get_items ="SELECT `id`,`pd_id`,`od_id`,`od_qty`,`pd_name` ,`product_price` FROM ".$cfg['DB_ORDER_ITEM']." WHERE `od_id`= ".$rows_user['orderId']." ";
			$res_items 	= mysqli_query($conn,$sql_get_items);
			$templete ='';
			$templete .= '<!DOCTYPE html>
				<html>
					<body>
						<h2>Product Details</h2>
						<table style="font-family:arial,sans-serif;border-collapse: collapse;width: 70%;">
						<tr><td colspan ="4" style="background-color: #aeccd82e;border: 1px solid #dddddd;text-align: left; padding: 8px;">'.$paymentId.'</td></tr>
						<tr><td colspan ="4" style="background-color: #aeccd82e;">'.$Order_Id.'</td></tr>
						  <tr>
						    <th style ="border: 1px solid #dddddd;text-align: left; padding: 8px; background-color: #dddddd;">Product Name</th>
						    <th style="border: 1px solid #dddddd;text-align: left; padding: 8px; background-color: #dddddd;">Product Quantity</th>
						    <th style="border: 1px solid #dddddd;text-align: left; padding: 8px; background-color: #dddddd;">Product Price</th>
						    <th style="border: 1px solid #dddddd;text-align: left; padding: 8px; background-color: #dddddd;">Product Total Amount</th>
						  </tr>';
						while($rows_user1 		= mysqli_fetch_assoc($res_items)){
						$templete .=	'<tr>
							    <td style ="border: 1px solid #dddddd;text-align: left; padding: 8px;">'.$rows_user1['pd_name'].'</td>
							    <td style ="border: 1px solid #dddddd;text-align: left; padding: 8px;">'.$rows_user1['od_qty'].'</td>
							    <td style ="border: 1px solid #dddddd;text-align: left; padding: 8px;">'.$rows_user1['product_price'].'</td>
							    <td style ="border: 1px solid #dddddd;text-align: left; padding: 8px;">'.$rows_user1['product_price']*$rows_user1['od_qty'].'</td>
							  </tr>';
							}
						$templete .= '</table>
					</body>
				</html>';
				
				$mailto 	="info@gleamsys.com,".$user_order_email." ";
				$subject 	= 'Your order has been placed';
				$headers  	= 'MIME-Version: 1.0' . "\r\n";
				$headers 	.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers 	.= 'From: <info@gleamsys.com>' . "\r\n";
				$send_email = mail($mailto, $subject, $templete,$headers);
				if($send_email){
					$payment_email_user = "INSERT INTO ".$cfg['DB_PAYMENT_EMAIL_HISTORY']."(`status`, `subject`, `to_name`, `to_email`, `from_name`, `from_email`) VALUES ('send','".$subject."','".$user_order_name."','".$user_order_email."','Gleamsys','info@gleamsys.com')";
					$payment_res = mysqli_query($conn, $payment_email_user);

					$payment_email_admin = "INSERT INTO ".$cfg['DB_PAYMENT_EMAIL_HISTORY']."(`status`, `subject`, `to_name`, `to_email`, `from_name`, `from_email`) VALUES ('send','".$subject."','Gleamsys','info@gleamsys.com','Gleamsys','info@gleamsys.com')";
					$payment_res_admin = mysqli_query($conn, $payment_email_admin);

				}else{
				
					$payment_email_user = "INSERT INTO ".$cfg['DB_PAYMENT_EMAIL_HISTORY']."(`status`, `subject`, `to_name`, `to_email`, `from_name`, `from_email`) VALUES ('failed','".$subject."','".$user_order_name."','".$user_order_email."','Gleamsys','info@gleamsys.com')";
					$payment_res = mysqli_query($conn, $payment_email_user);

					$payment_email_admin = "INSERT INTO ".$cfg['DB_PAYMENT_EMAIL_HISTORY']."(`status`, `subject`, `to_name`, `to_email`, `from_name`, `from_email`) VALUES ('failed','".$subject."','Gleamsys','info@gleamsys.com','Gleamsys','info@gleamsys.com')";
					$payment_res_admin = mysqli_query($conn, $payment_email_admin);
				}
		} 
		unset($_SESSION['gleam_cart_session']);
	} else {
		
		header("location: ".$cfg['base_url']);exit();
	}
}

?>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

<!------ Include the above in your HEAD tag ---------->

<div class="container">
	<div class="row text-center">
        <div class="col-sm-6 col-sm-offset-3">
        <br><br> <h2 style="color:#0fad00">Success</h2>
        <h3>Payment Successfull</h3>
        <p style="font-size:20px;color:#5C5C5C;">Your Payment Id : <?php echo $_GET['paymentId']; ?><b></b></p>
        <a href="<?php echo $cfg['base_url']; ?>" class="btn btn-success">Continue Shopping</a>
    	<br><br>
        </div>
	</div>
</div>