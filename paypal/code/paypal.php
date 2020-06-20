<?php
include_once('includes1/links_frontend.php');
include_once('includes1/session.php');
//require_once("library.php"); // include the library file
define('EMAIL_ADD', 'orders@rainbowfloristworld.com'); // define any notification email
define('PAYPAL_EMAIL_ADD', 'paypal@rainbowfloristworld.com'); // facilitator email which will receive payments change this email to a live paypal account id when the site goes live
require_once("paypal_class.php");
$p 				= new paypal_class(); // paypal class
$p->admin_mail 	= EMAIL_ADD; // set notification email
$action 		= $_REQUEST["action"];

$orderid=$_POST['invoice'];
$amount=$_POST['product_amount'];
$ordercode=$_POST['product_id'];
switch($action){
	case "process": // case process insert the form data in DB and process to the paypal
		$this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
		$p->add_field('business', PAYPAL_EMAIL_ADD); // Call the facilitator eaccount
		$p->add_field('cmd', $_POST["cmd"]); // cmd should be _cart for cart checkout
		$p->add_field('upload', '1');
		$p->add_field('return', $this_script.'?action=success'); // return URL after the transaction got over
		$p->add_field('cancel_return', $this_script.'?action=cancel'); // cancel URL if the trasaction was cancelled during half of the transaction
		$p->add_field('notify_url', $this_script.'?action=ipn'); // Notify URL which received IPN (Instant Payment Notification)
		$p->add_field('currency_code', $_POST["currency_code"]);
		$p->add_field('invoice', $_POST["invoice"]);
		$p->add_field('item_name_1', $_POST["product_name"]);
		$p->add_field('item_number_1', $_POST["product_id"]);
		$p->add_field('quantity_1', $_POST["product_quantity"]);
		$p->add_field('amount_1', $_POST["product_amount"]);
		$p->add_field('first_name', $_POST["payer_fname"]);
		$p->add_field('last_name', $_POST["payer_lname"]);
		$p->add_field('address1', $_POST["payer_address"]);
		$p->add_field('city', $_POST["payer_city"]);
		$p->add_field('state', $_POST["payer_state"]);
		$p->add_field('country', $_POST["payer_country"]);
		$p->add_field('zip', $_POST["payer_zip"]);
		$p->add_field('email', $_POST["payer_email"]);
		$p->submit_paypal_post(); // POST it to paypal
		//$p->dump_fields(); // Show the posted values for a reference, comment this line before app goes live
		$orderid=$_POST['invoice'];
		$amount=$_POST['product_amount'];
		$ordercode=$_POST['product_id'];
	break;
	
	case "success": // success case to show the user payment got success
		echo '<title>Payment Done Successfully</title>';
		echo '<style>.as_wrapper{
	font-family:Arial;
	color:#333;
	font-size:14px;
	padding:20px;
	border:2px dashed #17A3F7;
	width:600px;
	margin:0 auto;
}</style>
';		echo '<div class="as_wrapper">';
		echo "<h1>Payment Transaction Done Successfully</h1>";
		echo '<h4>Use this below URL in paypal sandbox IPN Handler URL to complete the transaction</h4>';
		echo '<h3>http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?action=ipn</h3>';
		echo '</div>';
		
			$sql="INSERT INTO".$cfg['DB_PAYMENT_RESPONSE']."

					 SET 

					 `workingkey`='',

					 `Merchant_Id`='',

					 `Amount`='".$response['Amount']."',

					 `OrderId`='".$_SESSION['orderId']."',

					 `Merchant_param`='',

					 `checksum`='',

					 `AuthDesc`='',

					 `payment_gateway`='Paypal'";

				$heart->sql_query($sql);	

				

				$sql_up="UPDATE".$cfg['DB_ORDER']."

					 SET 

					 `od_status`='Paid',
					 `paid_using_by`='paypal' WHERE od_id='".$_SESSION['orderId']."'";

				$heart->sql_query($sql_up);	
		echo'<script>';
		echo'window.location.href="thankyou.php"';		
		echo'</script>';
	break;
	
	case "cancel": // case cancel to show user the transaction was cancelled
		echo "<h1>Transaction Cancelled";
		?>
		<script>
			setTimeout(function(){
				window.location.href="<?=$cfg['base_url']?>";
			},1000)
		</script>
		<?
	break;
	
	case "ipn": // IPN case to receive payment information. this case will not displayed in browser. This is server to server communication. PayPal will send the transactions each and every details to this case in secured POST menthod by server to server. 
		$trasaction_id  = $_POST["txn_id"];
		$payment_status = strtolower($_POST["payment_status"]);
		$invoice		= $_POST["invoice"];
		$log_array		= print_r($_POST, TRUE);
		
	break;
}
?>