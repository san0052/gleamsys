<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
//include('../includes/template.php');

//include_once('../includes/links_frontend.php');
if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}
if($_REQUEST['m']==3) { $msg='Record Deleted';}
if($_REQUEST['m']==9) { $msg='Content should not be blank';}

page_header($cfg['ADMIN_TITLE']." - Vendor Management");

$show=$_REQUEST['show'];
?>


<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />



<script language="javascript" src="scripts/boxover.js"></script>
<script language="javascript" src="js/customer.js"></script>

<script language="javascript" src="js/ajax1.js"></script>
<script language="javascript" src="js/common.js"></script>
<script language="javascript" src="js/phone.js"></script>
<script language="javascript" src="scripts/CountryStateCityRetriver.js"></script>
<script language="javascript" src="js/jquery-1.7.2.min.js"></script>

<script type="text/javascript"> 
function validation1()
{  
    var n=0;
    var flag=0;
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
		   if(m>1)
		   {
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
		         if(confirm('Do you want to remove these records')==true)
		         {   
		              var pageno1='<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>';
					  
		              window.location.href="vendor_process.php?&act=muldel&id="+ar+"&pageno="+pageno1;
			          return true;
	             }
		         else
		         {
		              return false;
		         }
		  }	
	 }
	 if(document.frm1.dropdown1.value=='active')
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
		   if(m>1)
		   {
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
		         if(confirm('Do you want to active these records')==true)
		         {   
		              var pageno1='<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>';
					  
		              window.location.href="vendor_process.php?act=multiactive&id="+ar+"&pageno="+pageno1;
			          return true;
	             }
		         else
		         {
		              return false;
		         }
		  }	
	 }
	 if(document.frm1.dropdown1.value=='inactive')
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
		   if(m>1)
		   {
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
		         if(confirm('Do you want to inactive these records')==true)
		         {   
		              var pageno1='<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>';
					  
		              window.location.href="vendor_process.php?&act=multiinactive&id="+ar+"&pageno="+pageno1;
			          return true;
	             }
		         else
		         {
		              return false;
		         }
		  }	
	 }
}

function opentgl()
{
$("#prod_list").slideToggle("slow");
}




function generate_password3(){
var password_characters='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_-+=|\}{][":><.,?/'; 
var password_length = document.getElementById("txtPasswordLength");
if(isNaN(password_length.value) || parseInt(password_length.value)==0 || (password_length.value.replace(/\s+$/,"")=="")){
alert("Please enter valid password length");
password_length.select();
password_length.focus();
return false; 
}
var pwdLen=parseInt(password_length.value);
pwdLen=(pwdLen<=15)?pwdLen:15;

var password='';
var len=0;
for(var i=0;i<pwdLen;i++){ 
password+=password_characters.charAt(Math.floor(Math.random()*password_characters.length))
}
document.getElementById("password2").innerHTML=password;
}





function openPopup1()
{
	$("#fade_form1").fadeIn("slow");
	$("#pop_form1").slideDown("slow");
	document.getElementById("input-password").value = "";
	generate_password3();
}
function closePopup1()
{	$("#fade_form1").fadeOut("slow");
	$("#pop_form1").slideUp("slow");
	
}

function usePassword()
{	

var pass = document.getElementById("password2").innerHTML;

document.getElementById("input-password").value = pass;
closePopup1();	
}


function enablebtn(currentControl)
{	
    var chk= document.getElementById(currentControl);
	var btn= document.getElementById('confirm');
	if(chk.checked==true)
	{
	btn.className='greenbuttonelements';
	btn.disabled=false;
	}
	else
	{
	btn.className='disablebuttonelements';
	btn.disabled=true;
	}
}

function disablebtn()
{

document.getElementById('confirm').disabled=true;

var item= document.getElementById('confirm')
item.className='disablebuttonelements';
}






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

function existing(){

var email = document.getElementById("email").value;

if(email!="")
	{	
		var param = "act=email_avail&email="+email;
		$.ajax({
				  url: "vendor_process.php",
				  type: "POST",
				  data: param,
				  dataType: "text",
				  success: function(response){
					  if(response == 1)
					  {
					     document.getElementById("email_not_exists_add").style.display ='none'; 
					     document.getElementById("email_exists_add").style.display ='inline'; 
					     document.getElementById("city_type_check_add").value=1;
					  }	
					  else
					  {
					     document.getElementById("email_not_exists_add").style.display ='inline'; 
					     document.getElementById("email_exists_add").style.display ='none'; 
					     document.getElementById("city_type_check_add").value=0;
					  }
				  }
			   });
	}
	else
	{
		document.getElementById("email_not_exists_add").style.display ='none'; 
		document.getElementById("email_exists_add").style.display ='none';
		document.getElementById("city_type_check_add").value=0;
	}
}

function validate(){
var email = document.getElementById("email");
var city_type_check = document.getElementById("city_type_check_add");
var vendor_name = document.getElementById("vendor_name");
var input_password = document.getElementById("input-password");

		
		if(email.value == ""){
		alert("Please Provide an Email ID...");
		email.focus();
		return false;
		}
		
		if(input_password.value == ""){
		alert("Please Provide a Password...");
		input_password.focus();
		return false;
		}
		
		if(vendor_name.value == ""){
		alert("Please Provide a Vendor Name...");
		vendor_name.focus();
		return false;
		}
		

		if(city_type_check.value == 1){
		alert("Email ID Already Exists");
		email.focus();
		return false;
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


<form name="frm1" id="frm1" method="post">
  <input type="hidden" name="pageno" value="<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>" />
  <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
    <thead>
      <tr>
        <td colspan="7" align="left" class="style2">Manage Vendor Section</td>
      </tr>
      <tr>
        <td colspan="7" class="row1">
          <table width="100%">
            <tr>
              <td width="23%" align="center">
                <b>Vendor Name:</b>
                  <input type="text" name="vendor_name" id="contact_person" 
                  class="forminputelement" value="<?=$_REQUEST['vendor_name']?>">              </td>
              <td width="23%" align="center"><b>Contact Person :</b>
                <input type="text" name="contact_person" id="contact_person" 
                  class="forminputelement" value="<?=$_REQUEST['contact_person']?>"  /></td>
              <td width="23%" align="center"><b>Contact Person Ph:</b>
                <input type="text" name="phone" id="phone" 
                  class="forminputelement" value="<?=$_REQUEST['phone']?>" /></td>
              <td width="31%" align="right" valign="middle">	
                <?php
                  if($_REQUEST['vendor_name']!='' || $_REQUEST['contact_person']!='' || $_REQUEST['phone']!='')
                  	{
                  ?>
                <a href="<?=$_SERVER['PHP_SELF']?>" class="back" style="text-decoration:none;">Clear </a>
                <?php
                  }
                  ?>				  </td>
				  <td>
                <input type="submit" name="goSearch" value="Search" class="loginbttn" />             
				 </td>
            </tr>
          </table>        </td>
      </tr>
    </thead>
    <tbody>
      <tr class="headercontent">
        <td width="6%" align="center" class="leftBarText_new1"><input type='checkbox' name='check_all' id="check_all" onclick='checkall();'></td>
        <td width="8%"  align="center" class="leftBarText_new1">Sl No </td>
        <td width="23%" align="center" class="leftBarText_new1">Vendor Name</td>
        <td width="23%"align="center" class="leftBarText_new1" >Contact Person</td>
        <td width="16%" align="center" class="leftBarText_new1">Phone</td>
        <td width="11%" align="center" class="leftBarText_new1">Status</td>
        <td width="13%" align="center" class="leftBarText_new1">Action</td>
      </tr>
	  
	  <?

	$vendor_name 		 = trim($_REQUEST['vendor_name']);
	$contact_person 	 = trim($_REQUEST['contact_person']);
	$phone		 		 = trim($_REQUEST['phone']);
	
	$whereClause = "WHERE status <> 'D'";
	if($vendor_name != '' || $contact_person != '' || $phone != '')
		{
			if($vendor_name!='')
			{
				$whereClause = $whereClause."AND `vendor_name` LIKE '".$vendor_name."%'";
			}
			
			if($contact_person!='')
			{
				$whereClause = $whereClause."AND `contact_person` LIKE '".$contact_person."%'";
			}
			
			if($phone!='')
			{
				$whereClause = $whereClause."AND `vendor_phone_number` LIKE '".$phone."%'";
			}
			
		}
	else
		{
			$whereClause;
		}
		
		
		
	  $sql_vendor_add = "SELECT * FROM ".$cfg['DB_VENDOR']." ".$whereClause." ORDER BY `id` DESC";
	  $res_vendor_add = $heart->sql_query($sql_vendor_add);
	  $maxrow_vendor_add = $heart->sql_numrows($res_vendor_add);
	  
	  	if($maxrow_vendor_add > 0)
			{
				while($row_vendor_add = $heart->sql_fetchrow($res_vendor_add))
					{	@$i++;
	  ?>
	  
	  
      <tr class="<?=($i%2==0)?'row1':'row2'?>">
        <td align="center">
          <input type="checkbox" name="checkvalue" value="" id="checkvalue">        </td>
        <td align="center">
          <? 
            echo $i;
            ?>        </td>
        <td align="center">
        <?=$row_vendor_add['vendor_name']?>  
		</td>
        <td align="center"><?=$row_vendor_add['contact_person']?></td>
        <td align="center"><?=$row_vendor_add['vendor_phone_number']?></td>
        <td align="center"><a href="vendor_process.php?act=<?=($row_vendor_add['status']=='A')?'Inactive':'Active'?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row_vendor_add['id']?>" class="<?=($row_vendor_add['status']=='A')?'greenbuttonelementsNew':'redbuttonelementsNew'?>"><?=($row_vendor_add['status']=='A')?'Active':
          'Inactive'?>
          </a>        </td>
        <td align="center">
          <a href="vendor.php?show=view&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row_vendor_add['id']?>">
          <img src="images/view.gif" title="View" alt="View" width="16" height="16" border="0" /></a>
          <a href="vendor.php?show=edit&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row_vendor_add['id']?>">
          <img src="images/edit.gif" title="Edit" width="16" height="16" border="0" /></a>
          <a href="vendor_process.php?act=del&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row_vendor_add['id']?>" onclick="return confirm('Do You really Want to Remove this Vendor?');">
          <img src="images/drop.gif" title="Remove" width="16" height="16" border="0" /></a>        </td>
      </tr>
	  <?
	  		}
		}
		
		else
			{
	  ?>
	  
	  <tr class="row2">
	  <td colspan="7" class="msg" align="center">No Records Found</td>
	  </tr>	
	  <?	
			}
	  ?>
      <tr class="tfooter">
        <td colspan="6" align="left">
          <select name="dropdown1" class="forminputelement">
            <option value="">Choose an action... </option>
            <option value="delete">Delete</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
          &nbsp;
          <INPUT class="loginbttn" type="button" value="Apply To Selected" name="Go" onclick="validation1();">        
          <a href="vendor.php?show=add" style="color:#FFFFFF;"></a>        </td>
        <td align="right" class="redbuttonelements">
          <a href="vendor.php?show=add" style="color:#FFFFFF;">Add Vendor</a>		</td>
        </tr>
  </table>
</form>


		
		
		<? }
		
		
	
		// add new customer
		
		
		
		/* Stary Brand */
		
		
	  if($show=='edit') { ?>
	  <?
	  $sql_vendor_edit = "SELECT * FROM ".$cfg['DB_VENDOR']." WHERE `id` = '".$_REQUEST['id']."'";
	  $res_vendor_edit = $heart->sql_query($sql_vendor_edit);
	  $row_vendor_edit = $heart->sql_fetchrow($res_vendor_edit);
	  ?>
	  
	  <form name="frm1" method="post" action="vendor_process.php" id="frmadd">
          
            <input type="hidden" name="act" value="edit" />
			<input type="hidden" name="id" value="<?=$_REQUEST['id']?>" />
			<input type="hidden" name="cust_add_valid" value=""  id="cust_add_valid"/>
          
          <table width="98%" class="tborder_new" cellspacing="1" align="center" cellpadding="6" border="0">
      <tr>
        <td colspan="4" class="style2">Edit Vendor Section</td>
      </tr>
      
      <tr class="row1">
        <td width="22%" class="leftBarText">Email Id </td>
        <td class="leftBarText" colspan="3">
		<span style="border:thin solid; background-color:#333333;">
		<font color="#FFFFFF"><b><?=$row_vendor_edit['email']?></b>
		</font>
		</span>
		</td>
		</tr>
	  <tr>
        <td colspan="4" class="style2">Personal Details</td>
      </tr>
	   <tr class="row2">
	  	<td width="22%" class="leftBarText">Vendor Name </td>
        <td width="28%">
		<input type="text" name="vendor_name" id="vendor_name" class="forminputelement" value="<?=$row_vendor_edit['vendor_name']?>">
		</td>
		<td class="leftBarText">Vendor Phone No. </td>
        <td><input type="text" name="vendor_phone_number" id="vendor_phone_number" class="forminputelement" value="<?=$row_vendor_edit['vendor_phone_number']?>"></td>
	  </tr>
	  <tr class="row1">
        <td rowspan="3" class="leftBarText" valign="top">Address </td>
        <td rowspan="3" valign="top"><textarea name="address" id="address" class="forminputelement" cols="23" rows="5"><?=$row_vendor_edit['address']?></textarea></td>
        <td class="leftBarText">Country</td>
        <td><span class="leftBarText">
          <select class="forminputelement" name="country_add" id="country_add" style="width:127px" >
					   <option value=""><span class="leftBarText_new">Select Country</span></option>
                      <?
					$sql_cname="SELECT * FROM ".$cfg['DB_COUNTRY_MASTER']." where `country_id`=1";
					$res_cname=$heart->sql_query($sql_cname);
					while($row_cname=$heart->sql_fetchrow($res_cname))
					{
				?>
                      <option value="<?=$row_cname['country_id']?>" <? if ($row_vendor_edit['country']==$row_cname['country_id']){?> selected="selected"<? }?>><?=$row_cname['country_name']?></option>
                 <? } ?>
           </select>
        </span></td>
      </tr>
		<tr class="row2">
        <td class="leftBarText">State</td>
        <td>
        <input type="text" class="forminputelement" name="state_add" id="state_add" value="<?=$row_vendor_edit['state']?>" />        </td>
      </tr>
		<tr class="row1">
        <td class="leftBarText">City</td>
        <td>
		<span id="cityPlaceholderAdd" class="leftBarText">
        <select class="forminputelement" name="city_add" id="city_add" style="width:127px">
                      <option value=""><span class="leftBarText_new">Select City</span></option>
                      <?
					    $sql_pd = "SELECT * FROM ".$cfg['DB_LOCATION']."";
					$res_pd = $heart->sql_query($sql_pd);	
					$maxrow_pd=$heart->sql_numrows($res_pd);
					if($maxrow_pd>0)	
						{
							while($row_pd=$heart->sql_fetchrow($res_pd))
							{?>
									  <option value="<?=$row_pd['id']?>"<? if ($row_vendor_edit['city']==$row_pd['id']){?> selected="selected"<? }?>><?=stripslashes($row_pd['name'])?> </option>
									  <? }
						
						}	
					  ?>
                  </select>
        </span>		</td>
      </tr>
      <tr class="row2">
        <td class="leftBarText">Owner Name</td>
        <td width="28%"><input type="text" name="owner_name" id="owner_name" class="forminputelement" value="<?=$row_vendor_edit['owner_name']?>"></td>
        <td width="22%" class="leftBarText">Owner Contact No.</td>
        <td width="28%"><input type="text" name="owner_contact_number" id="owner_contact_number" class="forminputelement" value="<?=$row_vendor_edit['owner_contact_number']?>"></td>
      </tr>
      <tr class="row1">
        <td class="leftBarText">Contact Person </td>
        <td width="28%"><input type="text" name="contact_person" id="contact_person" class="forminputelement" value="<?=$row_vendor_edit['contact_person']?>"></td>
        <td class="leftBarText">Contact Person No. </td>
        <td><input type="text" class="forminputelement" name="vendor_mobile_number" id="vendor_mobile_number" value="<?=$row_vendor_edit['vendor_mobile_number']?>"></td>
      </tr>
      
      
      
      
      <tr class="row2">
        <td class="leftBarText">Vendor Reference </td>
        <td colspan="3"><input type="text" class="forminputelement" name="vendor_reference" id="vendor_reference" value="<?=$row_vendor_edit['vendor_reference']?>" size="30"></td>
        </tr>
	  
	  <tr>
        <td colspan="6" class="style2">Tax Details </td>
      </tr>
      <tr class="row1">
        <td class="leftBarText">VAT Number:</td>
        <td>
		<input type="text" class="forminputelement" name="vat_no" id="vat_no" value="<?=$row_vendor_edit['vat_no']?>"/>		</td>
        <td class="leftBarText">CST Number:</td>
        <td>
		<input type="text" class="forminputelement" name="cst_no" id="cst_no" value="<?=$row_vendor_edit['cst_no']?>"/>		</td>
      </tr>
      <tr class="row2">
        <td class="leftBarText">S.T. Number:</td>
        <td>
		<input type="text" class="forminputelement" name="st_no" id="st_no" value="<?=$row_vendor_edit['st_no']?>"/>		</td>
        <td class="leftBarText">PAN Number:</td>
        <td>
		<input type="text" class="forminputelement" name="pan_no" id="pan_no" value="<?=$row_vendor_edit['pan_no']?>" />		</td>
      </tr>
	  
	  <tr>
	  <td colspan="4" class="style2">
	  Product List	  </td>
	  </tr>
	  <tr>
	  <td colspan="4" style="margin:0px; padding:0px;">
	  <table width="100%" class="tborder_new" align="center" cellpadding="6" cellspacing="1">
	  <tr class="headercontent">
	  <td width="7%" align="center" class="leftBarText_new1">
	  Sl No.
	  <input type='hidden' name='check_all' id="check_all" onclick='checkall();'>	  
	  </td>
	  <td width="23%" align="center" class="leftBarText_new1">
	  Product Code	  </td>
	  <td width="51%" align="center" class="leftBarText_new1">
	  Product Name	  </td>
	  <td width="19%" align="center" class="leftBarText_new1">
	  Price	  </td>
	  </tr>
	  
	  
	  
	  
	  
	  <?
	  $sql_product = "SELECT product.pd_id,
	  				  		 product.pd_name,
					  		 product.pd_price, 
					  		 product.pd_code, 
							 avail.price, 
							 avail.product_id,
							 avail.vendor_id,
							 product.status 
					  FROM ".$cfg['DB_PRODUCT']."product 
					  
					  INNER JOIN ".$cfg['DB_VENDOR_PRODUCT_AVAIL']." avail	
					   
					  ON avail.product_id = product.pd_id
							 
					  
					  WHERE product.status = 'A' AND avail.vendor_id = '".$_REQUEST['id']."'";
	  $res_product = $heart->sql_query($sql_product); 
	  $maxrow_product = $heart->sql_numrows($res_product); 
	  ?>
	  <?
	  if($maxrow_product>0)
	  { while($row_product = $heart->sql_fetchrow($res_product))
	  { @$i++;
	  ?>
	  <tr class="<?=($i%2==0)?'row1':'row2'?>">
	  <td valign="top" align="center">
	  <?=$i;?>
	  <input type="hidden" name="checkvalue[]" value="<?=$row_product['pd_id']?>" id="checkvalue_<?=$i;?>" <?php /*?><? if ($row_product['pd_id']==$row_product['product_id']) { ?> checked="checked" <? } ?><?php */?>>	  
	  
	  </td>
	  
	  <td align="center" valign="top">
	  <?=$row_product['pd_code']?>	  </td>
	  <td valign="top" align="left">
	  <font color="#990033"><?=$row_product['pd_name']?></font>	  </td>
	  <td valign="top" align="center">
	  <b>&#8377;</b><input type="text" name="price[]" id="price_<?=$i;?>" value="<?=$row_product['price']?>" class="forminputelement" style="text-align:right;">	  
	  
	  
	  </td>
	  </tr>
	  <?
	  }
	  }
	  ?>
	  </table>
      <tr>
	  
        <td colspan="6" align="center">
			<a name="back" id="back" class="brownbttn" href="<?=$_SERVER['PHP_SELF']?>"/>Back</a>
			<input type="submit" name="save" value="Save" class="loginbttn"/></td>
		</tr>
    </table> 
		  
     </form>
	  <? }
	  
	  /* end brand */

		
	  // edit customer details
	  if($show=='add'){
	  
	  $sql1="SELECT * FROM ".$cfg['DB_CUSTOMER']." WHERE  `id` ='".$_REQUEST['id']."' AND`siteId`='".$cfg['SESSION_SITE']."' ";
			$res1=$heart->sql_query($sql1);
			$row1=$heart->sql_fetchrow($res1);
	  ?>
	  
	  <form name="frm1" method="post" action="vendor_process.php" id="frmadd" onsubmit="return validate();">
          
            <input type="hidden" name="act" value="add" />
			<input type="hidden" name="cust_add_valid" value=""  id="cust_add_valid"/>
          
          <table width="98%" class="tborder_new" cellspacing="1" align="center" cellpadding="6" border="0">
      <tr>
        <td colspan="4" class="style2">Add Vendor Section</td>
      </tr>
      
      <tr class="row1">
        <td width="22%" class="leftBarText">Email Id </td>
        <td class="leftBarText">
		<input type="text" class="forminputelement" name="email" id="email" value="" onkeyup="existing();" onblur="existing();"/>
		
		<input type="hidden" name="city_type_check_add" id="city_type_check_add" value="0">
		
		
		<span id = "email_not_exists_add" style ="display:none;">
		<img src="images/tick_circle.png" style="height:16px; width:16px;" align="absmiddle"/>
	    </span>
	    <span id = "email_exists_add" style ="display:none;">
		<img src="images/cross_circle.png" style="height:16px; width:16px;" align="absmiddle"/>
	    </span>
		
		</td>
		<td class="leftBarText">Password</td>
        <td width="28%"><input type="password" name="password" id="input-password" class="forminputelement"><br>
		<a href="#" class="back" id="generate" onclick="openPopup1()" style="text-decoration:none; padding:2px 2px 2px 2px;">Password Generator</a> 	
		<div id="fade_form1" class="black_overlay"></div>
		<div id="pop_form1" class="popupfrmCustomer1">
               <table width="100%" border="0" class="popupTableEmp1">
                 <tr>
                   <td align="right">
                     <img src="images/close.png" width="25" height="25" 
                      style="margin-right:-22px; margin-top:-22px; cursor:pointer;" onclick="closePopup1()" />				   </td>
                 </tr>
                 <tr>
                  <td valign="top">
				  <table align="center" width="100%" style="margin-bottom:10px;" cellpadding="6" cellspacing="1" border="0">
					 <tr>
					 <td class="headercontent" align="left"><font color="#FFFFFF" size="+1" style="text-shadow:#FFFFFF;">Password Generator</font></td>
     				 </tr>
				    </table>
				    <div style="overflow:auto;"> 
					 <table align="center" cellpadding="3" cellspacing="1" width="100%">
					 <tr>
					 <td style="border:thin solid #CCCCCC;">
					 <span id="password2" class="leftBarText" style="padding:5px;"></span>					 </td>
					 </tr>
					 <tr>
					 <td align="left" style="padding-top:7px;">
					 <input name="txtPasswordLength" type="hidden" id="txtPasswordLength" value="10" size="10">
					 <a href="javascript:void(0);" onclick="javascript:generate_password3();" style="text-decoration:none;">Generate Password</a>					 </td>
					 </tr>
					 <tr height="60">
					 <td>
					 <input type="checkbox" class="forminputelement" name="pass_safe" id="pass_safe" onclick="enablebtn(this.id);" align="absmiddle">
					 <font size="-5">I have Copied This Password In A Safe Place</font>					 </td>
					 </tr>
					 <tr>
					 <td width="50%" align="right" style="border-top:thin #6EA6D1 solid;" valign="middle">
					 <div style="padding:7px 0px 0px 0px;">
					 <input type="button" class="disablebuttonelements" id="confirm" onclick="usePassword()" value="Use Password" disabled="disabled">
					 <input type="button" class="redbuttonelements" onclick="closePopup1()" value="Cancel" style="cursor:pointer;">
					 </div>					 </td>	
					 </tr>
					 </table>
                    </div>                   </td>
                 </tr>
               </table>
          </div>		</td>
	  </tr>
	  <tr>
        <td colspan="4" class="style2">Personal Details</td>
      </tr>
	  <tr class="row2">
	  	<td width="22%" class="leftBarText">Vendor Name </td>
        <td width="28%"><input type="text" name="vendor_name" id="vendor_name" class="forminputelement"></td><td class="leftBarText">Vendor Phone No. </td>
        <td><input type="text" name="vendor_phone_number" id="vendor_phone_number" class="forminputelement"></td>
	  </tr>
	  <tr class="row1">
        <td rowspan="3" class="leftBarText" valign="top">Address </td>
        <td rowspan="3" valign="top"><textarea name="address" id="address" class="forminputelement" cols="23" rows="5"></textarea></td>
		<td class="leftBarText">Country</td>
        <td><span class="leftBarText">
          <select class="forminputelement" name="country_add" id="country_add" style="width:127px">
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
        </span>
		</td>
		</tr>
		<tr class="row2">
		<td class="leftBarText">State</td>
        <td>
        <span id="statePlaceholderAdd">
        <input type="text" class="forminputelement" name="state_add" id="state_add" value="<?=$row_vendor_edit['state']?>" />
        </span>
		</td>
		</tr>
		<tr class="row1">
        <td class="leftBarText">City</td>
        <td>
		<span id="cityPlaceholderAdd" class="leftBarText">
        <select class="forminputelement" name="city_add" id="city_add" style="width:127px">
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
                  </select>
        </span>		</td>
      </tr>
		<tr class="row2">
        <td class="leftBarText">Owner Name</td>
        <td width="28%"><input type="text" name="owner_name" id="owner_name" class="forminputelement"></td>
        <td width="22%" class="leftBarText">Owner Contact No.</td>
        <td width="28%"><input type="text" name="owner_contact_number" id="owner_contact_number" class="forminputelement"></td>
      </tr>
      <tr class="row1">
        <td class="leftBarText">Contact Person </td>
        <td width="28%"><input type="text" name="contact_person" id="contact_person" class="forminputelement"></td>
        <td class="leftBarText">Contact Person No. </td>
        <td><input type="text" class="forminputelement" name="vendor_mobile_number" id="vendor_mobile_number"></td>
      </tr>
      
      
      <tr class="row2">
        <td class="leftBarText">Vendor Reference </td>
        <td colspan="3"><input type="text" class="forminputelement" name="vendor_reference" id="vendor_ref" size="30"></td>
        </tr>
	  <tr>
        <td colspan="6" class="style2">Tax Details </td>
      </tr>
      <tr class="row1">
        <td class="leftBarText">VAT Number:</td>
        <td>
		<input type="text" class="forminputelement" name="vat_no" id="vat_no" />		</td>
        <td class="leftBarText">CST Number:</td>
        <td>
		<input type="text" class="forminputelement" name="cst_no" id="cst_no" />		</td>
      </tr>
      <tr class="row2">
        <td class="leftBarText">S.T. Number:</td>
        <td>
		<input type="text" class="forminputelement" name="st_no" id="st_no" />		</td>
        <td class="leftBarText">PAN Number:</td>
        <td>
		<input type="text" class="forminputelement" name="pan_no" id="pan_no" />		</td>
      </tr>
	  
	  <tr>
	  <td colspan="4" class="style2">
	  Product List	
	  
	  
	  
	  <img src="images/expand.png" onclick="opentgl()" style="float:right;cursor:pointer;" align="top" title="Click" id="expnd">
	   
	  </td>
	  </tr>
	  <tr>
	  <td colspan="4" style="margin:0px; padding:0px;">
	  <table width="100%" class="tborder_new" align="center" cellpadding="6" cellspacing="1" id="prod_list" style="display:none;">
	  <tr class="headercontent">
	  <td width="7%" align="center" class="leftBarText_new1">
	  <input type='hidden' name='check_all' id="check_all" onclick='checkall();'>	  
	  Sl No.
	  </td>
	  <td width="23%" align="center" class="leftBarText_new1">
	  Product Code	  </td>
	  <td width="51%" align="center" class="leftBarText_new1">
	  Product Name	  </td>
	  <td width="19%" align="center" class="leftBarText_new1">
	  Price	  </td>
	  </tr>
	  
	  
	  
	  
	  
	  <?
	  $sql_product = "SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE `status` = 'A'";
	  $res_product = $heart->sql_query($sql_product); 
	  $maxrow_product = $heart->sql_numrows($res_product); 
	  ?>
	  <?
	  if($maxrow_product>0)
	  { while($row_product = $heart->sql_fetchrow($res_product))
	  { @$i++;
	  ?>
	  <tr class="<?=($i%2==0)?'row1':'row2'?>">
	  <td valign="top" align="center"><?=$i;?>
	  <input type="hidden" name="checkvalue[]" value="<?=$row_product['pd_id']?>" id="checkvalue">	  </td>
	  
	  <td align="center" valign="top">
	  <?=$row_product['pd_code']?>	  </td>
	  <td valign="top" align="left">
	  <font color="#990033"><?=$row_product['pd_name']?></font>	  </td>
	  <td valign="top" align="center">
	  <b>&#8377;</b><input type="text" class="forminputelement" value="<?=$row_product['pd_price']?>.00" name="price[]" id="price_<?=$i;?>" style="text-align:right;"></td>
	  </tr>
	  <?
	  }
	  }
	  ?>
	  </table>
      <tr class="row2">
	  
        <td colspan="6" align="center">
			<a class="brownbttn" name="back" id="back" class="back" href="<?=$_SERVER['PHP_SELF']?>"/>Back</a>
			<input type="submit" name="save" value="Save" class="loginbttn"/>
		</td>
		</tr>
    </table> 
		  
     </form>
	  <? 
	  } 
	  
	  //view customer details
	  if($show=='view'){
	  ?>
	  <?
	  $sql_vendor_view = "SELECT vendor.id,
	  							 vendor.email, 
	  							 vendor.owner_name, 
								 vendor.owner_contact_number, 
								 vendor.owner_contact_number,
								 vendor.contact_person,
								 vendor.vendor_name,
								 vendor.vendor_phone_number,
								 vendor.vendor_mobile_number,
								 vendor.address,
								 vendor.country,
								 vendor.modby,
								 vendor.modify_ip,
								 vendor.modidate,
								 vendor.state, 
								 vendor.city,
								 vendor.vendor_reference,
								 vendor.vat_no,
								 vendor.cst_no,
								 vendor.st_no,
								 vendor.pan_no,
								 country.country_id,
								 country.country_name,
								 location.id,
								 location.name
								 
						  FROM ".$cfg['DB_VENDOR']." vendor 
						  
						  INNER JOIN ".$cfg['DB_LOCATION']." location 
						  
						  ON vendor.city=location.id
						  
						  INNER JOIN ".$cfg['DB_COUNTRY_MASTER']." country 
						  ON vendor.country=country.country_id
						  
						  WHERE vendor.id = '".$_REQUEST['id']."'";
						  
						  
	  $res_vendor_view = $heart->sql_query($sql_vendor_view);
	  $row_vendor_view = $heart->sql_fetchrow($res_vendor_view);
	  ?>
		  <table width="98%" class="tborder_new" cellspacing="1" align="center" cellpadding="6" border="0">
      <tr>
        <td colspan="4" class="style2" valign="middle">View Vendor Section <a href="vendor.php?show=edit&id=<?=$_REQUEST['id']?>"><img src="images/edit_frm.png" alt="Edit" title="Edit" align="absmiddle" style="float:right;" width="16"></a></td>
      </tr>
      
      <tr class="row1">
        <td width="22%" class="leftBarText">Email Id</td>
        <td colspan="3" class="leftBarText">
		<span style="border:thin solid; background-color:#333333;"><font color="#FFFFFF"><b><?=$row_vendor_view['email']?></b></font></span>		</td>
      </tr>
	  <tr>
        <td colspan="4" class="style2">Personal Details</td>
      </tr>
	  <tr class="row2"><td width="21%" class="leftBarText">Vendor Name </td>
        <td width="30%">
		<?=$row_vendor_view['vendor_name']?>		
		</td>
		<td class="leftBarText">Vendor Phone No. </td>
        <td>
		<?=$row_vendor_view['vendor_phone_number']?>
		</td>
		</tr>
		<tr class="row1">
        <td rowspan="3" class="leftBarText" valign="top">Address </td>
        <td rowspan="3" valign="top">
		<?=$row_vendor_view['address']?>
		</td>
        <td class="leftBarText">Country</td>
        <td>
		<?=$row_vendor_view['country_name']?>
		</td>
      </tr>
	  <tr class="row2">
        <td class="leftBarText">State</td>
        <td>
        <?=$row_vendor_view['state']?>
		</td>
      </tr>
      <tr class="row1">
        <td class="leftBarText">City</td>
        <td>
		<?=$row_vendor_view['name']?>		</td>
      </tr>
	  <tr class="row2">
	  <td class="leftBarText">Owner Name</td>
        <td width="28%"><?=$row_vendor_view['owner_name']?></td>
        <td width="22%" class="leftBarText">Owner Contact No.</td>
        <td width="28%"><?=$row_vendor_view['owner_contact_number']?></td>
      </tr>
      <tr class="row1">
        <td class="leftBarText">Contact Person </td>
        <td width="27%">
		<?=$row_vendor_view['contact_person']?>
		</td>
        <td class="leftBarText">Vendor Mobile No. </td>
        <td>
		<?=$row_vendor_view['vendor_mobile_number']?>
		</td>
      </tr>
      <tr class="row2">
        <td class="leftBarText">Vendor Reference </td>
        <td colspan="3">
		<?=$row_vendor_view['vendor_reference']?>
		</td>
        </tr>
	  <tr class="style2">
        <td colspan="6" class="theader">Tax Details </td>
      </tr>
      <tr class="row1">
        <td class="leftBarText">VAT Number:</td>
        <td>
		<?=$row_vendor_view['vat_no']?>
		</td>
        <td class="leftBarText">CST Number:</td>
        <td>
		<?=$row_vendor_view['cst_no']?>
		</td>
      </tr>
      <tr class="row2">
        <td class="leftBarText">S.T. Number:</td>
        <td>
		<?=$row_vendor_view['st_no']?>
		</td>
        <td class="leftBarText">PAN Number:</td>
        <td>
		<?=$row_vendor_view['pan_no']?>
		</td>
      </tr>
	  <tr>
        <td colspan="6" class="style2">Modification Details </td>
      </tr>
      <tr class="row1">
        <td class="leftBarText">Modified By :</td>
        <td>
		<?=$row_vendor_view['modby']?>
		</td>
        <td class="leftBarText">Last Modified Date:</td>
        <td>
		<?=date('d/m/Y',strtotime($row_vendor_view['modidate']))?>
		</td>
      </tr>
      <tr class="row2">
        <td class="leftBarText">Modification IP:</td>
        <td>
		<?=$row_vendor_view['modify_ip']?>
		</td>
        <td class="leftBarText">Last Modified Time:</td>
        <td>
		<?=date('H:i:s',strtotime($row_vendor_view['modidate']))?>
		</td>
      </tr>
	  <tr>
	  <td colspan="4" class="style2">
	  Product List
	  </td>
	  </tr>
	  <tr>
	  <td colspan="4" style="margin:0px; padding:0px;">
	  <table width="100%" class="tborder_new" align="center" cellpadding="6" cellspacing="1">
	  <tr class="headercontent">
	  <td width="7%" align="center" class="leftBarText_new1">
	  Sl No.
	  </td>
	  <td width="23%" align="center" class="leftBarText_new1">
	  Product Code	  </td>
	  <td width="51%" align="center" class="leftBarText_new1">
	  Product Name	  </td>
	  <td width="19%" align="center" class="leftBarText_new1">
	  Price(Rs)  </td>
	  </tr>
	  <?
	  $sql_product = "SELECT product.pd_id, 
								  product.pd_code, 
								  product.pd_name, 
								  product.pd_price, 
								  vendor.product_id, 
								  vendor.vendor_id,
								  vendor.price, 
								  vendor.id 
						  
						     FROM ".$cfg['DB_PRODUCT']." product 
					   INNER JOIN ".$cfg['DB_VENDOR_PRODUCT_AVAIL']." vendor
						       ON product.pd_id=vendor.product_id 
						    
							WHERE vendor.vendor_id = '".$_REQUEST['id']."'";
	  $res_product = $heart->sql_query($sql_product); 
	  $maxrow_product = $heart->sql_numrows($res_product); 
	  ?>
	  <?
	  if($maxrow_product>0)
	  { while($row_product = $heart->sql_fetchrow($res_product))
	  { @$i++;
	  ?>
	  <tr class="<?=($i%2==0)?'row1':'row2'?>">
	  <td valign="top" align="center">
	  <?=$i;?>
	  </td>
	  
	  <td align="center" valign="top">
	  <?=$row_product['pd_code']?>
	  </td>
	  <td valign="top" align="left">
	  <font color="#990033"><?=$row_product['pd_name']?></font>
	  </td>
	  <td valign="top" align="center">
	   <?=$row_product['price']?>
	  </td>
	  </tr>
	  <?
	  }
	  }
	  else
	  {
	  ?>
	  <tr class="row2">
	  <td colspan="4" align="center" class="msg">
	  No Product Available...
	  </td>
	  </tr>
	  <?
	  }
	  ?>
	  </table>
      <tr>
	  
        <td colspan="6" align="center" style="padding:20px 0;"><a name="back" id="back" class="brownbttn" href="<?=$_SERVER['PHP_SELF']?>" />Back</a>
        </td>
		</tr>
    </table> 
		  
    
	  <? 
	  } 
	  
	  //view customer details
	 
	 ?>
	  
	  
	  
	  
	    </td>
        </tr>
		<tr height="16">
		<td height="16" colspan="2" style="background:url(images/foot_bg.jpg) center top no-repeat;">&nbsp;</td>
		</tr>
      </table> 
      </td>   
	  
    </tr>
	<tr><td colspan="3" align="right"></td></tr>
  </table>
