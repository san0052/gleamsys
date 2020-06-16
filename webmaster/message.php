<?
include_once('../includes_webmaster/links.php');

error_reporting(0);

//die("************111111");

$act=@$_REQUEST['act']; 

//echo $act;



switch($act){

case 'update_acknowledgement':

				$ord_id = $_REQUEST['ord_id'];
				
				$sql_count="SELECT * FROM " .$cfg['DB_ORDER']. "
				  	  		WHERE `od_id` ='".$ord_id."'";

	 			$res_count = $heart->sql_query($sql_count);
				$row_count = $heart->sql_fetchrow($res_count);
			
				if($row_count['od_acknowledgement'] == 'Pending')
				{
				
					$sql="UPDATE" .$cfg['DB_ORDER']. "
				  	  SET `od_acknowledgement` = 'Accepeted'
				  	  WHERE `od_id` ='".$ord_id."'";

	 			$heart->sql_query($sql);

?>
<table align="center" bordercolor="#006699" cellpadding="6" cellspacing="1" style="border:thin #006699 solid; margin-top:77px;">
<tr>
<td>
<font color="#006699">
<strong>
Thank You For Acknowledging The Order.
</strong>
</font>
<br>
<br>
</td>
</tr>
<tr>
<td align="right">
<font color="#660000">
<b><i>
-Thanks & Regards
</i>
</b>
</font>     
<br><br>
</td>
</tr>
<tr>
<td align="right">
<font color="#CC9933" size="+2" style="text-shadow:#000000">
<b>
Rainbow Florist
</b> 
</font>
<br> 
<font color="#660000">
<b><i> 
9920777678 / 9819155649
</i>
</b>
</font>
<br>       
<a href="http://www.rainbowfloristworld.com" target="_blank">www.rainbowfloristworld.com</a>
</td>
</tr>
</table>
<?
}
elseif($row_count['od_acknowledgement'] == 'Accepeted')
{
?>
<table align="center" bordercolor="#006699" cellpadding="6" cellspacing="1" style="border:thin #006699 solid; margin-top:77px;">
<tr>
<td>
<font color="#FF0000">
<strong>
<img src="images/exclm.png">
You have Already acknowledged this order.
</strong>
</font>
<br>
<br>
</td>
</tr>
<tr>
<td align="right">
<font color="#660000">
<b><i>
-Thanks & Regards
</i>
</b>
</font>     
<br><br>
</td>
</tr>
<tr>
<td align="right">
<font color="#CC9933" size="+2" style="text-shadow:#000000">
<b>
Rainbow Florist
</b> 
</font>
<br> 
<font color="#660000">
<b><i> 
9920777678 / 9819155649
</i>
</b>
</font>
<br>       
<a href="http://www.rainbowfloristworld.com" target="_blank">www.rainbowfloristworld.com</a>
</td>
</tr>
</table>
<?
}
exit();
break;

case 'reject_acknowledgement':
		
		
				$ord_id = $_REQUEST['ord_id'];

				/*$sql1="UPDATE" .$cfg['DB_ORDER']. "
				  	  SET `od_acknowledgement` = 'Rejected'
				  	  WHERE `od_id` ='".$ord_id."'";

	 			$heart->sql_query($sql1);*/

?>
<form name="frm1" id="frm1" action="reject_reason.php" method="post">
<input type="hidden" name="act" value="reject_reason">
<input type="hidden" name="ord_id" value="<?=$ord_id;?>">
<table align="center" cellpadding="6" cellspacing="1" style="padding-top:60px;">
<tr>
<td valign="top">
<font color="#006699">
<strong>
Reason for Rejecting: </strong></font>
<br>
<br>
</td>
<td width="114">
<textarea name="reason_reject" id="reason_reject" class="forminputelement" style="height:90px;width:300px;"></textarea>
</td>
</tr>
<tr>
<td colspan="2" align="right">
<input type="submit" name="submit1" value="Submit" class="loginbttn">
</td>
</tr>
</table>
<?
exit();
break;
}
?>

}
?>