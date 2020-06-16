<script>
function gotoOrderList()
{
	if (document.getElementById("order").value=='')
	{
		alert('Please enter order number');
		document.getElementById("order").focus();
		return false;
	}
	else
	{
		var order = document.getElementById("order").value;
		window.location.href='order_details.php?orderId='+order;	
	}
}
</script>
<div id="right-banner">
<div class="order">

<h4>Track Your Order</h4>
		<input name="order" type="text" class="text"  id="order" value="" />
		<? if($_SESSION['userid']!=''){ ?>
		<input type="button" class="go" value="Go" onclick="gotoOrderList();" />
		<? } ?>
		<? if($_SESSION['userid']==''){ ?>
		<input type="button" class="go" value="Go" onclick="alert('Please Login First To Track Your Order.');" />
		<? } ?>
	
</div> 
</div>
