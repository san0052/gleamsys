<?php 

@session_start();
include_once('../includes/configure.php');
include_once('../includes/configure.override.php');

if(empty($_SESSION['gleam_cart_session'])){
    header("location: ".$cfg['base_url']);exit();
}

$conn = mysqli_connect($cfg['DB_SERVER'],$cfg['DB_SERVER_USERNAME'],$cfg['DB_SERVER_PASSWORD'],$cfg['DB_DATABASE']);

// Check connection
if (!$conn) {
  header("location: ".$cfg['base_url']);exit();
}

// get shipping details of a user
$sql ="SELECT * FROM ".$cfg['DB_SHIPPING_ADDRESS']." WHERE `id`= ".$_SESSION['gleam_cart_session']['userId']." AND status ='A' ";
$res = mysqli_query($conn,$sql);
$user = mysqli_fetch_assoc($res);
$counter = count(array_column($_SESSION['gleam_cart_session'],'product_id'));
$productsArr = $_SESSION['gleam_cart_session'];
//echo "<pre>"; print_r($productsArr);
// get total
$total = 0;
$subTotal = 0;
$delivery_charges = !empty($_SESSION['gleam_cart_session']['delivery_charges'])?$_SESSION['gleam_cart_session']['delivery_charges']:0.00;
for($i=0;$i<$counter;$i++){
	$total += $productsArr[$i]['product_count']*$productsArr[$i]['product_amount'];
}
//echo "<pre> total ".$total; die;
$subTotal = $total+$delivery_charges;
require $cfg['DIR_PAYPAL_PATH'].'/vendor/autoload.php';

	// After Step 1
	$apiContext = new \PayPal\Rest\ApiContext(
	        new \PayPal\Auth\OAuthTokenCredential(PAYPAL_CLIENT_ID,     // ClientID
	            PAYPAL_CLIENT_SECRET      // ClientSecret
	        )
	);


	// After Step 2
	$payer = new \PayPal\Api\Payer();
	$payer->setPaymentMethod('paypal');

	$amount = new \PayPal\Api\Amount();
	$amount->setTotal($subTotal);
	$amount->setCurrency(PAYPAL_CURRENCY);

	$transaction = new \PayPal\Api\Transaction();
	$transaction->setAmount($amount);

	$redirectUrls = new \PayPal\Api\RedirectUrls();
	$redirectUrls->setReturnUrl(PAYPAL_SUCCESS_URL)
	    ->setCancelUrl(PAYPAL_CANCEL_URL);

	$payment = new \PayPal\Api\Payment();
	$payment->setIntent('sale')
	    ->setPayer($payer)
	    ->setTransactions(array($transaction))
	    ->setRedirectUrls($redirectUrls);

	// After Step 3
	try {
	    $payment->create($apiContext);
	    $token = $payment->getToken();
	    
		// Insert into order table
		$random_number = 'GLEAM_'.$time.'_'.rand(100,9999);
		$sqlOrderInsert = "INSERT INTO ".$cfg['DB_ORDER']."
						(`siteId`,`delivery_time`,`od_amount`, `od_shipping_first_name`, `od_shipping_email`, `od_shipping_address1`, `od_shipping_landmark`, `od_shipping_phone`, `od_shipping_city`, `od_shipping_state`, `od_shipping_country`, `od_shipping_postal_code`, `od_shipping_cost`, `cust_id`,`or_pattern`,`paypalId`,`date_now`) 
						VALUES (2,'".date('Y-m-d H:i:s')."',".$total.",'".$user['name']."','".$user['email']."','".$user['location']."','".$user['landmark']."','".$user['mobile']."','".$user['city']."','".$user['state']."','".$user['country']."','".$user['pincode']."',".$delivery_charges.",'".$_SESSION['gleam_cart_session']['userId']."','".$random_number."','".$token."','".date('Y-m-d H:i:s')."')";

		$order_res = mysqli_query($conn, $sqlOrderInsert);
		if ($order_res) {
			  $order_id = mysqli_insert_id($conn);

			 for($i=0;$i<$counter;$i++){
			 	$sqlProduct = "SELECT pd_id, pd_price, pd_name, pd_qty FROM ".$cfg['DB_PRODUCT']." WHERE `status` ='A' AND `pd_id` = '".$productsArr[$i]['product_id']."'";
			    $resProduct = mysqli_query($conn,$sqlProduct);
			    $rowProduct = mysqli_fetch_assoc($resProduct);

			    $sql_order_item = "INSERT INTO ".$cfg['DB_ORDER_ITEM']." (`pd_id`, `siteId`, `od_id`, `od_qty`, `pd_name`,`product_price`) VALUES (".$rowProduct['pd_id'].",2,".$order_id.",".$productsArr[$i]['product_count'].",'".$rowProduct['pd_name']."',".$rowProduct['pd_price'].")";
			    $order_item_res = mysqli_query($conn, $sql_order_item);

			 }
		  	$approvalUrl = $payment->getApprovalLink();
			header('Location: '.$approvalUrl);
		} else {
			header('location: checkout.php');
		}
	}
	catch (\PayPal\Exception\PayPalConnectionException $ex) {
	    // This will print the detailed information on the exception.
	    //REALLY HELPFUL FOR DEBUGGING
	    // echo $ex->getData();
	    header('location: checkout.php');
	}
?>