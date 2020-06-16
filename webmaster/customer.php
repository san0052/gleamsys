<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
//include('../includes/template.php');

//include_once('../includes/links_frontend.php');
if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}
if($_REQUEST['m']==3) { $msg='Record Deleted';}
if($_REQUEST['m']==9) { $msg='Content should not be blank';}

page_header($cfg['ADMIN_TITLE']." - Customer Management");

$show=$_REQUEST['show'];
?>


<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="scripts/common.js"></script>
<script language="javascript" src="scripts/boxover.js"></script>
<script language="javascript" src="js/customer.js"></script>
<script language="javascript" src="js/ajax.js"></script>
<script language="javascript" src="js/ajax1.js"></script>
<script language="javascript" src="js/common.js"></script>
<script language="javascript" src="js/phone.js"></script>


<script>



function validation_delete(pageno)
{  
    
	 var flag=0;
          var ar=new Array();
		  var n=0;
	if(document.frm1.dropdown1.value=='')
	{
		alert('Please choose one action');
		return false;
	}
	if(document.frm1.dropdown1.value=='delete')
		 {
		   var m=document.frm1.checkvalue.length+'';
		 
		    if(m=='undefined')
		   {
		    
			  if(document.frm1.checkvalue.checked==true)
			  {
				flag++;
				var id= document.frm1.checkvalue.value;
			   	ar[0] = id;
			 }
			}
	 	
			if(m>1){
		   for(i = 0; i< document.frm1.checkvalue.length; i++)
		   {
			  if(document.frm1.checkvalue[i].checked==true)
			  {
				var id= document.frm1.checkvalue[i].value;
				ar[n++] = id;	
				flag ++;
			  }
		   }
		   }
		   
		 if(flag == 0)
		  {
		   alert('No record selected');
		   return false;
		  }
		if(flag > 0)
		 {
		 if(confirm('Do you want to delete these records')==true)
		   {   
		 
		   window.location.href="customer_process.php?&act=muldel&id="+ar+"&pageno="+pageno;
			 return true;
	       }
		   else
		   {
		     return false;
		   }
	 	
		}	
	 }
		 if(document.frm1.dropdown1.value=='Active')
		  {
		   var m=document.frm1.checkvalue.length+'';
		 
		     if(m=='undefined')
		   {
		    alert(document.frm1.checkvalue.checked);
			  if(document.frm1.checkvalue.checked==true)
			  {
				flag++;
				var id= document.frm1.checkvalue.value;
			   	ar[0] = id;
			 }
			}
	 	
			if(m>1){
		   for(i = 0; i< document.frm1.checkvalue.length; i++)
		   {
			  if(document.frm1.checkvalue[i].checked==true)
			  {
				var id= document.frm1.checkvalue[i].value;
				ar[n++] = id;	
				flag ++;
			  }
		   }
		   }
		   
		 if(flag == 0)
		  {
		   alert('No record selected');
		   return false;
		  }
		if(flag > 0)
		 {
		 if(confirm('Do you want to activate these records')==true)
		   {   
		 
		   window.location.href="customer_process.php?&act=mulactive&id="+ar+"&pageno="+pageno;
			 return true;
	       }
		   else
		   {
		     return false;
		   }
	 	
		}	
			
		    //window.location.href="banner_process.php?act=del&id="+ar;
			
         }
		  if(document.frm1.dropdown1.value=='Inactive')
		  {
		   var m=document.frm1.checkvalue.length+'';
		 
		     if(m=='undefined')
		   {
		    alert(document.frm1.checkvalue.checked);
			  if(document.frm1.checkvalue.checked==true)
			  {
				flag++;
				var id= document.frm1.checkvalue.value;
			   	ar[0] = id;
			 }
			}
	 	
			if(m>1){
		   for(i = 0; i< document.frm1.checkvalue.length; i++)
		   {
			  if(document.frm1.checkvalue[i].checked==true)
			  {
				var id= document.frm1.checkvalue[i].value;
				ar[n++] = id;	
				flag ++;
			  }
		   }
		   }
		   
		 if(flag == 0)
		  {
		   alert('No record selected');
		   return false;
		  }
		if(flag > 0)
		 {
		 if(confirm('Do you want to inactivate these records')==true)
		   {   
		 
		 window.location.href="customer_process.php?&act=mulinactive&id="+ar+"&pageno="+pageno;
			 return true;
	       }
		   else
		   {
		     return false;

		   }
	     }	
	   }
	 }
	 
 function checkall()
{
var ar = new Array();
	n = 0;
	var flag=0;
	
	if(document.getElementById("check_all").checked==true)
	{
		var m=document.frm1.checkvalue.length+'';
		if(m=='undefined')
		{
			document.frm1.checkvalue.checked=true;
		}
		
		 for(i = 0; i< document.frm1.checkvalue.length; i++)
		{
			document.frm1.checkvalue[i].checked=true;
		}
	}
	if(document.getElementById("check_all").checked==false)
	{
		var m=document.frm1.checkvalue.length+'';
		if(m=='undefined')
		{
			document.frm1.checkvalue.checked=false;
		}
		
		 for(i = 0; i< document.frm1.checkvalue.length; i++)
		{
			document.frm1.checkvalue[i].checked=false;
		}
	}
}

</script>
<script>
/*function check_phone(id)
{
	if(isNaN(document.getElementById(id).value))
	{
		document.getElementById(id+"1").style.display='inline';
		//alert("Phone number should be numeric");
		document.getElementById(id).focus();
		
	}
	else
	{
		document.getElementById(id+"1").style.display='none';
	}
}*/
</script>


<td vAlign=top align="center" width="99%"><!-- Start Body Here -->
  <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
  
    <tr height="34">
      <td width="25%" rowspan="2" colspan="3" align="center" valign="top"><br /><br />
      <?php include_once("left_bar.php");?></td>
    </tr>
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
			<?
			 	$sql="SELECT * FROM ".$cfg['DB_SITE']."   ";
				$res=$heart->sql_query($sql);				
			 ?>
                <select name="" id="" onchange="getSes1(this.value);" class="forminputelement">
                  <? while($row=$heart->sql_fetchrow($res)){?>
                  <option value="<?=$row['s_id']?>" <? if($cfg['SESSION_SITE']==$row['s_id']){?> selected="selected"<? }?>>
                  <?=$row['s_name']?>
                  </option>
                  <? }?>
                </select>
				&nbsp;&nbsp;&nbsp;
			<a href="login.php?act=<?=md5("logout")?>"><img src="images/lock.png" height="24" width="24" border="0" style="vertical-align: middle;" /></a>&nbsp;&nbsp;
			</td>
	  <?php /*?><!--<td width="658" align="left" valign="middle">&nbsp;&nbsp;<span class="style1">Welcome 
  <?=$_SESSION['admin_user_name']?></span></td>
	  <td  width="56"align="right" valign="middle"><a href="login.php?act=<?=md5("logout")?>"><img src="images/lock.png" title="Logout" width="24" height="24" border="0" /></a>&nbsp;&nbsp;&nbsp;&nbsp;</td>--><?php */?>
	  </tr>
	  <tr height="16">
	  <td colspan="8" align="left" valign="middle" style="background-color:#eee8e8;">&nbsp;</td>
	  </tr>
        <tr>
          <td colspan="8" style="background-color:#eee8e8;" align="center">
	  <? //show all record
	   if($_REQUEST['show']==''){
	   ?>
	    <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="8" align="left">&nbsp;<span class="style2">Customer Section</span> </td>
              </tr>
          </thead>
          <tbody>

            <? if($_REQUEST['m']){ ?>
            <tr class="row1">
              <td colspan="8" align="right" class="redbuttonelements"><?=@$msg?></td>
            </tr>
			<? } ?>
			 <form name="frm1" id="frm1" action="">
            <tr class="headercontent">
				<td width="6%" align="center" class="leftBarText_new1"><input name="check_all" id="check_all" class="check-all" type="checkbox" onclick="checkall();"/></td>
              <td width="6%" align="center" class="leftBarText_new1">Sl No </td>
			  <td width="6%" align="center" class="leftBarText_new1">Db No </td>
              <td width="37%" align="left" class="leftBarText_new1" colspan="3">Customer Email</td>
              <td width="13%" align="center" class="leftBarText_new1">Status</td>
              <td width="15%" align="center" class="leftBarText_new1">Action</td>
            </tr>
		  
		<?  $sql="SELECT * FROM ".$cfg['DB_CUSTOMER']." WHERE `status`!='D' AND`siteId`='".$cfg['SESSION_SITE']."' ORDER BY `id` DESC";
			 $res=$heart->sql_query($sql);
			 $maxrow=$heart->sql_numrows($res);
			 $sql = $sql. " LIMIT $offset,$limit";
			 $res = $heart->sql_query($sql);
			 if($maxrow >0){
			 while($row=$heart->sql_fetchrow($res)){
			 @$i++;
			?>
            <tr class="<?=($i%2==0)?'row1':'row2'?>">
				<td align="center"><input  name="checkvalue" id="checkvalue"  value="<?=$row['id']?>" type="checkbox" /></td>	
              <td align="center"><?=$i+$offset?></td>
			  <td align="center"><?=$row['id']?></td>
			 
              <td align="left" colspan="3" >&nbsp;<?=$row['email']?></td>
              <td align="center">&nbsp;<a href="customer_process.php?act=<?=($row['status']=='A')?'Inactive':'Active'?>&id=<?=$row['id']?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0' ?>" class="<?=($row['status']=='A')?'greenbuttonelementsNew':'redbuttonelementsNew'?>"><?=($row['status']=='A')?'Active':'Inactive'?></a></td>
              <td align="center"><a href="customer_process.php?act=view&id=<?=$row['id']?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0' ?>"><img src="images/view.gif" title="View" width="16" height="16" border="0" /></a><a href="customer_process.php?act=edit&id=<?=$row['id']?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0' ?>"><img src="images/edit.gif" title="Edit" width="16" height="16" border="0" /></a><a href="customer_process.php?act=del&id=<?=$row['id']?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0' ?>"><img src="images/drop.gif" title="Delete" width="16" height="16" border="0" onClick="return confirm('Do you really want to delete this record');" /></a></td>
            </tr>
			<? }
			}
			  else {?>
            <tr class="row1">
              <td colspan="8" align="center" class="msg">No Record.</td>
            </tr>  <? }

?>

<div style="width:90%; text-align:right;">
		<?=$heart->paginate($maxrow, $limit, $pageno, "pageno", "link")?>
		</div>
		<tr >
			<td colspan="6" align="left" class="redbuttonelements">
				
				<select name="dropdown1" class="forminputelement">
					<option value="">Choose an action...	</option>
					<option value="delete">Delete</option>	
					<option value="Active">Active</option>
					<option value="Inactive">Inactive</option>							
				</select>
				<input value="Apply to selected"  name="submit" type="button" onclick="return validation_delete(<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0' ?>);" class="loginbttn"/>
				</td>
			   
				<td colspan="2" align="right" class="redbuttonelements"><a href="customer.php?show=add" style="color:#FFFFFF;">Add New Customer</a></td>
              </tr>
 			</form>
          
        </table>
		
		
		<? }
		
		
	
		// add new customer
		
		
		
		/* Stary Brand */
		
		
	  if($show=='add') { ?>
	  <form name="frmadd" method="post" action="customer_process.php" id="frmadd" onsubmit="return add_cust_val1()">
          <p>
            <input type="hidden" name="act" value="insert" />
			<input type="hidden" name="cust_add_valid" value=""  id="cust_add_valid"/>
          </p>
          <table width="90%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="5" align="left" class="style2">&nbsp;Add Login Details </td> 
              </tr> 
            </thead> 
            <tbody> 
              <? if($_REQUEST['m']){ ?>
              <tr class="row2">
                <td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
              </tr>
			  <? } ?>
            
			  <tr class="row1"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Email Id</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left"><input name="cust_email_add" type="text" class="forminputelement" id="cust_email_add" onkeyup="check_emailadd(this.value);" onblur="check_emailadd(this.value);" />&nbsp;&nbsp;<span style="display:none;" id="exists_add"><img src="images/cross_circle.png"  align="absmiddle" width="16"/>&nbsp;&nbsp;Already exists</span><span style="display:none;" id="notexists_add"><img src="images/tick_circle.png" width="16" align="absmiddle" />&nbsp;&nbsp;Available</span><span style="display:none;" id="invalid_add"><img src="images/cross_circle.png"  align="absmiddle" width="16"/>&nbsp;&nbsp;Invalid Email Address</span></td>
              </tr> 
               <tr class="row2"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Password</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left"><input name="cust_pass_add" type="password" class="forminputelement" id="cust_pass_add"  /></td>
                </tr>
				<tr class="row1"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Confirm Password</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left"><input name="cust_confpass_add" type="password" class="forminputelement" id="cust_confpass_add"  onkeyup="checkpass(this.value);" onblur="checkpass(this.value);"/><span style="display:none;" id="pass_same_add"><img src="images/tick_circle.png"  align="absmiddle" width="16"/>&nbsp;&nbsp;Ok</span><span style="display:none;" id="pass_notsame_add"><img src="images/cross_circle.png" width="16" align="absmiddle" />&nbsp;&nbsp;Password are not same</span></td>
                </tr>
				 </tbody> 
          </table> 
		  <br/><br/>
		  <br/><br/>
		   <table width="90%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="5" align="left" class="style2">&nbsp;Add Personal Details </td> 
              </tr> 
            </thead> 
            <tbody> 
              <? if($_REQUEST['m']){ ?>
              <tr class="row2">
                <td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
              </tr>
			  <? } ?>
            
			  <tr class="row1"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Customer Name</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left"><input type="text" class="forminputelement" name="cust_name_add" id="cust_name_add"></td>
              </tr> 
               <tr class="row2"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Contact No.</span></td> 
                <td width="70%" colspan="4" align="left"><input type="text" class="forminputelement" name="cust_phone_add" id="cust_phone_add"></td>
                </tr>
				<tr class="row1"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Address</span></td> 
                <td width="70%" colspan="4" align="left"><input type="text" class="forminputelement" name="cust_addr_add" id="cust_addr_add"></td>
                </tr>
				<tr class="row2"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Country</span></td> 
                <td width="70%" colspan="4" align="left">
					<select class="forminputelement" name="cust_country_add" id="cust_country_add" style="width:127px" >
					   <option value=""><span class="leftBarText_new">Select Country</span></option>
                      <?
					$sql_cname="SELECT * FROM ".$cfg['DB_COUNTRY_MASTER']." where `country_id`=1";
					$res_cname=$heart->sql_query($sql_cname);
					while($row_cname=$heart->sql_fetchrow($res_cname))
					{
				?>
                      <option value="<?=$row_cname['country_id']?>"><?=$row_cname['country_name']?></option>
                 <? } ?>
                    </select>
				</td>
                </tr>
				<tr class="row1"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">State</span></td> 
                <td width="70%" colspan="4" align="left"><input type="text" class="forminputelement" name="cust_state_add" id="cust_state_add"></td>
                </tr>
				<tr class="row2"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">City</span> </td> 
                <td width="70%" colspan="4" align="left">
					<select class="forminputelement" name="cust_city_add" id="cust_city_add" style="width:127px">
                      <option value=""><span class="leftBarText_new">Select City</span></option>
                      <?
					    $sql_pd = "SELECT * FROM ".$cfg['DB_LOCATION']."";
					$res_pd = $heart->sql_query($sql_pd);	
					$maxrow_pd=$heart->sql_numrows($res_pd);
					if($maxrow_pd>0)	
						{
							while($row_pd=$heart->sql_fetchrow($res_pd))
							{?>
									  <option value="<?=$row_pd['id']?>"><?=stripslashes($row_pd['name'])?> </option>
									  <? }
						
						}	
					  ?>
                  </select></td>
                </tr>
				<tr class="row1"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Zip</span> </td> 
                <td width="70%" colspan="4" align="left"><input type="text" class="forminputelement" name="cust_zip_add" id="cust_zip_add"></td>
                </tr>
				 </tbody> 
          </table> 
		  <br/><br/>
		  <br/><br/>
				
				<table width="90%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="5" align="left" class="style2">&nbsp;Add Billing Details </td> 
              </tr> 
            </thead> 
            <tbody> 
			<tr class="row1"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Salutation</span></td> 
                <td width="70%" colspan="4" align="left">
				<select class="forminputelement" name="bill_salutation_add" id="bill_salutation_add">
		<option>Mr</option>
		<option>Ms</option>
		<option>Mrs</option>
		<option>Dr</option>
    </select></td>
              </tr> 
				 <tr class="row2"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">First Name</span></td> 
                <td width="70%" colspan="4" align="left"><input name="bill_fname_add" type="text" class="forminputelement" id="bill_fname_add" /></td>
              </tr> 
			  <tr class="row1"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Last Name</span></td> 
                <td width="70%" colspan="4" align="left"><input name="bill_lname_add" type="text" class="forminputelement" id="bill_lname_add" /></td>
              </tr> 
				<tr class="row2"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Address</span></td> 
                <td width="70%" colspan="4" align="left">
				<input name="bill_addr_add" type="text" class="forminputelement" id="bill_addr_add" />
				</td>
                </tr>
				 <tr class="row1"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Phone No</span> </td> 
                <td width="70%" colspan="4" align="left"><input name="bill_phone_add" type="text" class="forminputelement" id="bill_phone_add" onkeyup="check_phone(this.id);"/>
				<span style="display:none;" id="bill_phone_add1"><img src="images/cross_circle.png" width="16" align="absmiddle" />&nbsp;Phone number should be numeric</span>
				</td>
                </tr>
				<tr class="row2"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Country</span> </td> 
                <td width="70%" colspan="4" align="left">
				<select name="bill_country_add" id="bill_country_add" class="forminputelement" >
					<option value="">Select Country</option>
				<?
					$sql_cname="SELECT * FROM ".$cfg['DB_COUNTRY_MASTER']."";
					$res_cname=$heart->sql_query($sql_cname);
					while($row_cname=$heart->sql_fetchrow($res_cname))
					{
				?>
						<option value="<?=$row_cname['country_name']?>" ><?=$row_cname['country_name']?></option>	
					<? } ?>						
				</select>
			
				</td>
                </tr>
				<tr class="row1"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">State</span></td> 
                <td width="70%" colspan="4" align="left">
				<div id="bill_state">
					<input type="text" name="bill_state_add" id="bill_state_add" class="forminputelement" >
						
				</div>
				<!--<input name="bill_state_add" type="text" class="forminputelement" id="bill_state_add" />-->
				</td>
                </tr>
				<tr class="row2"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">City</span></td> 
                <td width="70%" colspan="4" align="left">
				<div id="bill_city">
					<input type="text" name="bill_city_add" id="bill_city_add" class="forminputelement" >					
						
				</div>
				
				<!--<input name="bill_city_add" type="text" class="forminputelement" id="bill_city_add" />--></td>
                </tr>
				
				<tr class="row1"> 
				<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Pincode</span></td> 
                <td width="70%" colspan="4" align="left">
				<input name="bill_pin_add" type="text" class="forminputelement" id="bill_pin_add" />
				</td>
                </tr>
             
             
            </tbody> 
          </table> 
		  <br/><br/>
		  <table width="90%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="2" align="left" class="style2">&nbsp;Add Shipping Details </td> 
				<td colspan="3" align="right" class="style2">&nbsp;<input name="shipp_details" id="shipp_details" type="checkbox" value="yes" onclick="fill_same();" />Same as billing details</td> 
              </tr> 
            </thead> 
            <tbody> 
			<tr class="row1"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Salutation</span></td> 
                <td width="70%" colspan="4" align="left">
				<select class="forminputelement" name="shipp_salutation_add" id="shipp_salutation_add">
		<option>Mr</option>
		<option>Ms</option>
		<option>Mrs</option>
		<option>Dr</option>
    </select></td>
              </tr> 
				  <tr class="row2"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">First Name</span></td> 
                <td width="70%" colspan="4" align="left"><input name="shipp_fname_add" type="text" class="forminputelement" id="shipp_fname_add" /></td>
              </tr> 
			  <tr class="row1"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Last Name</span></td> 
                <td width="70%" colspan="4" align="left"><input name="shipp_lname_add" type="text" class="forminputelement" id="shipp_lname_add" /></td>
              </tr> 
				<tr class="row2"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Address</span></td> 
                <td width="70%" colspan="4" align="left">
				<input name="shipp_addr_add" type="text" class="forminputelement" id="shipp_addr_add" />
				</td>
                </tr>
				 <tr class="row1"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Phone No</span> </td> 
                <td width="70%" colspan="4" align="left"><input name="shipp_phone_add" type="text" class="forminputelement" id="shipp_phone_add" onkeyup="check_phone(this.id);"/>
				<span style="display:none;" id="shipp_phone_add1"><img src="images/cross_circle.png" width="16" align="absmiddle" />&nbsp;Phone number should be numeric</span>
				</td>
                </tr>
				<tr class="row2"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Country</span> </td> 
                <td width="70%" colspan="4" align="left">
				<select name="shipp_country_add" id="shipp_country_add" class="forminputelement" >
					<option value="">Select Country</option>
				<?
					$sql_cname="SELECT * FROM ".$cfg['DB_COUNTRY_MASTER']."";
					$res_cname=$heart->sql_query($sql_cname);
					while($row_cname=$heart->sql_fetchrow($res_cname))
					{
				?>
						<option value="<?=$row_cname['country_name']?>" ><?=$row_cname['country_name']?></option>	
					<? } ?>						
				</select>
				
				</td>
                </tr>
				
				<tr class="row1"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">State</span></td> 
                <td width="70%" colspan="4" align="left">
				<div id="shipp_state">
					<input type="text" name="shipp_state_add" id="shipp_state_add" class="forminputelement" >
						
				</div>
				<!--<input name="shipp_state_add" type="text" class="forminputelement" id="shipp_state_add" />-->
				</td>
                </tr>
				<tr class="row2"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">City</span></td> 
                <td width="70%" colspan="4" align="left">
				<div id="shipp_city">
					<input type="text" name="shipp_city_add" id="shipp_city_add" class="forminputelement" >					
						
				</div>
				<!--<input name="shipp_city_add" type="text" class="forminputelement" id="shipp_city_add" />--></td>
                </tr>
				<tr class="row1"> 
				<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Pincode</span></td> 
                <td width="70%" colspan="4" align="left">
				<input name="shipp_pin_add" type="text" class="forminputelement" id="shipp_pin_add" />
				</td>
                </tr>
              <tr> 
                <td align="right"><a href="customer.php" class="back">&lt;&lt;back</a></td> 
                <td colspan="4" align="left"><input type="submit" name="Save" id="Save" value="Save" class="loginbttn"> 
&nbsp;</td> 
              </tr> 
            </tbody> 
          </table> 
      </form>
	  <? }
	  
	  /* end brand */

		
	  // edit customer details
	  if($show=='edit'){
	  
	  $sql1="SELECT * FROM ".$cfg['DB_CUSTOMER']." WHERE  `id` =".$_REQUEST['id']." AND`siteId`='".$cfg['SESSION_SITE']."' ";
			$res1=$heart->sql_query($sql1);
			$row1=$heart->sql_fetchrow($res1);
	  ?>
	  
	  <form name="frmedit" method="post" action="customer_process.php" id="frmedit" onsubmit="return cust_val_edit()">
          <p>
            <input type="hidden" name="act" value="edit_cust" />
			<input type="hidden" name="cust_edit_valid" value=""  id="cust_edit_valid"/>
			<input type="hidden" name="id" value="<?=$_REQUEST['id']?>" />
			
          </p>
          <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="5" align="left" class="style2">Edit Login Details </td> 
              </tr> 
            </thead> 
            <tbody> 
              <? if($_REQUEST['m']){ ?>
              <tr class="row2">
                <td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
              </tr>
			  <? } ?>
			   
			  <tr class="row1"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Email Id</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left"><input name="cust_email_edit" type="text" value="<?=$row1['email']?>" class="forminputelement" id="cust_email_edit" onkeyup="check_emailedit(this.value,<?=$_REQUEST['id']?>);" onblur="check_emailedit(this.value,<?=$_REQUEST['id']?>);" />&nbsp;&nbsp;<span style="display:none;" id="exists_edit"><img src="images/cross_circle.png"  align="absmiddle" width="16"/>&nbsp;Already exists</span><span style="display:none;" id="notexists_edit"><img src="images/tick_circle.png" width="16" align="absmiddle" />&nbsp;Available</span></div><span style="display:none;" id="same_edit"><img src="images/s_warn.gif"  align="absmiddle" width="16"/>&nbsp;You Entered Same Name !!</span><span style="display:none;" id="invalid_edit"><img src="images/cross_circle.png"  align="absmiddle" width="16"/>&nbsp;Invalid Email Address</span></div></td>
              </tr> 
               <tr class="row2"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Password</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left"><input name="cust_pass_edit" type="password" class="forminputelement" id="cust_pass_edit" value="<?=$heart->decoded($row1['password'])?>" /></td>
                </tr>
				</tbody> 
          </table> 
				<br/>
				<?php
					 $sql2="SELECT * FROM ".$cfg['DB_CUSTOMER_DETAILS']." WHERE  `cust_id` =".$_REQUEST['id']." AND `details`='customer'";
					$res2=$heart->sql_query($sql2);
					$row2=$heart->sql_fetchrow($res2);
					
				?>
				
				 
		  <br/>
				
				<!--Edit Billing Details-->
				<?php
			  	 $sql3="SELECT * FROM ".$cfg['DB_CUSTOMER_DETAILS']." WHERE  `cust_id` =".$row1['id']." AND `details`='billing'";
				$res3=$heart->sql_query($sql3);
				$row3=$heart->sql_fetchrow($res3);
			  ?>
			 
				<table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="5" align="left" class="style2">&nbsp;Edit Billing Details </td> 
              </tr> 
            </thead> 
            <tbody> 
			<tr class="row2"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Salutation</span><span class="redstar">*</span> </td> 
                <td width="70%" colspan="4" align="left">
				<select class="forminputelement" name="bill_salutation_edit" id="bill_salutation_edit">
					<option value="Mr" <?php if($row3['salutation']=='Mr'){?> selected="selected" <? } ?>>Mr</option>
					<option value="Ms" <?php if($row3['salutation']=='Ms'){?> selected="selected" <? } ?>>Ms</option>
					<option value="Mrs" <?php if($row3['salutation']=='Mrs'){?> selected="selected" <? } ?>>Mrs</option>
					<option value="Dr" <?php if($row3['salutation']=='Dr'){?> selected="selected" <? } ?>>Dr</option>
   			 </select>
	</td>
              </tr>  
				<tr class="row1"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">First Name</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left"><input name="bill_fname_edit" type="text" class="forminputelement" id="bill_fname_edit" value="<?=stripslashes($row3['fname'])?>" /></td>
              </tr> 
			  <tr class="row2"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Last Name</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left"><input name="bill_lname_edit" type="text" class="forminputelement" id="bill_lname_edit" value="<?=stripslashes($row3['lname'])?>" /></td>
              </tr> 
				<tr class="row1"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Address</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				<input name="bill_addr_edit" type="text" class="forminputelement" id="bill_addr_edit" value="<?=stripslashes($row3['address'])?>" />
				</td>
                </tr>
				 <tr class="row2"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Phone No</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left"><input name="bill_phone_edit" type="text" class="forminputelement" id="bill_phone_edit" value="<?=$row3['phone']?>" onkeyup="check_phone(this.id);"/>
				<span style="display:none;" id="bill_phone_edit1"><img src="images/cross_circle.png" width="16" align="absmiddle" />&nbsp;Phone number should be numeric</span>
				</td>
                </tr>
				<tr class="row1"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Country</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				<select name="bill_country_edit" id="bill_country_edit" class="forminputelement" onchange="getstate_edit2(this.value);">
					
				<?
					$sql_cname="SELECT * FROM ".$cfg['DB_COUNTRY_MASTER']."";
						$res_cname=$heart->sql_query($sql_cname);
						while($row_cname=$heart->sql_fetchrow($res_cname))
						{
				?>
						<option value="<?=$row_cname['country_name']?>" <?php if($row3['country']==$row_cname['country_name']) {?> selected="selected" <? } ?>><?=$row_cname['country_name']?></option>	
					<?	}
					 ?>	
										
				</select>
				
				<!--<input name="bill_country_edit" type="text" class="forminputelement" id="bill_country_edit" value="<?=$row3['country']?>" />-->
				</td>
                </tr>
				
				<tr class="row2"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">State</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left"><input name="bill_state_edit" type="text" class="forminputelement" id="bill_state_edit" value="<?=$row3['state']?>" />
				</td>
                </tr>
				<tr class="row1"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">City</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">			
				<input name="bill_city_edit" type="text" class="forminputelement" id="bill_city_edit" value="<?=$row3['city']?>" /></td>
                </tr>
				<tr class="row2"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Pincode</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				<input name="bill_pin_edit" type="text" class="forminputelement" id="bill_pin_edit" value="<?=$row3['pincode']?>" />
				</td>
                </tr>
              
            </tbody> 
          </table> 
		  <br/><br/>
		  <!--Edit Shipping Details-->
		  <?php
			  	 $sql4="SELECT * FROM ".$cfg['DB_CUSTOMER_DETAILS']." WHERE  `cust_id` =".$row1['id']." AND `details`='shipping'";
				$res4=$heart->sql_query($sql4);
				$row4=$heart->sql_fetchrow($res4);
			  ?>
		  <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="2" align="left" class="style2">Edit Shipping Details </td> 
				<td colspan="3" align="right" class="style2">&nbsp;<input name="shipp_edit_details" id="shipp_edit_details" type="checkbox" value="yes" onclick="fill_sameedit();" />Same as billing details</td> 
              </tr> 
            </thead> 
            <tbody> 
			<tr class="row2"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Salutation</span><span class="redstar">*</span> </td> 
                <td width="70%" colspan="4" align="left">
				<select class="forminputelement" name="shipp_salutation_edit" id="shipp_salutation_edit">
					<option value="Mr" <?php if($row4['salutation']=='Mr'){?> selected="selected" <? } ?>>Mr</option>
					<option value="Ms" <?php if($row4['salutation']=='Ms'){?> selected="selected" <? } ?>>Ms</option>
					<option value="Mrs" <?php if($row4['salutation']=='Mrs'){?> selected="selected" <? } ?>>Mrs</option>
					<option value="Dr" <?php if($row4['salutation']=='Dr'){?> selected="selected" <? } ?>>Dr</option>
   			 </select>
	</td>
              </tr> 
				<tr class="row1"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">First Name</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left"><input name="shipp_fname_edit" type="text" class="forminputelement" id="shipp_fname_edit" value="<?=stripslashes($row4['fname'])?>" /></td>
              </tr> 
			  <tr class="row2"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Last Name</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left"><input name="shipp_lname_edit" type="text" class="forminputelement" id="shipp_lname_edit" value="<?=stripslashes($row4['lname'])?>" /></td>
              </tr> 
				<tr class="row1"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Address</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				<input name="shipp_addr_edit" type="text" class="forminputelement" id="shipp_addr_edit" value="<?=stripslashes($row4['address'])?>" />
				</td>
                </tr>
				 <tr class="row2"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Phone No</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left"><input name="shipp_phone_edit" type="text" class="forminputelement" id="shipp_phone_edit" value="<?=$row4['phone']?>" onkeyup="check_phone(this.id);"/>
				<span style="display:none;" id="shipp_phone_edit1"><img src="images/cross_circle.png" width="16" align="absmiddle" />&nbsp;Phone number should be numeric</span>
				</td>
                </tr>
				<tr class="row1"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Country</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				<select name="shipp_country_edit" id="shipp_country_edit" class="forminputelement" onchange="getstate_edit3(this.value);">
					
				<?
					$sql_cname="SELECT * FROM ".$cfg['DB_COUNTRY_MASTER']."";
						$res_cname=$heart->sql_query($sql_cname);
						while($row_cname=$heart->sql_fetchrow($res_cname))
						{
				?>
						<option value="<?=$row_cname['country_name']?>" <?php if($row4['country']==$row_cname['country_name']) {?> selected="selected" <? } ?>><?=$row_cname['country_name']?></option>	
					<?	}
					 ?>	
										
				</select>
				<!--<input name="shipp_country_edit" type="text" class="forminputelement" id="shipp_country_edit" value="<?=$row4['country']?>" />-->
				</td>
                </tr>
				
				<tr class="row2"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">State</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				
				<input name="shipp_state_edit" type="text" class="forminputelement" id="shipp_state_edit" value="<?=$row4['state']?>" />
				</td>
                </tr>
				<tr class="row1"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">City</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				
				<input name="shipp_city_edit" type="text" class="forminputelement" id="shipp_city_edit" value="<?=$row4['city']?>" /></td>
                </tr>
				<tr class="row2"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Pincode</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				<input name="shipp_pin_edit" type="text" class="forminputelement" id="shipp_pin_edit" value="<?=$row4['pincode']?>" />
				</td>
                </tr>
				<tr> 
					<td colspan="4" align="center">
						<a class="brownbttn" href="customer.php?pageno=<?=$_REQUEST['pageno']?>" class="back">&lt;&lt;back</a>
						<input type="submit" name="Save" id="Save" value="Save" class="loginbttn"> 
					</td> 
              </tr> 
              
            </tbody> 
          </table> 
  
      </form>
	  <? 
	  } 
	  
	  //view customer details
	  if($show=='view'){
	  
	  $sql1="SELECT * FROM ".$cfg['DB_CUSTOMER']." WHERE  `id` =".$_REQUEST['id']." AND`siteId`='".$cfg['SESSION_SITE']."' ";
			$res1=$heart->sql_query($sql1);
			$row1=$heart->sql_fetchrow($res1);
	  ?>
	 
	  
          
          <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="5" align="left" class="style2">Login Details </td> 
              </tr> 
            </thead> 
            <tbody> 
              <? if($_REQUEST['m']){ ?>
              <tr class="row2">
                <td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
              </tr>
			  <? } ?>
			  <tr class="row1"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Email Id</span></td> 
                <td width="70%" colspan="4" align="left"><?=$row1['email']?></td>
              </tr> 
               
				</tbody> 
          </table> 
				<br/>
				<?php
					 $sql2="SELECT * FROM ".$cfg['DB_CUSTOMER_DETAILS']." WHERE  `cust_id` =".$_REQUEST['id']." AND `details`='customer' AND`siteId`='".$cfg['SESSION_SITE']."' ";
					$res2=$heart->sql_query($sql2);
					$row2=$heart->sql_fetchrow($res2);
				?>
				
				 
		  <br/>
				
				<!--Edit Billing Details-->
				<?php
			  	 $sql3="SELECT * FROM ".$cfg['DB_CUSTOMER_DETAILS']." WHERE  `cust_id` =".$row1['id']." AND `details`='billing' AND`siteId`='".$cfg['SESSION_SITE']."' ";
				$res3=$heart->sql_query($sql3);
				$row3=$heart->sql_fetchrow($res3);
			  ?>
				<table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="5" align="left" class="style2">Billing Details </td> 
              </tr> 
            </thead> 
            <tbody> 
				<tr class="row1"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">First Name</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left"><? if($row3['fname']==''){echo "Record not yet entered";}else{?><?=stripslashes($row3['fname'])?><? }?></td>
              </tr> 
			  <tr class="row2"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Last Name</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left"><? if($row3['lname']==''){echo "Record not yet entered";}else{?><?=stripslashes($row3['lname'])?><? }?></td>
              </tr> 
				<tr class="row1"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Address</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				<? if($row3['address']==''){echo "Record not yet entered";}else{?><?=stripslashes($row3['address'])?><? }?>
				</td>
                </tr>
				 <tr class="row2"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Phone No</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left"><? if($row3['phone']==''){echo "Record not yet entered";}else{?><?=$row3['phone']?><? }?></td>
                </tr>
				<tr class="row1"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Country</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left"><? if($row3['country']==''){echo "Record not yet entered";}else{?><?=$row3['country']?><? }?></td>
                </tr>
				
				<tr class="row2"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">State</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				<? if($row3['state']==''){echo "Record not yet entered";}else{?><?=$row3['state']?><? }?>
				</td>
                </tr>
				<tr class="row1"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">City</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				<? if($row3['city']==''){echo "Record not yet entered";}else{?><?=$row3['city']?><? }?>
				</td>
                </tr>
				<tr class="row2"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Pincode</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				<? if($row3['pincode']==''){echo "Record not yet entered";}else{?><?=$row3['pincode']?><? }?>
				</td>
                </tr>
              
            </tbody> 
          </table> 
		  <br/><br/>
		  <!--Edit Shipping Details-->
		  <?php
			  	 $sql4="SELECT * FROM ".$cfg['DB_CUSTOMER_DETAILS']." WHERE  `cust_id` =".$row1['id']." AND `details`='shipping'";
				$res4=$heart->sql_query($sql4);
				$row4=$heart->sql_fetchrow($res4);
			  ?>
		  <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="2" align="left" class="style2">Shipping Details </td> 
				<td colspan="3" align="right" class="style2">&nbsp;</td> 
              </tr> 
            </thead> 
            <tbody> 
				<tr class="row1"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">First Name</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left"><? if($row4['fname']==''){echo "Record not yet entered";}else{?><?=stripslashes($row4['fname'])?><? }?></td>
              </tr> 
			  <tr class="row2"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Last Name</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left"><? if($row4['lname']==''){echo "Record not yet entered";}else{?><?=stripslashes($row4['lname'])?><? }?></td>
              </tr> 
				<tr class="row1"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Address</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				<? if($row3['address']==''){echo "Record not yet entered";}else{?><?=stripslashes($row4['address'])?><? }?>
				</td>
                </tr>
				 <tr class="row2"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Phone No</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left"><? if($row4['phone']==''){echo "Record not yet entered";}else{?><?=$row4['phone']?><? }?></td>
                </tr>
				<tr class="row1"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Country</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				
				<? if($row4['country']==''){echo "Record not yet entered";}else{?><?=$row4['country']?><? }?>
				</td>
                </tr>
				
				<tr class="row2"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">State</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				<? if($row4['state']==''){echo "Record not yet entered";}else{?><?=$row4['state']?><? }?>
				</td>
                </tr>
				<tr class="row1"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">City</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				<? if($row4['city']==''){echo "Record not yet entered";}else{?><?=$row4['city']?><? }?>
				</td>
                </tr>
				<tr class="row2"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Pincode</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				<? if($row4['pincode']==''){echo "Record not yet entered";}else{?><?=$row4['pincode']?><? }?>
				</td>
                </tr>
				<tr> 
                <td align="center" colspan="4" style="padding-top:10px; padding-bottom:10px;">
					<a class="brownbttn" href="customer.php?pageno=<?=$_REQUEST['pageno']?>">&lt;&lt;back</a>
				</td> 
                
              </tr> 
              
            </tbody> 
          </table> 
     
	  <? 
	  } 
	 ?>
	  
	  
	  
	  
	    </td>
        </tr>
		<tr height="16">
		<td height="16" colspan="2" style="background:url(images/foot_bg.jpg) center top no-repeat;">&nbsp;</td>
		</tr>
      </table> 
      </td>   
	  
    </tr>
	
  </table>
