<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
//include('../includes/template.php');
$this_page='country.php';
//include_once('../includes/links_frontend.php');
if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}
if($_REQUEST['m']==3) { $msg='Record Deleted';}
if($_REQUEST['m']==9) { $msg='Content should not be blank';}
page_header($cfg['ADMIN_TITLE']." - Country Management");
$show=$_REQUEST['show'];
?>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />

<script language="javascript" src="js/ajax1.js"></script>
<script language="javascript" src="js/common2.js"></script>
<style type="text/css">
<!--
.style3 {color: #FFFFFF}
-->
</style>
<script>
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
		   var view='<?=($_REQUEST['view']!='')?$_REQUEST['view']:'all'?>';
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
		     var pageno1='<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>';
			 var js_cntry_id2='<?=$_REQUEST['cntry_id']?>';
		     window.location.href="country_process.php?act=del_category&cntry_id="+js_cntry_id2+"&pageno="+pageno1+"&id="+ar+"&view="+view;
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
			var js_cntry_id='<?=$_REQUEST['cntry_id']?>';
		    window.location.href="country_process.php?act=ActiveCat&cntry_id="+js_cntry_id+"&pageno="+pageno1+"&id="+ar+"&view="+view;
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
		     var js_cntry_id1='<?=$_REQUEST['cntry_id']?>';
		     window.location.href="country_process.php?act=InactiveCat&cntry_id="+js_cntry_id1+"&pageno="+pageno1+"&id="+ar+"&view="+view;
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

</script>
<td vAlign=top align="top" width="100%"><!-- Start Body Here -->
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
          <form name="frm1" id="frm1" action="country_process.php">
		  <input type="hidden" name="act" id="act" value="country_src" />
          <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
              <thead>
            <tr>
              <td colspan="7" align="left">&nbsp;<span class="style2">Country  Section</span></td>
              </tr>
          </thead>
              <tbody>
           
               <? if($_REQUEST['m']){ ?>
            <tr class="row1">
              <td colspan="7" align="right" class="redbuttonelements"><?=@$msg?></td>
            </tr>
			<? } ?>
              
              <tr class="row1">
                   <td colspan="6" align="left" class="leftBarText_new1"><span class="leftBarText_new">Country Name :&nbsp;</span> 
                      <input name="country_name" type="text" class="forminputelement" id="country_name"  value="<?=$_REQUEST['cntry_id']?>" />
				   </td>
                   <td align="center" class="leftBarText_new1">
				      <input  name="searchcountry" type="submit" value="search" class="loginbttn"/>
				   </td>
              </tr>
              <tr class="headercontent">
                  <td width="5%" align="center" class="leftBarText_new1">
				  	<input name="check_all" id="check_all" class="check-all" type="checkbox" onClick="checkall();"/>
				  </td>
                  <td width="10%" align="center" class="leftBarText_new1">Sl No </td>
                  <td align="left" class="leftBarText_new1" colspan="4">Country</td>
                  <td width="20%" align="center" class="leftBarText_new1">Action</td>
                </tr>
                <?
			
			      $sql="SELECT * FROM ".$cfg['DB_COUNTRY_MASTER']." WHERE `status`<>'D' ORDER BY `country_name` ASC";
			      if($_REQUEST['cntry_id']!='')
			      {
				     $sql="SELECT * FROM ".$cfg['DB_COUNTRY_MASTER']." WHERE `status`<>'D' AND `country_name` LIKE '".$_REQUEST['cntry_id']."%' ORDER BY `country_name` ASC";
			      }
			      $res=$heart->sql_query($sql);
			      $maxrow=$heart->sql_numrows($res);
			      $sql = $sql. " LIMIT $offset,$limit";
			      $res = $heart->sql_query($sql);
			      if($maxrow >0){
			      while($row=$heart->sql_fetchrow($res)){
			      @$i++;
	           ?>
              <tr class="<?=($i%2==0)?'row1':'row2'?>">
                  <td align="center">
                     <input  name="checkvalue" id="checkvalue"  value="<?=$row['country_id']?>" type="checkbox" />                
                  </td>
                  <td align="center"><?=$i+$offset?></td>
                  <td align="left" colspan="4" >&nbsp;<?=$row['country_name']?></td>		
                  <td align="center">
				    <a href="country.php?show=edit_category&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['country_id']?>&cntry_id=<?=$_REQUEST['cntry_id']?>&view=<?=$_REQUEST['view']?>"><img src="images/edit.gif" title="Edit" width="16" height="16" border="0" /></a>
				  
				    <a href="country_process.php?act=del_category&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['country_id']?>&cntry_id=<?=$_REQUEST['cntry_id']?>&view=<?=$_REQUEST['view']?>"><img src="images/drop.gif" title="Delete" width="16" height="16" border="0" onClick="return confirm('Do you really want to delete this record');" /></a>
                  </td>
              </tr>
        <? 
			    }
			}
			else 
			{
		?>
              <tr class="row1">
                  <td colspan="7" align="center" class="msg">No Record.</td>
                </tr>
        <? 
		    }

        ?>
            <?php /*?><div style="width:90%; text-align:right;">
              <?=$heart->paginate($maxrow, $limit, $pageno, "pageno", "link")?>
            </div>
			<?php */?>
			 <tr >
              <td colspan="7" align="left"><? if($maxrow >0){ ?>
                  <select name="dropdown1" class="forminputelement">
                    <option value="">Choose an action... </option>
                    <option value="delete">Delete</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                  </select>
                  <input value="Apply to selected"  name="submit" type="button" onClick="return validation_delete();" class="loginbttn"/>
                  <? } ?>                
              </td>
              
            </tr>
      </tbody>
            </table>
			<div class="bottomsecc">
				<div class="pagisecc">
					<?=$heart->paginate($maxrow, $limit, $pageno, "pageno", "link")?>
					<div class="clr"></div>
				</div>
				<div class="clr"></div>	
				<a class="brownbttn" href="country.php?show=add_category&cntry_id=<?=$_REQUEST['cntry_id']?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&view=<?=$_REQUEST['view']?>">Add New Country 
					</a>
			</div>
        </form>
          <? }
		// show insert window		
		/* Stary Brand */		
		
	  if($show=='add_category') { ?>
	  <form name="frmtypeadd" method="post" action="country_process.php" id="frmtypeadd" onSubmit="return add_country_val()">
          <p>
		  	 <input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>" />
            <input type="hidden" name="act" value="insert_category" />
			<input type="hidden" name="type_check" value="insert"  id="type_check"/>
			<input type="hidden" name="view" value="<?=$_REQUEST['view']?>" />
			
          </p>
          <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="5" align="left" class="style2">Add Country Section </td> 
              </tr> 
            </thead> 
            <tbody>
			<? if($_REQUEST['m']){ ?>
              <tr class="row2">
                <td colspan="7" align="left" class="redbuttonelements"><?=@$msg?></td>
              </tr>
			  <? } ?> 
              <tr class="row1">
                <td colspan="7" align="left">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                   <tr>
                    <td align="left" class="breadCrumbs">
                      <a href="admin.php">Home</a> &raquo; <a href="<?=$_SERVER['PHP_SELF']?>?pageno=<?=$_REQUEST['pageno']?>">Country</a></td>
                    </tr>
                  </table>
                </td>
              </tr>
			  
              <tr class="row2"> 
                <td width="30%" align="left" class="leftBarText" >Country<span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				<input name="category" type="text" class="forminputelement" id="category" onKeyUp="country_availability();" onBlur="country_availability();" />
				&nbsp;&nbsp;
				<span style="display:none;" id="exsists"><img src="images/cross_circle.png"  align="absmiddle" width="16"/>&nbsp;Already exists</span>
				<span style="display:none;" id="notexsists"><img src="images/tick_circle.png" width="16" align="absmiddle" />&nbsp;Available</span></div></td>
              </tr>  
			  <tr class="row1"> 
                <td width="30%" align="left" class="leftBarText">Country Abbreviation<span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				<input name="abb" type="text" class="forminputelement" id="abb"  /></td>
              </tr> 
               
              <tr>
                <td colspan="2" align="center"><input type="submit" name="Save" id="Save" value="Save" class="loginbttn">&nbsp;</td> 
              </tr> 
            </tbody> 
          </table> 
      </form>
	  <? }
	  
	  /* end brand */

		
	  // show edit window
	  if($show=='edit_category'){
	
	  
	  $sql="SELECT * FROM ".$cfg['DB_COUNTRY_MASTER']." WHERE  `country_id` =".$_REQUEST['id']."";
			$res=$heart->sql_query($sql);
			$row=$heart->sql_fetchrow($res);
	  ?>
	  <form name="frmtypeedit" method="post" action="country_process.php" id="frmtypeedit" onSubmit="return edit_country_val();">
          <p>
		  
		  	 
            <input type="hidden" name="act" value="edit_category" />
			<input type="hidden" name="type_check_edit" value="insert"  id="type_check_edit"/>
			<input type="hidden" name="countryid" value="<?=$_REQUEST['id']?>"/>
			<input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>"/>
			<input type="hidden" name="view" value="<?=$_REQUEST['view']?>" />
			<input type="hidden" name="cntry_id" value="<?=$_REQUEST['cntry_id']?>" />
            <input name="category_or" type="hidden" id="category_or" value="<?=$row['country_name']?>"  />
          </p>
          <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="7" align="left" class="style2">Edit Country Section </td> 
              </tr> 
            </thead> 
            <tbody> 
            <tr class="row2">
                <td colspan="5" align="left">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                   <tr class="row2">
                    <td align="left" class="breadCrumbs">
                      <a href="admin.php">Home</a> &raquo; <a href="<?=$_SERVER['PHP_SELF']?>?pageno=<?=$_REQUEST['pageno']?>">Country</a></td>
                    </tr>
                  </table>
                </td>
            </tr>
            <tr  class="row1"> 
                <td width="30%" align="left" class="leftBarText">Change Country <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				<input name="category_edit" type="text" class="forminputelement" id="category_edit" 
                   onBlur="country_availability_edit();" onkeyup="country_availability_edit();" value="<?=$row['country_name']?>" />                 &nbsp;&nbsp;
				<span style="display:none;" id="exsists_edit"><img src="images/cross_circle.png"  align="absmiddle" width="16"/>&nbsp;Already exists</span>
				<span style="display:none;" id="notexsists_edit"><img src="images/tick_circle.png" width="16" align="absmiddle" />&nbsp;Available</span></div>
				<span style="display:none;" id="same_edit"><img src="images/s_warn.gif"  align="absmiddle" width="16"/>&nbsp;You Entered Same Name !!</span></div></td>
              </tr> 
              <tr> 
                <td colspan="2"align="center">
					<input type="submit" name="Save" id="Save" value="Save" class="loginbttn">
				</td> 
                
              </tr> 
            </tbody> 
          </table> 
      </form>
	 <?  }?>
	 <tr height="16">
		<td height="16" colspan="2" style="background:url(images/foot_bg.jpg) center top no-repeat;">&nbsp;</td>
		</tr>
	 </table> 
	   </td>
        </tr>
		
	<tr><td colspan="3" align="right"></td></tr>
  </table>	  
	  