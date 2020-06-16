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



<script type="text/javascript"> 

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
			<a href="login.php?act=<?=md5("logout")?>" title="Logout"><img src="images/lock.png" height="24" width="24" border="0" style="vertical-align: middle;" /></a>&nbsp;&nbsp;
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
	   
    <form name="frmSearch" method="post" action="login_details.php" onsubmit="return FormValidator.validate(this);">
		<table width="98%" class="tborder_new" cellspacing="1" align="center" >	
		  <tr>
			<td class="style2" colspan="7" align="center"> 
			  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="3">
				<tr align="center">
				  <td align="left" width="100%">LOGIN DETAILS</td>
				</tr>
			  </table>		   </td>
		  </tr>	
		  <tr>
			<td><table width="100%" cellpadding="6" cellspacing="1">
              <tr class="headercontent">
                <td width="7%" align="center" class="leftBarText_new1">Sl No.</td>
                <td align="center" width="10%" class="leftBarText_new1">User Type </td>
                <td width="13%" align="center" class="leftBarText_new1">Login IP</td>
                <td width="20%" align="center" class="leftBarText_new1">Login Date & Time</td>
                
                </tr>
              <?
	$sql_total="SELECT * FROM ".$cfg['DB_LOGIN_RECORDS']." ORDER BY `loginTime` DESC";
	  
	 $res_total = $heart->sql_query($sql_total);
	 $maxrow_total = $heart->sql_numrows($res_total);
	if($maxrow_total > 0)
		{
			while($row_total = $heart->sql_fetchrow($res_total))
				{@$i++;
?>
              <tr class="<?=($i%2==0)?'row2':'row1'?>">
                <td align="center"><?=$i;?></td>
                <td align="center"><?=$row_total['userType']?></td>
                <td align="center"><?=$row_total['ip']?></td>
                <td align="center"><?=$row_total['loginTime']?></td>
                
                </tr>
              <?
}}
?>
            </table></td>
		  </tr>
		  <tr>
		  <td colspan="7" align="right">
		<?=$heart->paginate($maxrow, $limit, $pageno, "pageno", "link")?>
		</td>
		</tr>
		</table>
		
	</form>
<?php
}


?>
	