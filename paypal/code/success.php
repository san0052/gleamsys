<!-- Google Code for Website Tracker Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1032812731;
var google_conversion_label = "WjF2CP2lgXsQu_G97AM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1032812731/?label=WjF2CP2lgXsQu_G97AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<?php
include_once('includes1/links_frontend.php');
include_once('/includes1/session.php');

$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="CjAx8lef";

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
                  }
	else {	  

        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

         }
		 $hash = hash("sha512", $retHashSeq);
		 
       if ($hash != $posted_hash) {
	       echo "Invalid Transaction. Please try again";
		   }
	   else {
           	   
         // echo "<h3>Thank You. Your order status is ". $status .".</h3>";
         // echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
         // echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";
		  ?>
		  <style>
			.button {
					    display: block;
					    width: 115px;
					    height: 25px;
					    background: #EE4E22;
					    padding: 10px;
					    text-align: center;
					    border-radius: 5px;
					    color: white;
					    font-weight: bold;
					}
		</style>
		
		<table width="100%" cellpadding="10" cellspacing="0">
			<tr>
				<td width="60%" style="color: green;font-weight: bold;font-size:30px;">Payment status successful</td>
				<td width="10%">&nbsp;</td>
				<td width="30%">&nbsp;</td>
			</tr>
			<tr>
				<td width="70%" style="font-weight: bold;font-size:18px;">Your order status is <?=$status?></td>
				<td width="10%">&nbsp;</td>
				<td width="30%">&nbsp;</td>
			</tr>
			<tr bgcolor="#cccccc">
				<td width="70%" style="font-weight: bold;font-size:30px;">Amount Paid</td>
				<td width="10%" style="color: green; text-align: right;">TOTAL:</td>
				<td width="30%" style="color: green;text-align: right;">Rs.<?=number_format($amount,2)?></td>
			</tr>
			<tr>
				<td width="70%" style="font-weight: bold;font-size:18px;">Your Transaction ID for this transaction is <?=$txnid?>.</td>
				<td width="10%">&nbsp;</td>
				<td width="30%">&nbsp;</td>
			</tr>
			<tr>
				<td width="70%" style="font-weight: bold;font-size:18px;">&nbsp;</td>
				<td width="10%">&nbsp;</td>
				<td width="30%"><a href="index.php" class="button">Back to store</a></td>
			</tr>
		</table>
		  
		  <?

				$sql="INSERT INTO".$cfg['DB_PAYMENT_RESPONSE']."

					 SET 

					 `workingkey`='".$key."',

					 `Merchant_Id`='".$salt."',

					 `Amount`='".$amount."',

					 `OrderId`='".$txnid."',

					 `Merchant_param`='".$Merchant_Param."',

					 `checksum`='".$retHashSeq."',

					 `AuthDesc`='".$AuthDesc."',

					 `payment_gateway`='payu'";

				$heart->sql_query($sql);	

				

				$sql_up="UPDATE".$cfg['DB_ORDER']."

					 SET 

					 `od_status`='Paid' WHERE od_id='".$txnid."'";

				$heart->sql_query($sql_up);		 
		  
           
		   }         
?>	
