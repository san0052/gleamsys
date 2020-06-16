<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
//include('../includes/template.php');
$this_page='city.php';
//include_once('../includes/links_frontend.php');
if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}
if($_REQUEST['m']==3) { $msg='Record Deleted';}
if($_REQUEST['m']==9) { $msg='Content should not be blank';}
page_header($cfg['ADMIN_TITLE']." - City Management");
$show=$_REQUEST['show'];
?>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />

<script language="javascript" src="js/ajax1.js"></script>
<script language="javascript" src="js/common2.js"></script>
<script language="javascript" src="scripts/checkCity.js"></script>
<script language="javascript" src="scripts/stateGen.js"></script>
<script language="javascript" src="scripts/CountryStateCityRetriver.js"></script>
<style type="text/css">
<!--
.style3 {color: #FFFFFF}
-->
</style>

<script>
function getstate_cust(id)
{
	var st='<select name=\"state_add\" id=\"state_add\" class=\"forminputelement\" disabled=\"disabled\" ><option value=\"\" >Select State</option></select>';
	if(id!="")
	{
		var act='getstate';
		//alert('city_process.php?act='+act+'&id='+id);
		http.open('get','city_process.php?act='+act+'&id='+id);
		http.onreadystatechange = handleResponsestatecust;
		http.send(null);
	}
	else
	{
		document.getElementById("state").innerHTML = '';
		document.getElementById("state").innerHTML = st;
	}
}
function handleResponsestatecust() 
{
	if(http.readyState == 4 && http.status == 200)
	{
		var response = http.responseText;
		if(response!="")
		{
			
			document.getElementById("state").innerHTML = '';
			document.getElementById("state").innerHTML = response;
		}
	}
}
function edit_cat_val1()
	{
		if(document.getElementById("category_edit").value!='' && document.getElementById("type_check_edit").value==1)
		{
		   alert('This category already exists');
		   document.getElementById("category_edit").focus();
		   return false;
		}		
		if(document.getElementById("link_edit").value=="")
		{
			alert('Please enter link');
		   document.getElementById("link_edit").focus();
		   return false;
		}
	}
function add_city()
{
	//alert(document.getElementById("add_title").value);
	if(document.getElementById("state_add").value=='')
	{
	   alert('Please Select state');
	   document.getElementById("state_add").focus();
	   return false;
	}
	else if(document.getElementById("category").value=='')
	{
	   alert('Please Enter city');
	   document.getElementById("category").focus();
	   return false;
	}
	else if(document.getElementById("type_check").value==1)
	{
	   alert('This city already exists');
	   document.getElementById("category").focus();
	   return false;
	}
	else if(document.getElementById("type_check").value=='')
	{
	   alert('Please insert correctly');
	   document.getElementById("category").focus();
	   return false;
	}
	else
	{
		return true;
	}
	
}
function edit_city()
{
	//alert(document.getElementById("edit_title").value);
	 if(document.getElementById("category_edit").value!='' && document.getElementById("type_check_edit").value==1)
	 {
		alert('This city already exists');
		document.getElementById("category_edit").focus();
	    return false;
	}
	else
	{
		return true;
	}
}

</script>

<script>
	var ar = new Array();
	n = 0;
	var flag=0;
function validation_delete(pageno)
{ 
  var n=0;
  var flag=0;
  var flag=0;
          var ar=new Array();
		  var n=0;
		  var view='<?=$_REQUEST['view']!=''?$_REQUEST['view']:'all'?>';
		   var sid='<?=$_REQUEST['sid']!=''?$_REQUEST['sid']:'0'?>';
		    var cid='<?=$_REQUEST['cid']!=''?$_REQUEST['cid']:'0'?>';
		  
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
		 if(confirm('Do you want to delete these records')==true)
		   {   
		     var pageno1='<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>';
			 var src_ct3='<?=$_REQUEST['src_ct']?>'; 
			 var src_country3='<?=$_REQUEST['src_country']?>'; 
			 var src_state3='<?=$_REQUEST['src_state']?>';
		     window.location.href="city_process.php?act=del_category&pageno="+pageno1+"&id="+ar+"&view="+view+"&src_ct="+src_ct3+"&src_country="+src_country3+"&src_state="+src_state3+"&sid="+sid+"&cid="+cid;
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
		     var pageno1='<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>'; 
			 var src_ct1='<?=$_REQUEST['src_ct']?>'; 
			 var src_country1='<?=$_REQUEST['src_country']?>'; 
			 var src_state1='<?=$_REQUEST['src_state']?>';
		     window.location.href="city_process.php?act=ActiveCat&pageno="+pageno1+"&id="+ar+"&view="+view+"&src_ct="+src_ct1+"&src_country="+src_country1+"&src_state="+src_state1+"&sid="+sid+"&cid="+cid;
			 return true;
	       }
		   else
		   {
		     return false;
		   }
	 	
		}	
	}
		  if(document.frm1.dropdown1.value=='Inactive')
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
		 if(confirm('Do you want to inactivate these records')==true)
		   {   
		     var pageno1='<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>';
			 var src_ct2='<?=$_REQUEST['src_ct']?>'; 
			 var src_country2='<?=$_REQUEST['src_country']?>'; 
			 var src_state2='<?=$_REQUEST['src_state']?>'; 
		     window.location.href="city_process.php?act=InactiveCat&pageno="+pageno1+"&id="+ar+"&view="+view+"&src_ct="+src_ct2+"&src_country="+src_country2+"&src_state="+src_state2+"&sid="+sid+"&cid="+cid;
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

	function openDeliveryTypeBox(obj,id){	
		if(obj.checked){
			if(obj.value=='M'){
				document.getElementById(id).style.display = "block";	
			}
			if(obj.value=='R'){
				document.getElementById(id).style.display = "block";	
			}
			if(obj.value=='F'){
				document.getElementById(id).style.display = "block";	
			}
		}
		else document.getElementById(id).style.display = "none";	}

</script>
<td valign=top align="top" width="100%">
  <!-- Start Body Here -->
  <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
  
    <tr height="34">
      <td width="25%" rowspan="2" colspan="3" align="center" valign="top"><br /><br />
	 	 <?php include_once("left_bar.php");?>
	  </td>
	  </tr>
    <tr>
      <td align="center" valign="top"><img src="images/spacer.gif" align="left" width="1" height="410" /></td>
	  <td align="left" valign="top" width="99%">     
	  <table width="698" align="center" border="0" cellspacing="0" cellpadding="0">
	  	<tr height="35" background="images/welcome_head.jpg">
     	 <td align="left" valign="middle">&nbsp;&nbsp;<span class="style1">Welcome <?=$_SESSION['admin_user_name']?></span></td>
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
	  </tr>
	  <tr height="16">
            <td colspan="4" align="left" valign="middle" style="background-color:#eee8e8;">&nbsp;</td>
          </tr>
	  <tr>
	  <td colspan="2" style="background-color:#eee8e8;" align="center">
	  
	  <? //show all record
	   if($_REQUEST['show']==''){
	   $returnCatId=($_REQUEST['catId']=="")?'0':$_REQUEST['catId'];
	   ?>
	   <form name="frm1" id="frm1" action="city_process.php">
	   <input type="hidden" name="act" id="act" value="search_city" />
	   <?php
	   if($_REQUEST['src_country']!=0)
	   {
	       $_REQUEST['cid']=$_REQUEST['src_country'];
	   }
	   if($_REQUEST['src_state']!=0 || $_REQUEST['src_state']!='')
	   {
	       $_REQUEST['sid']=$_REQUEST['src_state'];
	   }
	   ?>
	    <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="6" align="left"><span class="style2">City Section</span></td>
              </tr>
          </thead>
          <tbody>
            <? if($_REQUEST['m']){ ?>
				<tr class="row1">
				  <td colspan="8" align="left"><div class="msg"><?=@$msg?></div></td>
				</tr>
			<? } ?>
           
            <tr class="row1">
              <td colspan="6" align="left" class="leftBarText_new1">
			  <table width="100%" border="0">
			  <tr>
			    <td width="25%">
			      <span class="leftBarText_new">City Name : </span>
				  <input name="city_name" type="text" class="forminputelement" id="city_name" value="<?=$_REQUEST['src_ct']?>" /></td>
				<td width="35%">
				  <span class="leftBarText_new">Country : </span>
				  <select name="country_name" class="forminputelement" id="country_name" onChange="getstateindex(this.value)">			
				  <option value="0" <?=($_REQUEST['cid']==0)?'selected="selected"':''?>>All Country</option>
					 
				<?php 
				  $sql1="SELECT * FROM ".$cfg['DB_COUNTRY_MASTER']." WHERE `status`='A' ORDER BY `country_name`ASC";  
				  $res1=$heart->sql_query($sql1);
				  while($row1c=$heart->sql_fetchrow($res1))
				  {
				?>
				    <option value="<?=$row1c['country_id']?>"<?=($_REQUEST['cid']==$row1c['country_id'])?'selected="selected"':''?>><?=ucfirst($row1c['country_name'])?></option>
				<?php 
				  } 
				?>					 
	              </select>				
				  </td>
				<td width="25%">
				<span class="leftBarText_new">State :</span>

				   
				   <div id="state">
				     <select name="state_name" class="forminputelement" id="state_name" style="width:130px;">
	                 <option value="" >Select State</option> 
					 <?php
					  if($_REQUEST['cid']!='0' && $_REQUEST['cid']!='') 
					  {
						  $sql9="SELECT * FROM ".$cfg['DB_STATE']." WHERE `status`='A' AND `country_id`=".$_REQUEST['cid']." ORDER BY `state_name` ASC";
					      $res9=$heart->sql_query($sql9);
					      while($row9=$heart->sql_fetchrow($res9))
					      {
				     ?>
	                        <option value="<?=$row9['st_id']?>" <?=($_REQUEST['sid']==$row9['st_id'])?'selected="selected"':''?>><?=ucfirst($row9['state_name'])?></option>
	                 <?php 
				          } 
					  }
				     ?>	
	               </select>
				   </div>				   
				</td>
				<td width="9%"><input  name="searchorder" type="submit" value="search" class="loginbttn"/></td>
			  </tr>
				 </table>		  
			  </td>
              </tr>
            <tr class="headercontent">
			  <td width="5%" align="center" class="leftBarText_new1">
				 <input name="check_all" id="check_all" class="check-all" type="checkbox" onClick="checkall();"/>			  </td>
              <td width="7%" align="center" class="leftBarText_new1">Sl No </td>
              <td align="left" class="leftBarText_new1" colspan="3">City</td>
              <td width="12%" align="center" class="leftBarText_new1">Action</td>
            </tr>
		  
		<?  
			
			$sql = "SELECT DISTINCT ct.ct_id, ct.city_name,ct.status,ct.state_id, ctry.country_id, ctry.country_name, st.state_name
			        FROM ".$cfg['DB_CITIES']." ct, ".$cfg['DB_STATE']." st, ".$cfg['DB_COUNTRY_MASTER']." ctry 
			        WHERE ct.status <> 'D'
			        AND ct.state_id=st.st_id 
				    AND st.country_id=ctry.country_id ";
			if($_REQUEST['src_ct']!='')
			{
			    $sql=$sql."AND ct.city_name LIKE '".$_REQUEST['src_ct']."%'";
			}
			if($_REQUEST['src_country']!=0)
			{
			    $sql=$sql."AND ctry.country_id='".$_REQUEST['src_country']."'";
			}
			if($_REQUEST['src_state']!=0)
			{
			    $sql=$sql."AND ct.state_id='".$_REQUEST['src_state']."'";
			}
			
			 $sql=$sql." ORDER BY country_name, state_name, city_name";
			 			 
			 $res=$heart->sql_query($sql);
			 $maxrow=$heart->sql_numrows($res);
			 $sql = $sql. " LIMIT $offset,$limit";
			 $res = $heart->sql_query($sql);
			 if($maxrow >0){
			 while($row=$heart->sql_fetchrow($res))
			 {
			 @$i++;
			?>
            <tr class="<?=($i%2==0)?'row1':'row2'?>">

			<td align="center">	
			
			<input  name="checkvalue" id="checkvalue"  value="<?=$row['ct_id']?>" type="checkbox" /></td>
              <td align="center"><?=$i+$offset?></td>
              <td align="left">&nbsp;<?=$row['city_name']?></td>
              <td align="right" colspan="2" style="font-size: 10px; font-style: italic;" >&nbsp;<?=$row['state_name'].', '.$row['country_name']?></td>
              <td align="center">
			  <a href="city.php?show=edit_category&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&src_ct=<?=$_REQUEST['src_ct']?>&src_country=<?=$_REQUEST['src_country']?>&src_state=<?=$_REQUEST['src_state']?>&id=<?=$row['ct_id']?>&view=<?=$_REQUEST['view']?>"><img src="images/edit.gif" title="Edit" width="16" height="16" border="0" /></a>
			  
			  <a href="city_process.php?act=del_category&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&src_ct=<?=$_REQUEST['src_ct']?>&src_country=<?=$_REQUEST['src_country']?>&src_state=<?=$_REQUEST['src_state']?>&id=<?=$row['ct_id']?>&view=<?=$_REQUEST['view']?>"><img src="images/drop.gif" title="Delete" width="16" height="16" border="0" onClick="return confirm('Do you really want to delete this record');" /></a>
			</td>
            </tr>
			<? }
			}
			  else {?>
            <tr class="row1">
              <td colspan="6" align="center" class="msg">No Record.</td>
            </tr>  <? }

?>

		<tr >
		<td colspan="3" align="left" >
				<? if($maxrow >0){ ?>
				<select name="dropdown1" class="forminputelement">
					<option value="">Choose an action...	</option>
					<option value="delete">Delete</option>	
					<option value="Active">Active</option>
					<option value="Inactive">Inactive</option>							
				</select>
				<input value="Apply to selected"  name="submit" type="button" onClick="return validation_delete();" class="loginbttn"/>
			<? } ?>			</td>
             </tr>
          </tbody>
        </table>
		<div class="bottomsecc">
			<div class="pagisecc">
				<?=$heart->paginate($maxrow, $limit, $pageno, "pageno", "link")?>
				<div class="clr"></div>
			</div>
			<div class="clr"></div>	
				<a class="brownbttn" href="city.php?show=add_category&src_ct=<?=$_REQUEST['src_ct']?>&src_country=<?=$_REQUEST['src_country']?>&src_state=<?=$_REQUEST['src_state']?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&view=<?=$_REQUEST['view']?>&sid=<?=($_REQUEST['sid']!='')?$_REQUEST['sid']:'0'?>&cid=<?=($_REQUEST['cid']!='')?$_REQUEST['cid']:'0'?>">Add New City</a>
		</div>
		</form>
		<? }
		
		
	
		// show insert window
		
		
		
		/* Stary Brand */
		
		
	 if($show=='add_category') { ?>
	  <form name="frmtypeadd" method="post" action="city_process.php" id="frmtypeadd" onsubmit="return add_city();">
          <p>
            <input type="hidden" name="act" value="insert_category" />
			<input type="hidden" name="type_check" value=""  id="type_check"/>
			<input type="hidden" name="view" value="<?=$_REQUEST['view']?>" />			
			<input name="sid" type="hidden" id="sid" value="<?=($_REQUEST['sid']!='')?$_REQUEST['sid']:'0'?>"/>
			<input name="cid" type="hidden" id="cid" value="<?=($_REQUEST['cid']!='')?$_REQUEST['cid']:'0'?>"/>
          </p>
          <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="5" align="left" class="style2">Add City Section </td> 
              </tr> 
            </thead> 
            <tbody> 
              <tr class="row1">
                <td colspan="5" align="left">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                   <tr>
                    <td align="left" class="breadCrumbs">
                      <a href="admin.php">Home</a> &raquo; <a href="<?=$_SERVER['PHP_SELF']?>?pageno=<?=$_REQUEST['pageno']?>">City</a></td>
                    </tr>
                  </table>
                </td>
              </tr>
			   <tr class="row2"> 
                <td width="30%" align="left" class="leftBarText">Country <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				<select name="country_add" id="country_add" class="forminputelement" onchange="getStateList('country_add','state_add','stateAdd','','');">
					<option value="">Select Country</option>
				<?
					$sql_cname="SELECT * FROM ".$cfg['DB_COUNTRY_MASTER']." WHERE `status`='A' ORDER BY `country_name` ASC";
					$res_cname=$heart->sql_query($sql_cname);
					while($row_cname=$heart->sql_fetchrow($res_cname))
					{
				?>
						<option value="<?=$row_cname['country_id']?>" <?php if($_SESSION['country_add']==$row_cname['country_id']) {?> selected="selected" <? }?>>
						<?=$row_cname['country_name']?></option>	
					<? } ?>						
				</select>
				</td>
              </tr> 
			   <tr class="row1"> 
                <td width="30%" align="left" class="leftBarText">State <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				<div id="stateAdd" onclick="city_availability_add();">
					<select name="state_add" id="state_add" class="forminputelement" onchange="city_availability_add();">
					<option value="" >Select State</option>	
				    </select>
				</div>
				</td>
              </tr> 
              <tr class="row2"> 
                <td width="30%" align="left" class="leftBarText">City <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				<div id="cityAdd" >
				<input name="category" type="text" class="forminputelement" id="category"  
				onblur="city_availability_add();" onkeyup="city_availability_add();" />
				&nbsp;&nbsp;
				<span style="display:none;" id="exsists"><img src="images/cross_circle.png"  align="absmiddle" width="16"/>&nbsp;Already exists</span>
				<span style="display:none;" id="notexsists"><img src="images/tick_circle.png" width="16" align="absmiddle" />&nbsp;Available</span></div>
				</td>
              </tr>
				<tr class="row1"> 
				<td width="30%" align="left" class="leftBarText">Choose Delivery Type</td>
				<td width="70%"  align="left" class="leftBarText">
				<table width="100%" border="0" cellpadding="2" cellspacing="0" class="tborder_new">
				<tr class="row1">
				<td>Mid Night Delivery</td>
				<td><input type="checkbox" name="mid" id="mid" value="M" onclick="openDeliveryTypeBox(this,'mid_night_place_holder');"></td>
				<td>Remote Area Delivery</td>
				<td><input type="checkbox" name="remote" id="remote" value="R" onclick="openDeliveryTypeBox(this,'remote_area_place_holder');"></td>
				<td>Fixed time Delivery</td>
				<td><input type="checkbox" name="fixed" id="fixed" value="F" onclick="openDeliveryTypeBox(this,'fixed_time_place_holder');"></td>
				</tr>
				</table>
				</td>
				</tr>
				<tr class="row2" > 
				<td width="30%" align="left" class="leftBarText" colspan="2" style="padding:0px; margin:0px;">
				<div id="mid_night_place_holder" style="display:none;">
					<table width="100%" border="0"  cellpadding="5" cellspacing="0" class="tborder_new">
					<tr class="row2">
					<td width="30%" class="leftBarText" align="left">Mid Night Delivery Price<span class="redstar">*</span></td>
					<td align="left" width="70%"><input name="mid_price" id="mid_price" type="text" class="forminputelement" /></td>
					</tr>
					</table>
				</div>
				</td>
				</tr>
				<tr class="row1"> 
				<td width="30%" align="left" class="leftBarText" colspan="2" style="padding:0px; margin:0px;">
				<div id="remote_area_place_holder" style="display:none;">
					<table width="100%" border="0"  cellpadding="5" cellspacing="0" class="tborder_new">
					<tr class="row1">
					<td width="30%" align="left" class="leftBarText">Remote Area Delivery Price<span class="redstar">*</span></td> 
					<td width="70%" align="left"><input name="remote_price" id="remote_price" type="text" class="forminputelement" /></td>
					</tr>
					</table>
				</div>
				</td>
				</tr> 
				<tr class="row2"> 
				<td width="30%" align="left" class="leftBarText" colspan="2" style="padding:0px; margin:0px;">
				<div id="fixed_time_place_holder" style="display:none;">
					<table width="100%" border="0"  cellpadding="5" cellspacing="0" class="tborder_new">
					<tr class="row2">
					<td width="30%" align="left" class="leftBarText">Fixed time Delivery Price<span class="redstar">*</span></td> 
					<td width="70%" align="left"><input name="fixed_price" id="fixed_price" type="text" class="forminputelement" /></td>
					</tr>
					</table>
				</div>
				</td>
				</tr>  
				<tr> 
				
				<td colspan="4" align="center"><input type="submit" name="Save" id="Save" value="Save" class="loginbttn"></td> 
				</tr> 
            </tbody> 
          </table> 
      </form>
	  <? }
	  
	  /* end brand */

		
	  // show edit window
	  if($show=='edit_category'){
	
	  
	   $sql="SELECT * FROM ".$cfg['DB_CITIES']." WHERE  `ct_id` =".$_REQUEST['id']."";
			$res=$heart->sql_query($sql);
			$row=$heart->sql_fetchrow($res);
			
	  ?>
	  <form name="frmtypeedit" method="post" action="city_process.php" id="frmtypeedit" onSubmit="return edit_city();">
          <p>
            <input type="hidden" name="act" value="edit_category" />
			<input type="hidden" name="type_check_edit" value="insert"  id="type_check_edit"/>
			<input type="hidden" name="cityid" value="<?=$_REQUEST['id']?>" />
			<input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>" />
			<input name="stateid" type="hidden" id="stateid" value="<?=$row['state_id']?>"/>
			<input type="hidden" name="view" value="<?=$_REQUEST['view']?>" />			
			<input name="sid" type="hidden" id="sid" value="<?=($_REQUEST['sid']!='')?$_REQUEST['sid']:'0'?>"/>
			<input name="cid" type="hidden" id="cid" value="<?=($_REQUEST['cid']!='')?$_REQUEST['cid']:'0'?>"/>
          </p>
          <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="5" align="left" class="style2">Edit City Section </td> 
              </tr> 
            </thead> 
            <tbody> 
              <tr class="row2">
                <td colspan="5" align="left">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                   <tr>
                    <td align="left" class="breadCrumbs">
                      <a href="admin.php">Home</a> &raquo; <a href="<?=$_SERVER['PHP_SELF']?>?pageno=<?=$_REQUEST['pageno']?>">City</a></td>
                    </tr>
                  </table>
                </td>
              </tr>
			  <input name="category_or" type="hidden" style=" border-color:#98C1B5; background-color:#98C1B5;" class="forminputelement" id="category_or" value="<?=$row['city_name']?>" readonly="readonly" />
			  <!--<tr> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">City</span> </td> 
                <td width="70%" colspan="4" align="left"><input name="category_or" type="hidden" style=" border-color:#98C1B5; background-color:#98C1B5;" class="forminputelement" id="category_or" value="<?=$row['city_name']?>" readonly="readonly" /></td>
              </tr> -->
			  
				 <tr class="row1"> 
                <td width="30%" align="left" class="leftBarText">Country <span class="redstar">*</span></td> 
                
				
				<td width="70%" colspan="4" align="left">
				<? $counid=getFieldsFromTable($row['state_id'],'country_id',$cfg['DB_STATE'],'st_id')?>
					<select name="country_add" id="country_add" class="forminputelement" onchange="getstate_cust(this.value);">
					
				<?
					$sql_cname="SELECT * FROM ".$cfg['DB_COUNTRY_MASTER']." ORDER BY `country_name` ASC";
					$res_cname=$heart->sql_query($sql_cname);
					while($row_cname=$heart->sql_fetchrow($res_cname))
					{
				?>
						<option value="<?=$row_cname['country_id']?>" <?php if($counid==$row_cname['country_id']) {?> selected="selected" <? }?>><?=$row_cname['country_name']?></option>	
					<? } ?>						
				</select>
				</td>
              </tr> 
			  <tr class="row2"> 
                <td width="30%" align="left" class="leftBarText">State <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				
				<div id="state">
				
					<select name="state_add" id="state_add" class="forminputelement" onchange="getcity_cust(this.value);">
			<?
					$sql_cname="SELECT * FROM ".$cfg['DB_STATE']." WHERE `country_id`='".$counid."'";
					$res_cname=$heart->sql_query($sql_cname);
					$maxrow1=$heart->sql_numrows($res_cname);
					if($maxrow1 >0)
				 {
					 while($row_cname=$heart->sql_fetchrow($res_cname))
					 { ?>
						<option value="<?=$row_cname['st_id']?>" <?php if($row['state_id']==$row_cname['st_id']) {?> selected="selected" <? }?>>
						<?=$row_cname['state_name']?></option>	
				<? }
				 }
	 			?>
				</select>
				</div>
				
				</td>
              </tr> 
              <tr class="row1"> 
                <td width="30%" align="left" class="leftBarText">Change City <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				<input name="category_edit" type="text" class="forminputelement" 
				id="category_edit" onkeyup="city_availability_edit();" onBlur="city_availability_edit();"  value="<?=$row['city_name']?>"/>
				&nbsp;&nbsp;
				<span style="display:none;" id="exsists_edit"><img src="images/cross_circle.png"  align="absmiddle" width="16"/>&nbsp;Already exists</span>
				<span style="display:none;" id="notexsists_edit"><img src="images/tick_circle.png" width="16" align="absmiddle" />&nbsp;Available</span></div>
				<span style="display:none;" id="same_edit"><img src="images/s_warn.gif"  align="absmiddle" width="16"/>&nbsp;You Entered Same Name !!</span></div>
				</td>
              </tr> 
			<tr class="row1"> 
<td width="30%" align="left" class="leftBarText">Choose Delivery Type</td>
<td width="70%"  align="left" class="leftBarText">
	<table width="100%" border="0" cellpadding="2" cellspacing="0" class="tborder_new">
	<tr class="row1">
	<td>Mid Night Delivery</td>
	<td><input type="checkbox" name="mid_edit" id="mid_edit" value="M" <? if($row['midnight_delivery_price']!='' && $row['midnight_delivery_price']!=0){?> checked="checked" <? } ?> onclick="openDeliveryTypeBox(this,'mid_night_place_holder');"></td>
	<td>Remote Area Delivery</td>
	<td><input type="checkbox" name="remote_edit" id="remote_edit" value="R" <? if($row['remote_area_delivery_price']!='' && $row['remote_area_delivery_price']!=0){?> checked="checked" <? } ?> onclick="openDeliveryTypeBox(this,'remote_area_place_holder');"></td>
	<td>Fixed time Delivery</td>
	<td><input type="checkbox" name="fixed_edit" id="fixed_edit" value="F" <? if($row['fixed_time_delivery_price']!='' && $row['fixed_time_delivery_price']!=0){?> checked="checked" <? } ?> onclick="openDeliveryTypeBox(this,'fixed_time_place_holder');"></td>
	</tr>
	</table>
</td>
</tr>
			<tr class="row2" > 
			<td width="30%" align="left" class="leftBarText" colspan="2" style="padding:0px; margin:0px;">
				<div id="mid_night_place_holder" style= " <?=($row['midnight_delivery_price']!='' && $row['midnight_delivery_price']> 0)?'display:block;':'display:none;'?>">
					<table width="100%" border="0"  cellpadding="5" cellspacing="0" class="tborder_new">
					<tr class="row2">
					<td width="30%" class="leftBarText" align="left">Mid Night Delivery Price<span class="style3">*</span></td>
					<td align="left" width="70%"><input name="mid_price_edit" id="mid_price_edit" type="text" class="forminputelement" value="<?=$row['midnight_delivery_price']?>"/></td>
					</tr>
					</table>
				</div>
			</td>
			</tr>
			<tr class="row1"> 
			<td width="30%" align="left" class="leftBarText" colspan="2" style="padding:0px; margin:0px;">
				<div id="remote_area_place_holder" style=" <?=($row['remote_area_delivery_price']!='' && $row['remote_area_delivery_price']>0)?'display:block;':'display:none;'?>">
					<table width="100%" border="0"  cellpadding="5" cellspacing="0" class="tborder_new">
					<tr class="row1">
					<td width="30%" align="left" class="leftBarText">Remote Area Delivery Price<span class="style3">*</span></td> 
					<td width="70%" align="left"><input name="remote_price_edit" id="remote_price_edit" type="text" class="forminputelement" value="<?=$row['remote_area_delivery_price']?>"/></td>
					</tr>
					</table>
				</div>
			</td>
			</tr> 
			<tr class="row2"> 
			<td width="30%" align="left" class="leftBarText" colspan="2" style="padding:0px; margin:0px;">
				<div id="fixed_time_place_holder" style=" <?=($row['fixed_time_delivery_price']!='' && $row['fixed_time_delivery_price']>0)?'display:block;':'display:none;'?>">
					<table width="100%" border="0"  cellpadding="5" cellspacing="0" class="tborder_new">
					<tr class="row2">
					<td width="30%" align="left" class="leftBarText">Fixed time Delivery Price<span class="style3">*</span></td> 
					<td width="70%" align="left"><input name="fixed_price_edit" id="fixed_price_edit" type="text" class="forminputelement" value="<?=$row['fixed_time_delivery_price']?>"/></td>
					</tr>
					</table>
				</div>
			</td>
			</tr>  

                <!-- <? if($row['id']!=2 && $row['id']!=11)
			  	 {
				  ?>
				  	<tr> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Change Link</span><span class="style_mand">*</span></td> 
                <td width="70%" colspan="4" align="left"><input name="link_edit" type="text" class="forminputelement" id="link_edit" value="<?=$row['link']?>"/></td>
              </tr> 
			<? } ?>	  -->
	
              <tr> 
			    <?
				if($_REQUEST['view']!='')
				{
				    $r1="view=".$_REQUEST['view'];
				}
				else
				{
				    $r1="src_ct=".$_REQUEST['src_ct']."&src_country=".$_REQUEST['src_country']."&src_state=".$_REQUEST['src_state'];
				}
				?>
                
                <td colspan="4" align="center"><input type="submit" name="Save" id="Save" value="Save" class="loginbttn"></td> 
              </tr> 
            </tbody> 
          </table> 
      </form>
	 <? }?>
	 <tr height="16">
		<td height="16" colspan="2" style="background:url(images/foot_bg.jpg) center top no-repeat;">&nbsp;</td>
		</tr>
	 </table> 
	 </td>
        </tr>
		
	<tr><td colspan="3" align="right"></td></tr>
  </table>