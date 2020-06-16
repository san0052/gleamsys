<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
page_header($cfg['ADMIN_TITLE']);  //." - Vendor Management"//this is used for admin panel bar design.
?>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
<td vAlign=top align="center" width="99%"><!-- Start Body Here -->

  <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">

    <tr height="34">

      <td width="25%" rowspan="2" colspan="3" align="center" valign="top"><br /><br />

      <?php include_once("left_bar.php");?></td>
	  
		<!--This segment of code is for datepicker -->
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
			<script src="//code.jquery.com/jquery-1.10.2.js"></script>
			<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
			<link rel="stylesheet" href="/resources/demos/style.css">
		   
			<script>
		  $(function() {
			$("#date_from" ).datepicker({ dateFormat: 'yy-mm-dd' });
			$("#date_to" ).datepicker({ dateFormat: 'yy-mm-dd' });
		  });
		  </script>
<!--ends here.. -->
    
	
	</tr>
	<!--main table-->
	
	<tr>

      <td align="center" valign="middle"><img src="images/spacer.gif" width="1" height="550" /></td>

      <td align="left" valign="top" width="99%">      

	  <table width="698" align="center" border="0" cellspacing="0" cellpadding="0" style="background:url(images/welcome_head.jpg) center top no-repeat;">

	  <tr height="35" >

      <td align="left" valign="middle">&nbsp;&nbsp;<span class="style1">Welcome

              <?=$_SESSION['admin_user_name']?>

              </span>               

             </td>

            <td align="right" valign="middle" class="style5">

				&nbsp;&nbsp;&nbsp;

			<a href="login.php?act=<?=md5("logout")?>"><img src="images/lock.png" height="24" width="24" border="0" /></a>&nbsp;&nbsp;

			</td>

	  

	  </tr>

	  <tr height="16">

	  <td colspan="8" align="left" valign="middle" style="background-color:#eee8e8;">&nbsp;</td>

	  </tr>

        <tr>

          <td colspan="8" style="background-color:#eee8e8;" align="center">
		  <form action="#" method="post">
		  <?php   
			  $first_date =($_REQUEST['date_from']=='')?date('Y-m-01'): $_REQUEST['date_from'];
			  $to_date = ($_REQUEST['date_to'] == '')?date('Y-m-d') : $_REQUEST['date_to'];
		  
		  ?>
			<table width="98%" class="tborder_new" cellspacing="1" cellpadding="6" align="center" >	
				<thead>
					<tr>
						
						<td class="style2" align="left" colspan="8" width="100%">Sales Report</td>
					</tr>
					<tr>

						<td colspan="8" class="row1">
						<form action="sales_report.php" method="post" name="search" id="search">
							<table width="100%" border="0">

								<tr>
									
									<td width="25%" align="left"> Customer Name:</td>
									<td width="25%" align="left"><input type="text" name="customer_name" value="<? echo $_REQUEST['customer_name']?>" class="forminputelement"></td>
									
									<td width="25%" align="left"> Customer Number:</td>
									<td width="25%" align="left"><input type="text" name="customer_code" value="<? echo $_REQUEST['customer_code']?>" class="forminputelement"></td>
								</tr>
								<tr>
								
									<td width="25%" align="left">From Date:</td>
									<td width="25%" align="left"><input type="text" name="date_from" id="date_from" value="<?php echo $first_date;?>" class="forminputelement"></td>
									<td width="25%" align="left">To Date:</td>
									<td width="25%" align="left"><input type="text" name="date_to" id="date_to" value="<?php echo $to_date;?>" class="forminputelement"></td> 
								</tr>
								<tr>
									<td width="25%" align="left"><!---Payment mode:---></td>

									<td width="25%" align="left">
										<!--<select name="select_vendor" id="select_vendor">

										<option value="">--Payment mode--</option>

										
										<option value="selected="selected"</option>

									

										</select>-->
									</td>
									<td width="25%" align="left">&nbsp;</td>
									<td width="25%" align="left"><input type="submit" name="submit1" value="Search" class="loginbttn">
									<input type="button" name="clear" value="clear"  class="loginbttn" onclick="window.location.href = 'sales_report.php';"></td>
										
								</tr>

							</table>
						</form>
					</td>
				</tr>
				</thead>
				<?
					  $name=$_REQUEST['customer_name'];
					  $code=$_REQUEST['customer_code'];
					  //$f_date="2010-01-01";
					  //$t_date="2016-01-01";
					  $where= "";
					   
					   if($name!="")
					   {
							$where.= " AND CONCAT(trim(`od_shipping_first_name`), ' ', trim(`od_shipping_last_name`))  LIKE '%".trim($name)."%'";
					   }
					   if($code!="")
					   {
							$where.=" AND `or_pattern` = '".trim($code)."'";
					   }
					   if($first_date!="")
					   {
						   //$where.=" AND `od_date` BETWEEN '".trim($first_date)."' AND '".trim($to_date)."'";
						   $where.="AND `od_date` >= '".trim($first_date)."'";
					   }
					   if($to_date!="")
					   {
						   $where.="AND `od_date` <= '".trim($to_date)."'";
					   }
					   
					   
					   //select * from test where date between '03/19/2014' and '03/19/2014 23:59:59'
					   /*if($first_date!="")
					   {
							//$where.=" AND `od_date` = '".trim($first_date)."'";
							//AND 'od_date' '>=' '".$first_date."' AND '<=' '".$to_date."'
							$where.=" AND 'od_date' '>=' '".$first_date." 00:00:00'";
					   }*/
					//echo $first_date = date('y-m-01')."<br/>";
					//echo $to_date = date('y-m-d');
					//echo $conn.="AND date_from = '".$first_date."' AND date_to = '".$to_date."'";
					//$current_date=
					/*if($_REQUEST['date_from'] !="")
					{
						if($_REQUEST['date_to'] !="")
						{
						//$conn;
						$conn.="AND date_from = '".$first_date."' AND date_to = '".$to_date."'";
						}
					}else{*/
					
					$sql_res="SELECT SUM(od_amount) AS total_amount , COUNT(od_amount) AS number FROM ".$cfg['DB_ORDER']." WHERE `od_status` = 'paid' ".$where."";
										
					$res_total = $heart->sql_query($sql_res);
					$fetch_data = $heart->sql_fetchrow($res_total);
					
					//}
				
				?>
				<tr>
				<td colspan="8">
					<table width="100%" class="tborder_new" cellspacing="0" align="center" >	
					<thead>
						<tr>
							
							<td class="style2" align="left" colspan="8" width="100%">Summary</td>
						</tr>
						<tr>
							<td width="25%" class="row1">
							Total invoice:
							</td>
							<td width="25%" class="row1">
							&nbsp;<? echo $fetch_data['number']; ?>
							</td>
							<td width="25%" class="row1">
							<!--Total Price:-->
							</td>
							<td width="25%" class="row1">
							&nbsp; <? //echo $fetch_data['total_amount']; ?>
							</td>
						</tr>
						<tr>
							<td width="25%" class="row1">
							Total delivary charge:
							</td>
							<td width="25%" class="row1">
							&nbsp;
							</td>
							<td width="25%" class="row1">
							Total amount:
							</td>
							<td width="25%" class="row1">
							&nbsp; <? echo $fetch_data['total_amount'];  ?>
							</td>
						</tr>
					</thead>
				</table>
				</td>
				</tr>
				
				<tbody>
				  <tr class="headercontent">

					<td width="7%" align="center" class="leftBarText_new1">Sl no</td>

						<td align="center" width="10%" class="leftBarText_new1">Invoice number </td>

						<td width="13%" align="center" class="leftBarText_new1">Customer</td>

						<td width="20%" align="center" class="leftBarText_new1">Payment mode</td>

						<!--<td width="13%" align="center" class="leftBarText_new1">Subtotal</td>

						<td width="19%" align="center" class="leftBarText_new1">Delivery charge</td>-->
						
						<td width="19%" align="center" class="leftBarText_new1">Invoice amount</td>
						
						<td width="19%" align="center" class="leftBarText_new1">Status</td>

				  </tr>
				  
				  <? 
				  //This segment of code for searching.
				  
				   
				    $qry="SELECT * FROM ".$cfg['DB_ORDER']." WHERE `od_status` = 'Paid'".$where;
					$search = $heart->sql_query($qry);
					$row_number = $heart->sql_numrows($search);
					if($row_number > 0)
					{
						$i=0;
						while($fetch_res = $heart->sql_fetchrow($search))
						{
							$i++;
							?>
									<tr class="<?=($i%2==0)?'row2':'row1'?>">

									<td align="center"><?=$i;?></td>

									<td align="center">&nbsp; <?php echo $fetch_res['or_pattern']?></td>

									<td align="center"> &nbsp; <?php  echo $fetch_res['od_shipping_first_name']." ".$fetch_res['od_shipping_last_name'] ?></td>

									<td align="center">  &nbsp;  <?php echo $fetch_res['od_type'] ?></td>

									<!--<td align="center">  &nbsp;</td>

									<td align="center">  &nbsp;</td>-->
									<td align="center">  &nbsp; <?php echo $fetch_res['od_amount'] ?></td>
									<td align="center">  &nbsp; <?php echo $fetch_res['od_status'] ?></td>

					</tr>
						
						<?php	
						
						}
					}
					else
					{
						?>
							<tr class="row1">
								<td align="center" colspan="6" class="msg">...No record found...</td>
							</tr>
						<?
					}
				  /* else
				  {
				 //This segment of code for listing table.
				  $f_date="2010-01-01";
				  $t_date="2016-01-01";
					 //$sql_result="SELECT * FROM ".$cfg['DB_ORDER']." WHERE `od_status` = 'paid' ";
					//$sql_result="SELECT * FROM ".$cfg['DB_ORDER']." WHERE `od_status` = 'paid' AND 'od_date' '>=' '".$first_date."' AND '<=' '".$to_date."' ";
					  $sql_result="SELECT * FROM ".$cfg['DB_ORDER']." WHERE `od_status` = 'paid' AND `od_date` BETWEEN '".$f_date."' AND  '".$t_date."' ";
					
					$result_total = $heart->sql_query($sql_result);
					
					$maxrow_total = $heart->sql_numrows($result_total);
					
					
					$i=0;
					if($maxrow_total > 0)
					{
						while($fetch = $heart->sql_fetchrow($result_total))
							
							{
							$i++;
							
							?>
							  <tr class="<?=($i%2==0)?'row2':'row1'?>">

								<td align="center"><?=$i;?></td>

								<td align="center">&nbsp; <?php echo $fetch['or_pattern']?></td>

								<td align="center"> &nbsp; <?php  echo $fetch['od_shipping_first_name']." ".$fetch['od_shipping_last_name'] ?></td>

								<td align="center">  &nbsp;  <?php echo $fetch['od_type'] ?></td>

								<!--<td align="center">  &nbsp;</td>

								<td align="center">  &nbsp;</td>-->
								<td align="center">  &nbsp; <?php echo $fetch['od_amount'] ?></td>
								<td align="center">  &nbsp; <?php echo $fetch['od_status'] ?></td>

							</tr>
					<?php }
					}	
				  } */
					?>
				  <tr>

				  <td colspan="7" align="right">

				<?=$heart->paginate($maxrow, $limit, $pageno, "pageno", "link")?>

				</td>

				</tr>
				</tbody>
			</table>
			</form>
		</td>
	</tr>
	<tr height="16">
			<td colspan="2" style="background:url(images/foot_bg.jpg) center top no-repeat;" height="16">&nbsp;</td>
		</tr>
</table>		
	
	