<?php

@session_start();
//header("Cache-Control: no-cache, must-revalidate");
include_once('../../includes/configure.php');
include_once('../../includes/configure.override.php');
if(empty($_SESSION['gleam_cart_session'])){
    header("location: ".$cfg['base_url']);exit();
}
$conn = mysqli_connect($cfg['DB_SERVER'],$cfg['DB_SERVER_USERNAME'],$cfg['DB_SERVER_PASSWORD'],$cfg['DB_DATABASE']);

// Check connection
if (!$conn) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
echo '<pre>';
print_r($_SESSION['gleam_cart_session']);

// # Create Payment using PayPal as payment method
// This sample code demonstrates how you can process a 
// PayPal Account based Payment.
// API used: /v1/payments/payment

require $cfg['DIR_PAYPAL_PATH'].'bootstrap.php';
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

$sql ="SELECT * FROM ".$cfg['DB_SHIPPING_ADDRESS']." WHERE `id`= ".$_SESSION['gleam_cart_session']['userId']." AND status ='A' ";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);
$counter = count(array_column($_SESSION['gleam_cart_session'], 'product_id'));
$productsArr = $_SESSION['gleam_cart_session'];


// ### Payer
// A resource representing a Payer that funds a payment
// For paypal account payments, set payment method
// to 'paypal'.
$payer = new Payer();
$payer->setPaymentMethod("paypal");

// ### Itemized information
// (Optional) Lets you specify item wise
// information

$item1 = new Item();
$item1->setName('Ground Coffee 40 oz')
    ->setCurrency('USD')
    ->setQuantity(1)
    ->setSku("123123") // Similar to `item_number` in Classic API
    ->setPrice(7.5);
$item2 = new Item();
$item2->setName('Granola bars')
    ->setCurrency('USD')
    ->setQuantity(5)
    ->setSku("321321") // Similar to `item_number` in Classic API
    ->setPrice(2);

//echo " item33 <pre>"; print_r($item1);
/* $itemList = new ItemList();
 $itemList->setItems(array($item1, $item2));
 echo '<pre>old';
var_dump($itemList);*/

$object = new stdClass();
$itemList = new ItemList();
for($i=0;$i<$counter-1;$i++){
    $sqlProduct = "SELECT pd_id, pd_image, pd_price, pd_name, pd_qty FROM ".$cfg['DB_PRODUCT']." WHERE `status` ='A' AND `pd_id` = '".$productsArr[$i]['product_id']."'";
    $resProduct = mysqli_query($conn,$sqlProduct);
    $rowProduct = mysqli_fetch_assoc($resProduct);
 
    // paypal items
    $j = $i+1;
    $obj = new Item();
    $obj->setName($rowProduct['pd_name'])
        ->setCurrency(PAYPAL_CURRENCY)
        ->setQuantity($productsArr[$i]['product_count'])
        // ->setSku("123123") // Similar to `item_number` in Classic API
        ->setPrice($productsArr[$i]['product_count']*$productsArr[$i]['product_amount']);
        $itemList->setItems(array($obj));
    /*$object->$i = new Item();
    $object->$i->setName($rowProduct['pd_name'])
        ->setCurrency(PAYPAL_CURRENCY)
        ->setQuantity($productsArr[$i]['product_count'])
        // ->setSku("123123") // Similar to `item_number` in Classic API
        ->setPrice($productsArr[$i]['product_count']*$productsArr[$i]['product_amount']); */

}



$finalArr =array();
// $object = new stdClass();
// for($i=0;$i<$counter;$i++){
//     $j=$i+1;
//     // $finalArr[$i] = $data['item_'.$j];  //oi phn dhor
//     $object->$i=$data['item_'.$j];  //oi phn dhor

// }
//echo "<pre>gcggh ";print_r($data);
// echo "<pre>gcggh ";print_r(array_column($data, 'item'));
// foreach ($finalArr as $key => $value)
// {
//     $object->$key = $value;
// }

// $itemList->setItems(array($data));
 echo '<pre>new';
var_dump($itemList);
// ### Additional payment details
// Use this optional field to set additional
// payment information such as tax, shipping
// charges etc.
$details = new Details();
$details->setShipping(1.2)
    ->setTax(1.3)
    ->setSubtotal(17.50);

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$amount = new Amount();
$amount->setCurrency("USD")
    ->setTotal(20)
    ->setDetails($details);

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it. 
$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription("Payment description")
    ->setInvoiceNumber(uniqid());

// ### Redirect urls
// Set the urls that the buyer must be redirected to after 
// payment approval/ cancellation.
$baseUrl = getBaseUrl();
$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl("$baseUrl/ExecutePayment.php?success=true")
    ->setCancelUrl("$baseUrl/ExecutePayment.php?success=false");

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to 'sale'
$payment = new Payment();
$payment->setIntent("sale")
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions(array($transaction));

// For Sample Purposes Only.
$request = clone $payment;


;// ### Create Payment
// Create a payment by calling the 'create' method
// passing it a valid apiContext.
// (See bootstrap.php for more on `ApiContext`)
// The return object contains the state and the
// url to which the buyer must be redirected to
// for payment approval
try {
    $payment->create($apiContext);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    // ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
    exit(1);
}

// ### Get redirect url
// The API response provides the url that you must redirect
// the buyer to. Retrieve the url from the $payment->getApprovalLink()
// method

echo $PayPald = $payment->getToken();die;
$approvalUrl = $payment->getApprovalLink();
echo '<a href='.$approvalUrl.' >'.$approvalUrl.'</a>';

header($approvalUrl);
header('Location: '.$approvalUrl);

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
  /*ResultPrinter::printOutput("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);*/

    /*$ch = curl_init();  
 
    curl_setopt($ch,CURLOPT_URL,$approvalUrl);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);*/
//  curl_setopt($ch,CURLOPT_HEADER, false); 
 
   /* $output=curl_exec($ch);
 
    curl_close($ch);*/
    // return $output;

//return $payment;
