<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
if($_REQUEST['m']==1) { $msg='Record Deleted';}
if($_REQUEST['m']==2) { $msg='Record Updated';}
page_header($cfg['ADMIN_TITLE']." - Order Management");
$pg =($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0';
$show=$_REQUEST['show'];
$orderstat =($_REQUEST['status']!="")?$_REQUEST['status']:'';
?>
<script language="javascript" src="scripts/common.js"></script>
<script language="javascript" src="js/order.js"></script>

<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all" href="<?=$cfg['base_url']?>calender/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="<?=$cfg['base_url']?>calender/jsDatePick.min.1.3.js"></script>
<style type="text/css">
	.style3 {color: #FFFFFF}
</style>
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"start_date",
			dateFormat:"%Y-%m-%d",
			cellColorScheme:"beige",
			limitToToday:false,
			imgPath:"img/"
		});
		new JsDatePick({
			useMode:2,
			target:"end_date",
			dateFormat:"%Y-%m-%d",
			cellColorScheme:"beige",
			limitToToday:false,
			imgPath:"img/"
		});
		new JsDatePick({
			useMode:2,
			target:"dd",
			dateFormat:"%d-%m-%Y",
			cellColorScheme:"beige",
			limitToToday:false,
			imgPath:"img/"
		});
	};

</script>
<td vAlign=top align="center" width="99%">
	<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
		<tr height="34">
			<td width="25%" rowspan="2" colspan="3" align="center" valign="top">
				<br /><br />
				<?php include_once("left_bar.php");?>
			</td>
		</tr>
		<tr>
			<td align="center" valign="middle"><img src="images/spacer.gif" width="1" height="550" /></td>
			<td align="left" valign="top" width="99%">      
				<table style="background:url(images/welcome_head.jpg) center top no-repeat;" width="698" cellspacing="0" cellpadding="0" border="0" align="center">
					<tr height="35" >
						<td align="left" valign="middle">&nbsp;&nbsp;
							<span class="style1">Welcome
								<?=$_SESSION['admin_user_name']?>
							</span>
						</td>
						<td align="right" valign="middle">
							<a href="login.php?act=<?=md5("logout")?>">
								<img src="images/lock.png" title="Logout" width="24" height="24" border="0" style="vertical-align: middle;" />
							</a>&nbsp;&nbsp;&nbsp;
						</td>
					</tr>
					<tr height="16">
						<td colspan="2" align="left" valign="middle" style="background-color:#eee8e8;">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2" style="background-color:#eee8e8;" align="center">

							<? 
//======================================  SHOW ALL RECORDS ========================================//
if($_REQUEST['show']=='')
{
	// $sql="SELECT * FROM ".$cfg['DB_PRODUCT_REVIEWS']." WHERE `status`!= 'D' ORDER BY `created_date` desc";

	// $res=$heart->sql_query($sql);
	// $maxrow=$heart->sql_numrows($res);
	// $sql = $sql. " LIMIT $offset,$limit";
	// $res = $heart->sql_query($sql);
	?>
<div style="width:680px; height:500px; margin:0 auto;">
	<table width="95%" height="" align="center" cellpadding="4" cellspacing="1" class="tborder_new" style="overflow-x:auto; width:100%; height:100%; max-width:100%; display:block; white-space:nowrap;">
		<thead>
			<tr>
				<td colspan="6" align="left">&nbsp;<span class="style2">Manage Review Section</span> </td>
				 <td colspan="9" align="right">
					<form name="frmsearch" id="frmsearch" action="revieweb.php" method="post">
                        <input type="hidden" name="category" id="category" value="<?=$_REQUEST['category']?>" />
                        <input type="hidden" name="searchname" id="searchname" value="search" />
                        <input type="text" name="search_val" id="search_val" class="forminputelement" value="<?=$_REQUEST['search_val']?>" />
                        &nbsp;
                        <input type="submit" name="prodsearch"  class="loginbttn" value="Go" />
                      </form></td>
				
			</tr>
		</thead>
		<tbody>
			<tr class="row2">
				<td colspan="6" align="right" class="redbuttonelements"><?=@$msg?></td>
			</tr>
			<form name="frmsearch" method="post" action="order.php" id="frmsearch" onsubmit=" return searc();">
				<input type="hidden" name="statushidden" id="statushidden" value="<?=$orderstat?>" />
				<input type="hidden" name="orderdatehidden" id="orderdatehidden" value="" />
				<input type="hidden" name="stdate" id="stdate" value="" />
				<input type="hidden" name="endate" id="endate" value="" />
				<input type="hidden" name="act" value="searc" />

					<tr class="headercontent">
						<td width="1%" align="center" class="leftBarText_new1">
							<input name="check_all" id="check_all" class="check-all" type="checkbox" onclick="checkall();"/>
						</td>
						<td width="5%" align="center" class="leftBarText_new1">Sl No</td>                  
						<td width="30%" align="center" class="leftBarText_new1">Customer Name</td>
							<td width="30%" align="center" class="leftBarText_new1">Product Name</td>
						<td width="33%" align="center" class="leftBarText_new1">Email</td>
						<td width="9%" align="center" class="leftBarText_new1">Message</td>
						<td width="9%" align="center" class="leftBarText_new1">Status</td>
						<td width="10%" align="center" class="leftBarText_new1">Action</td>
					</tr>
					<? 	
						if(isset($_REQUEST['prodsearch']))
						{
								if($_REQUEST['searchname']=='search')
								{
							  			$sql="SELECT r.id,r.status,r.name,r.email,r.message,r.star_count,r.flag,p.pd_name FROM ".$cfg['DB_PRODUCT_REVIEWS']." AS r
								              LEFT JOIN ".$cfg['DB_PRODUCT']." AS p 
								              ON r.pd_id = p.pd_id WHERE  (`name` LIKE '%".$_REQUEST['search_val']."%' OR `email` LIKE '%".$_REQUEST['search_val']."%' OR `message` LIKE '%".$_REQUEST['search_val']."%' OR `star_count` LIKE '%".$_REQUEST['search_val']."%' OR `pd_name` LIKE '%".$_REQUEST['search_val']."%') ".$search_query;
								}
						}
						else
						{
							 $sql="SELECT r.id,r.status,r.name,r.email,r.message,r.star_count,r.flag,p.pd_name FROM ".$cfg['DB_PRODUCT_REVIEWS']." AS r
				              LEFT JOIN ".$cfg['DB_PRODUCT']." AS p 
				              ON r.pd_id = p.pd_id
				                WHERE r.status!='D' ORDER BY `created_date` desc";
				               
						}
						$res=$heart->sql_query($sql);
						$maxrow=$heart->sql_numrows($res);
						if(!isset($_REQUEST['prodsearch']))
						{
							 $sql = $sql. " LIMIT $offset,$limit";
							 $res = $heart->sql_query($sql);
						}		
					if($maxrow >0)
					{
						while($row=$heart->sql_fetchrow($res))
						{
							@$i++;
							?>
							<tr class="<?=($i%2==0)?'row1':'row2'?>">
								<td align="center" valign="top">
									<input  name="checkvalue" id="checkvalue"  value="<?=$row['od_id']?>" type="checkbox" />
								</td>
								<td align="center"><?=$i+$offset?></td>                  
								<td align="center"><?=$row['name']?> </td>
								<td align="center" valign="top"><?=$row['pd_name']?></td>
								<td align="center" class="linkTitle"><?=$row['email']?></td>
								<td align="center"><?=$row['message']?></td>
								<td align="center"><?=$row['flag']?></td>
								<td align="center">
									<?
									if($row['od_status']!='Cancelled')
									{
										?>
										<a href="manage-review.php?show=view&id=<?=$row['id']?>">
											<img src="images/view.gif" title="View" width="16" height="16" border="0" />
										</a>
										<?
									}
									?>

									<a href="manage-review-process.php?action=delreiew&id=<?=$row['id']?>">
										<img src="images/drop.gif" title="Delete" width="16" height="16" border="0" onClick="return confirm('Do you really want to delete this record');" />
									</a>				  
								</td>
							</tr>
							<? 
						}
					}

					else 
					{
						?>
						<tr class="row2">
							<td colspan="10" align="center" class="msg">No Record.</td>
						</tr>
						<? 
					}
					?>
					<tr >
						<td colspan="7" align="left" class="redbuttonelements">
							<? 

							?>
							&nbsp;
							<?  
							if($maxrow >0)
							{ 
								?>
								<select name="dropdown1" class="forminputelement">
									<option value="">Choose an action... </option>
									<option value="delete">Delete</option>
								</select>
								<input value="Apply to selected"  name="submit" type="button" onclick="return validation('<?=$category?>','<?=$pageno?>');" class="loginbttn"/>
								<? 
							} 
							?>
						</td>
						<td colspan="3" align="right" class="redbuttonelements" >
							<?php /*?><a href="order.php?show=add" style="color:#FFFFFF;">Add New Order</a><?php */?>											
						</td>
					</tr>

				</form>

			</tbody>
		</table>
		<div class="bottomsecc">
			<div class="pagisecc">
				<?=$heart->paginate($maxrow, $limit, $pageno, "pageno", "link")?>
				<div class="clr"></div>
			</div>
			<div class="clr"></div>	

		</div>
	</div>

	<? 
}

//======================================  VIEW RECORD ========================================//

	if($show=='view')
	{
		$id = $_REQUEST['id'];
		$sql="SELECT * FROM ".$cfg['DB_PRODUCT_REVIEWS']." WHERE  `id` = '".$id."'";
		$res=$heart->sql_query($sql);
		$row=$heart->sql_fetchrow($res);
		?>
		<table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
			<thead>
				
			</thead>
			<tbody>
					<tr class="row1">
						<td colspan="3" align="right" class="redbuttonelements"><?=@$msg?></td>
					</tr>
					<tr class="row2">
						<td align="left" class="leftBarText_new">Customer Name</td>
						<td colspan="2" align="left"><?=ucwords($row['name'])?></td>
					</tr>
					<tr class="row1">
						<td width="23%" align="left" class="leftBarText_new">Email</td>
						<td width="77%" colspan="2" align="left">
							<?=$row['email']?>
						</td>
					</tr>
					<tr class="row2">
						<td align="left" class="leftBarText_new">Message</td>
						<td colspan="2" align="left"><?=$row['message']?>
						
					</td>
				</tr>
				
				<form action="manage-review-process.php" method="post" name="frmOrder" id="frmOrder">
					<input type="hidden" name="action" value="update">
					<input type="hidden" name="id" value="<?=$row['id']?>">
					<tr class="row1">
						<td class="leftBarText_new" align="left">Status</td>
						<td>
							<select name="review">
								<?
									if($_REQUEST['status']=='approved'){
								?>
									<option value="approved" selected>Approved</option>
								<? }else{?>
									<option value="approved">Approved</option>
								<? 
									}
									if($_REQUEST['status']=='rejected'){ 
								?>
									<option value="rejected" selected>Rejected</option>
								<?}else{?>	
									<option value="rejected">Rejected</option>
								<? }?>
							</select>
						</td>	
					</tr>
					<tr>
						<td></td>

						<td>
							<input class="brownbttn" name="update" type="submit" id="update" value="Update" class="btnModify">
							<input class="brownbttn" name="back" type="button" id="back" value="Back" onclick="window.location.href='manage-review.php?show=&id=<?=$_REQUEST['id']?>'" class="btnModify">		
							<a style="color:#FFFFFF;" href="product.php?category=<?=$_REQUEST['category']?>&pageno=<?=$_REQUEST['page']?>" class="back">&lt;&lt;back</a>				
						</td>		
					</tr>
				</form>
				<tr>
					<td colspan="3" align="center" >&nbsp;</td>
				</tr>
			</tbody>
		</table>
	
	<? 
}
if($_REQUEST['show']=='date')
{
	$date = $_REQUEST['date'];
	if($date!='')
	{
		$sql="SELECT * 
		FROM ".$cfg['DB_ORDER']." 
		WHERE  `od_delivery_date` = '".$date."'  ";
		$res=$heart->sql_query($sql);
		$maxrow=$heart->sql_numrows($res);
		?>

		<div style="width:680px; height:500px; margin:0 auto;">
			<table width="95%" height="" align="center" cellpadding="4" cellspacing="1" class="tborder_new" style="overflow-x:auto; width:100%; height:100%; max-width:100%; display:block; white-space:nowrap;">
				<thead>
					<tr>
						<td colspan="6" align="left">&nbsp;<span class="style2">Order Section</span> </td>
						<td colspan="5" align="right">
							<select name="status" class="forminputelement" id="status" onchange="getOrderStatus(this.value)">
								<option value="" <?=($_REQUEST['status']=='' || $_REQUEST['statushidden']=='')?'selected="selected"':''?>>All</option>
								<option value="Unpaid" <?=($_REQUEST['status']=='Unpaid' || $_REQUEST['statushidden']=='Unpaid')?'selected="selected"':''?>>Unpaid</option>
								<option value="Paid" <?=($_REQUEST['status']=='Paid' || $_REQUEST['statushidden']=='Paid')?'selected="selected"':''?>>Paid</option>
								<option value="Shipped" <?=($_REQUEST['status']=='Shipped' || $_REQUEST['statushidden']=='Shipped')?'selected="selected"':''?>>Shipped</option>
								<option value="Completed" <?=($_REQUEST['status']=='Completed'  || $_REQUEST['statushidden']=='Completed')?'selected="selected"':''?>>Completed</option>
								<option value="Cancelled" <?=($_REQUEST['status']=='Cancelled'  || $_REQUEST['statushidden']=='Cancelled')?'selected="selected"':''?>>Cancelled</option>
								<option value="Dispute" <?=($_REQUEST['status']=='Dispute'  || $_REQUEST['statushidden']=='Dispute')?'selected="selected"':''?>>Dispute</option>
								<option value="Return" <?=($_REQUEST['status']=='Return'  || $_REQUEST['statushidden']=='Return')?'selected="selected"':''?>>Return</option>
								<option value="Refund" <?=($_REQUEST['status']=='Refund'  || $_REQUEST['statushidden']=='Refund')?'selected="selected"':''?>>Refund</option>
							</select>                    
						</td>
					</tr>
				</thead>
				<tbody>
					<tr class="row2">
						<td colspan="13" align="right" class="redbuttonelements"><?=@$msg?></td>
					</tr>
					<form name="frmsearch" method="post" action="order.php" id="frmsearch" onsubmit=" return searc();">
						<input type="hidden" name="statushidden" id="statushidden" value="<?=$orderstat?>" />
						<input type="hidden" name="orderdatehidden" id="orderdatehidden" value="" />
						<input type="hidden" name="stdate" id="stdate" value="" />
						<input type="hidden" name="endate" id="endate" value="" />
						<input type="hidden" name="act" value="searc" />
						<tr class="row1">
							<td colspan="3" align="center">
								<span class="leftBarText_new" >Order Id</span><br />
								<input type="text" name="o_id" value="<?=$o_id ?>" class="forminputelement" id="o_id" >
							</td>
							<td colspan="3" align="center">
								<span class="leftBarText_new" >Delivery Date</span><br />
								<input name="dd" type="text" class="forminputelement" id="dd" readonly="readonly" value="<?=$_REQUEST['orderdatehidden']?>" />
							</td>
							<td colspan="2" align="center">
								<span class="leftBarText_new" >From Date</span><br />
								<input type="text" name="start_date"  class="forminputelement" id="start_date" value="<?=$start_date;?>" >
							</td>
							<td colspan="2" align="center">
								<span class="leftBarText_new" >To Date</span><br />
								<input type="text" name="end_date"  class="forminputelement" id="end_date" value="<?=$end_date;?>" >
							</td>
							<!--<td colspan="3" align="center">-->
								<!--<span class="leftBarText_new" ><!--Remarks--></span><br />
								<!--<input type="hidden" name="remarks" value="<?//=$remarks ?>" class="forminputelement" id="remarks">-->
								<!--</td>-->
								<td colspan="2" align="center">
									<input  name="searchorder" type="submit" value="search" class="btnModify"  >
								</td>
							</tr>

							<tr class="headercontent">
								<td width="1%" align="center" class="leftBarText_new1">
									<input name="check_all" id="check_all" class="check-all" type="checkbox" onclick="checkall();"/>
								</td>
								<td width="1%" align="center" class="leftBarText_new1">Sl No</td>                  
								<td width="5%" align="center" class="leftBarText_new1">Order Id</td>
								<td width="33%" align="center" class="leftBarText_new1">Customer Name </td>
								<td width="9%" align="center" class="leftBarText_new1">Amount</td>

								<td width="9%" align="center" class="leftBarText_new1">Shipping type</td>
								<td width="20%" align="center" class="leftBarText_new1">Delivery Date</td>
								<td width="4%" align="center" class="leftBarText_new1">Order Date &amp; Time </td>
								<td width="6%" align="center" class="leftBarText_new1">Payment Status</td>
								<td width="3%" align="center" class="leftBarText_new1">Pay Through</td>
								<td width="5%" align="center" class="leftBarText_new1">Delivery Status</td>
								<td width="10%" align="center" class="leftBarText_new1">Action</td>
							</tr>
							<? 
							if($maxrow >0){
								while($row=$heart->sql_fetchrow($res)){
									@$i++;
									$c_id=$row['cust_id'];
									?>
									<tr class="<?=($i%2==0)?'row1':'row2'?>">
										<td align="center" valign="top">
											<input  name="checkvalue" id="checkvalue"  value="<?=$row['od_id']?>" type="checkbox" />
										</td>
										<td align="center"><?=$i?></td>                  
										<td align="center"><?=$row['or_pattern']?> </td>
										<td align="center" class="linkTitle"><?=$row['od_payment_first_name'].' '.$row['od_payment_last_name']?></td>
										<td align="center"><?=$row['od_amount']?></td>

										<td align="center"><?=$row['od_shipping_type']?></td>
										<td align="center"><?=date('d-m-Y ',strtotime($row['od_delivery_date']));?></td>
										<td align="center"><?=date('d-m-Y h:i:s A',strtotime($row['od_date'])); // date('d-m-Y ',strtotime($row['od_date']));?></td>
										<td align="center"><?=$row['od_status']?></td>
										<td align="center"><?=$row['received_option']?></td>
										<td align="center">
											<? if($row['od_delivery_status']=='Yes'){ echo 'Delivered';} elseif($row['od_delivery_status']=='Attempted'){ echo 'Attempted';}else{ echo 'Not Delivered';}?>
										</td>
										<td align="center">
											<?
											if($row['od_status']!='Cancelled')
											{
												?>
												<a href="order_process.php?act=view&id=<?=$row['od_id']?>&c_id=<?=$row['cust_id']?>">
													<img src="images/view.gif" title="View" width="16" height="16" border="0" />
												</a>
												<?
											}
											?>

											<a href="order_process.php?act=delorder&id=<?=$row['od_id']?>&c_id=<?=$row['cust_id']?>&status=<?=$_REQUEST['status']?>&date=<?=$_REQUEST['date']?>">
												<img src="images/drop.gif" title="Delete" width="16" height="16" border="0" onClick="return confirm('Do you really want to delete this record');" />
											</a>				  
										</td>
									</tr>
									<? 
								}
							}

							else {
								?>
								<tr class="row2">
									<td colspan="10" align="center" class="msg">No Record.</td>
								</tr>
								<? 
							}
							?>
							<tr >
								<td colspan="7" align="left" class="redbuttonelements">
									<? 
									if($_REQUEST['main']!=''){
										?>
										<a style="color:#FFFFFF;" href="product.php?category=<?=$_REQUEST['category']?>&pageno=<?=$_REQUEST['page']?>" class="back">&lt;&lt;back</a>
										<? 
									} 
									?>
									&nbsp;
									<?  
									if($maxrow >0){ 
										?>
										<select name="dropdown1" class="forminputelement">
											<option value="">Choose an action... </option>
											<option value="delete">Delete</option>
										</select>
										<input value="Apply to selected"  name="submit" type="button" onclick="return validation('<?=$category?>','<?=$pageno?>');" class="loginbttn"/>
										<? 
									} 
									?>
								</td>
								<td colspan="3" align="right" class="redbuttonelements" >
									<?php /*?><a href="order.php?show=add" style="color:#FFFFFF;">Add New Order</a><?php */?>											
								</td>
							</tr>
						</form>

					</tbody>
				</table>
			</div>
			<div style="width:95%; text-align:right;">
				<?=$heart->paginate($maxrow, $limit, $pageno, "pageno", "link")?>
			</div>

			<?php
		}
	}

	if($_REQUEST['show']=='total')
	{
		$a        = $_REQUEST['on_date'];
		$tomorrow = $_REQUEST['to_date'];
		$sql="SELECT * FROM ".$cfg['DB_ORDER']." WHERE `od_status`!='D' AND `od_delivery_date` !='".$tomorrow."' AND `od_delivery_date` !='".$a."' AND  `siteId`='".$cfg['SESSION_SITE']."'";
		$res=$heart->sql_query($sql);
		$maxrow=$heart->sql_numrows($res);
		?>

		<div style="width:680px; height:500px; margin:0 auto;">
			<table width="95%" height="" align="center" cellpadding="4" cellspacing="1" class="tborder_new" style="overflow-x:auto; width:100%; height:100%; max-width:100%; display:block; white-space:nowrap;">
				<thead>
					<tr>
						<td colspan="6" align="left">&nbsp;<span class="style2">Order Section</span> </td>
						<td colspan="5" align="right">
							<select name="status" class="forminputelement" id="status" onchange="getOrderStatus(this.value)">
								<option value="" <?=($_REQUEST['status']=='' || $_REQUEST['statushidden']=='')?'selected="selected"':''?>>All</option>
								<option value="Unpaid" <?=($_REQUEST['status']=='Unpaid' || $_REQUEST['statushidden']=='Unpaid')?'selected="selected"':''?>>Unpaid</option>
								<option value="Paid" <?=($_REQUEST['status']=='Paid' || $_REQUEST['statushidden']=='Paid')?'selected="selected"':''?>>Paid</option>
								<option value="Shipped" <?=($_REQUEST['status']=='Shipped' || $_REQUEST['statushidden']=='Shipped')?'selected="selected"':''?>>Shipped</option>
								<option value="Completed" <?=($_REQUEST['status']=='Completed'  || $_REQUEST['statushidden']=='Completed')?'selected="selected"':''?>>Completed</option>
								<option value="Cancelled" <?=($_REQUEST['status']=='Cancelled'  || $_REQUEST['statushidden']=='Cancelled')?'selected="selected"':''?>>Cancelled</option>
								<option value="Dispute" <?=($_REQUEST['status']=='Dispute'  || $_REQUEST['statushidden']=='Dispute')?'selected="selected"':''?>>Dispute</option>
								<option value="Return" <?=($_REQUEST['status']=='Return'  || $_REQUEST['statushidden']=='Return')?'selected="selected"':''?>>Return</option>
								<option value="Refund" <?=($_REQUEST['status']=='Refund'  || $_REQUEST['statushidden']=='Refund')?'selected="selected"':''?>>Refund</option>
							</select>                    
						</td>
					</tr>
				</thead>
				<tbody>
					<tr class="row2">
						<td colspan="13" align="right" class="redbuttonelements"><?=@$msg?></td>
					</tr>
					<form name="frmsearch" method="post" action="order.php" id="frmsearch" onsubmit=" return searc();">
						<input type="hidden" name="statushidden" id="statushidden" value="<?=$orderstat?>" />
						<input type="hidden" name="orderdatehidden" id="orderdatehidden" value="" />
						<input type="hidden" name="stdate" id="stdate" value="" />
						<input type="hidden" name="endate" id="endate" value="" />
						<input type="hidden" name="act" value="searc" />
						<tr class="row1">
							<td colspan="3" align="center">
								<span class="leftBarText_new" >Order Id</span><br />
								<input type="text" name="o_id" value="<?=$o_id ?>" class="forminputelement" id="o_id" >
							</td>
							<td colspan="3" align="center">
								<span class="leftBarText_new" >Delivery Date</span><br />
								<input name="dd" type="text" class="forminputelement" id="dd" readonly="readonly" value="<?=$_REQUEST['orderdatehidden']?>" />
							</td>
							<td colspan="2" align="center">
								<span class="leftBarText_new" >From Date</span><br />
								<input type="text" name="start_date"  class="forminputelement" id="start_date" value="<?=$start_date;?>" >
							</td>
							<td colspan="2" align="center">
								<span class="leftBarText_new" >To Date</span><br />
								<input type="text" name="end_date"  class="forminputelement" id="end_date" value="<?=$end_date;?>" >
							</td>
							<!--<td colspan="3" align="center">-->
								<!--<span class="leftBarText_new" ><!--Remarks--></span><br />
								<!--<input type="hidden" name="remarks" value="<?//=$remarks ?>" class="forminputelement" id="remarks">-->
								<!--</td>-->
								<td colspan="2" align="center">
									<input  name="searchorder" type="submit" value="search" class="btnModify"  >
								</td>
							</tr>

							<tr class="headercontent">
								<td width="1%" align="center" class="leftBarText_new1">
									<input name="check_all" id="check_all" class="check-all" type="checkbox" onclick="checkall();"/>
								</td>
								<td width="1%" align="center" class="leftBarText_new1">Sl No</td>                  
								<td width="5%" align="center" class="leftBarText_new1">Order Id</td>
								<td width="33%" align="center" class="leftBarText_new1">Customer Name </td>
								<td width="9%" align="center" class="leftBarText_new1">Amount</td>

								<td width="9%" align="center" class="leftBarText_new1">Shipping type</td>
								<td width="20%" align="center" class="leftBarText_new1">Delivery Date</td>
								<td width="4%" align="center" class="leftBarText_new1">Order Date &amp; Time </td>
								<td width="6%" align="center" class="leftBarText_new1">Payment Status</td>
								<td width="3%" align="center" class="leftBarText_new1">Pay Through</td>
								<td width="5%" align="center" class="leftBarText_new1">Delivery Status</td>
								<td width="10%" align="center" class="leftBarText_new1">Action</td>
							</tr>
							<? 
							if($maxrow >0){
								while($row=$heart->sql_fetchrow($res)){
									@$i++;
									$c_id=$row['cust_id'];
									?>
									<tr class="<?=($i%2==0)?'row1':'row2'?>">
										<td align="center" valign="top">
											<input  name="checkvalue" id="checkvalue"  value="<?=$row['od_id']?>" type="checkbox" />
										</td>
										<td align="center"><?=$i?></td>                  
										<td align="center"><?=$row['or_pattern']?> </td>
										<td align="center" class="linkTitle"><?=$row['od_payment_first_name'].' '.$row['od_payment_last_name']?></td>
										<td align="center"><?=$row['od_amount']?></td>

										<td align="center"><?=$row['od_shipping_type']?></td>
										<td align="center"><?=date('d-m-Y ',strtotime($row['od_delivery_date']));?></td>
										<td align="center"><?=date('d-m-Y h:i:s A',strtotime($row['od_date'])); // date('d-m-Y ',strtotime($row['od_date']));?></td>
										<td align="center"><?=$row['od_status']?></td>
										<td align="center"><?=$row['received_option']?></td>
										<td align="center">
											<? if($row['od_delivery_status']=='Yes'){ echo 'Delivered';} elseif($row['od_delivery_status']=='Attempted'){ echo 'Attempted';}else{ echo 'Not Delivered';}?>
										</td>
										<td align="center">
											<?
											if($row['od_status']!='Cancelled')
											{
												?>
												<a href="order_process.php?act=view&id=<?=$row['od_id']?>&c_id=<?=$row['cust_id']?>">
													<img src="images/view.gif" title="View" width="16" height="16" border="0" />
												</a>
												<?
											}
											?>

											<a href="order_process.php?act=delorder&id=<?=$row['od_id']?>&c_id=<?=$row['cust_id']?>&status=<?=$_REQUEST['status']?>&date=<?=$_REQUEST['date']?>">
												<img src="images/drop.gif" title="Delete" width="16" height="16" border="0" onClick="return confirm('Do you really want to delete this record');" />
											</a>				  
										</td>
									</tr>
									<? 
								}
							}

							else {
								?>
								<tr class="row2">
									<td colspan="10" align="center" class="msg">No Record.</td>
								</tr>
								<? 
							}
							?>
							<tr >
								<td colspan="7" align="left" class="redbuttonelements">
									<? 
									if($_REQUEST['main']!=''){
										?>
										<a style="color:#FFFFFF;" href="product.php?category=<?=$_REQUEST['category']?>&pageno=<?=$_REQUEST['page']?>" class="back">&lt;&lt;back</a>
										<? 
									} 
									?>
									&nbsp;
									<?  
									if($maxrow >0){ 
										?>
										<select name="dropdown1" class="forminputelement">
											<option value="">Choose an action... </option>
											<option value="delete">Delete</option>
										</select>
										<input value="Apply to selected"  name="submit" type="button" onclick="return validation('<?=$category?>','<?=$pageno?>');" class="loginbttn"/>
										<? 
									} 
									?>
								</td>
								<td colspan="3" align="right" class="redbuttonelements" >
									<?php /*?><a href="order.php?show=add" style="color:#FFFFFF;">Add New Order</a><?php */?>											
								</td>
							</tr>
						</form>

					</tbody>
				</table>
			</div>
			<div style="width:95%; text-align:right;">
				<?=$heart->paginate($maxrow, $limit, $pageno, "pageno", "link")?>
			</div>

			<?php

		}
		?>
	</td>
</div>
</tr>
<tr height="16">
	<td colspan="2" style="background:url(images/foot_bg.jpg) center top no-repeat;">&nbsp;</td>
</tr>
</table>
</td>
</tr>
<tr>
	<td colspan="3" align="right"></td>
</tr>
</table>