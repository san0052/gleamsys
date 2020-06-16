<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
//include('../includes/template.php');
$this_page='location.php';
//include_once('../includes/links_frontend.php');
if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}
if($_REQUEST['m']==3) { $msg='Record Deleted';}
if($_REQUEST['m']==9) { $msg='Content should not be blank';}
page_header($cfg['ADMIN_TITLE']." - Location Management");

$show=$_REQUEST['show'];
$pg =($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0';
?>


<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="scripts/common.js"></script>
<script language="javascript" src="scripts/ajax.js"></script>
<script language="javascript" src="scripts/ajax1.js"></script>
<script language="javascript" src="scripts/location.js"></script>

<style type="text/css">
<!--
.style3 {color: #FFFFFF}
-->
</style>



<td vAlign=top align="center" width="99%"><!-- Start Body Here -->
  <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
  
    <tr height="34">
      <td width="25%" rowspan="2" colspan="3" align="center" valign="top"><br /><br />
      <?php include_once("left_bar.php");?></td>
    </tr>
    <tr>
      <td align="center" valign="middle"><img src="images/spacer.gif" width="1" height="550" /></td>
      <td align="left" valign="top" width="99%">     
	  <table width="698" align="center" border="0" cellspacing="0" cellpadding="0">
	  <tr height="35" background="images/welcome_head.jpg">
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
	  <td colspan="2" align="left" valign="middle" style="background-color:#eee8e8;">&nbsp;</td>
	  </tr>
        <tr>
          <td colspan="2" style="background-color:#eee8e8;" align="center">
	  <? //show all record
	   if($_REQUEST['show']==''){
	  /* $returnCatId=($_REQUEST['catId']=="")?'0':$_REQUEST['catId'];*/
	   ?>
	   <form name="frm1" id="frm1">
	    <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="6" align="left">&nbsp;<span class="style2">Location  Section</span> </td>
              </tr>
          </thead>
          <tbody>

            <? if($_REQUEST['m']){ ?>
            <tr class="row1">
              <td colspan="8" align="right" class="redbuttonelements"><?=@$msg?></td>
            </tr>
			<? } ?>
			
            <tr class="headercontent">
				 <td width="7%" align="center" class="leftBarText_new1"><input name="check_all" id="check_all" class="check-all" type="checkbox" onclick="checkall();"/></td>
				 
              <td width="7%" align="center" class="leftBarText_new1">Sl No </td>
			  <td width="12%" align="center" class="leftBarText_new1">DB No </td>
              <td align="left" class="leftBarText_new1" colspan="3">Location</td>
              <td width="14%" align="center" class="leftBarText_new1">Status</td>
              <td width="center" align="center" class="leftBarText_new1">Action</td>
			  
            </tr>
		  
		<?  $sql="SELECT * FROM ".$cfg['DB_LOCATION']."";
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
			  <td align="center"><?=$i+$row['id']?></td>
              <td align="left" colspan="3" >&nbsp;<?=$row['name']?></td>
              <td align="center">
			
			 			  <a href="location_process.php?act=<?=($row['status']=='A')?'Inactive':'Active'?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['id']?>" class="<?=($row['status']=='A')?'greenbuttonelementsNew':'redbuttonelementsNew'?>"><?=($row['status']=='A')?'Active':'Inactive'?></a>
			
			  </td>
              <td align="center"><a href="location_process.php?act=edit&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['id']?>"><img src="images/edit.gif" title="Edit" width="16" height="16" border="0" /></a><a href="location_process.php?act=del&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['id']?>"><img src="images/drop.gif" title="Delete" width="16" height="16" border="0" onClick="return confirm('Do you really want to delete this record');" /></a></td>
            </tr>
			<? }
			}
			  else {?>
            <tr class="row1">
              <td colspan="8" align="center" class="msg">No Record.</td>
            </tr>  <? }

?>


		<tr >
		<td colspan="4" align="left" class="redbuttonelements">
				
				<select name="dropdown1" class="forminputelement">
					<option value="">Choose an action...	</option>
					<option value="delete">Delete</option>	
					<option value="Active">Active</option>
					<option value="Inactive">Inactive</option>							
				</select>
				<input value="Apply to selected"  name="submit" type="button" onclick="return validation_delete('<?=$pg?>');" class="loginbttn"/>
			
			</td>
                <td colspan="3" align="right" class="redbuttonelements"></td>
              </tr>

          </tbody>
        </table>
		
		<div class="bottomsecc">
			<div class="pagisecc">
				<?=$heart->paginate($maxrow, $limit, $pageno, "pageno", "link")?>
				<div class="clr"></div>
			</div>
			<div class="clr"></div>
			<a class="brownbttn" href="location.php?show=add&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>">Add New Location</a>
		</div>
		</form>
		<? }
		
		
	
		// show insert window
		
		
		
		/* Stary Brand */
		
		
	  if($show=='add') { ?>
	  <form name="frmadd" id="frm2" method="post" action="location_process.php"  onsubmit="return add_typ_value()">
          <p>
		    <input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>" />
            <input type="hidden" name="act" value="insert" />
			<input type="hidden" name="type_check" value=""  id="type_check"/>
          </p>
          <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="5" align="left" class="style2">&nbsp;Add  Location Section </td> 
              </tr> 
            </thead> 
            <tbody> 
              <? if($_REQUEST['m']){ ?>
              <tr class="row2">
                <td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
              </tr>
			  <? } ?>
              <tr class="row1"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Location</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left"><input name="cat_name" type="text" class="forminputelement" id="cat_name" onkeyup="category_availability(this.value,'<?=$this_page?>');" onblur="category_availability(this.value,'<?=$this_page?>');" />&nbsp;&nbsp;<span style="display:none;" id="exsists"><img src="images/cross_circle.png"  align="absmiddle" width="16"/>&nbsp;Already exists</span><span style="display:none;" id="notexsists"><img src="images/tick_circle.png" width="16" align="absmiddle" />&nbsp;Ok</span></div></td>
              </tr> 
              <tr> 
                <td colspan="2" align="center">
					<a class="brownbttn" href="location.php?pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>">&lt;&lt;back</a>
					<input type="submit" name="Save" id="Save" value="Save" class="loginbttn"> 
				</td> 
                
              </tr> 
            </tbody> 
          </table> 
      </form>
	  <? }
          if($show=='edit'){
            $sql="SELECT * FROM ". $cfg['DB_LOCATION']." WHERE  `id` =".$_REQUEST['id']."";
			$res=$heart->sql_query($sql);
			$row=$heart->sql_fetchrow($res);
	  ?>
	  <form name="frmedit"  id="frm3" method="post" action="location_process.php" onsubmit="return edit_typ_value()">
          <p>
            <input type="hidden" name="act" value="edit_category" />
			<input type="hidden" name="type_check_edit" value=""  id="type_check_edit"/>
			<input type="hidden" name="typeids" value="<?=$_REQUEST['id']?>" />
			<input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>" />
			<input name="category_or" type="hidden" style="border-color:#98C1B5; background-color:#98C1B5;" class="forminputelement" id="category_or" value="<?=$row['name']?>" readonly="readonly" />
          </p>
          <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="5" align="left" class="style2">&nbsp;Edit Location Section </td> 
              </tr> 
            </thead> 
            <tbody> 
              <? if($_REQUEST['m']){ ?>
              <tr class="row2">
                <td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
              </tr>
			  <? } ?>
			  
              <tr class="row1"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Change Location</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left"><input name="category_edit" type="text" class="forminputelement" id="category_edit" onkeyup="category_availability_edit(this.value,'<?=$this_page?>');" onblur="category_availability_edit(this.value,'<?=$this_page?>');" value="<?=stripslashes($row['name'])?>" />&nbsp;&nbsp;<span style="display:none;" id="exsists_edit"><img src="images/cross_circle.png"  align="absmiddle" width="16"/>&nbsp;Already exists</span><span style="display:none;" id="notexsists_edit"><img src="images/tick_circle.png" width="16" align="absmiddle" />&nbsp;Ok</span></div><span style="display:none;" id="same_edit"><img src="images/s_warn.gif"  align="absmiddle" width="16"/>&nbsp;You Entered Same Name !!</span></div></td>
              </tr> 
                 
	
              <tr> 
                <td colspan="2" align="center">
					<a class="brownbttn" href="location.php?pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>">&lt;&lt;back</a>
					<input type="submit" name="Save" id="Save" value="Save" class="loginbttn">
				</td> 
              </tr> 
            </tbody> 
          </table> 
      </form>
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
	<tr><td colspan="3" align="right"></td></tr>
  </table>

	  
	  
	  
	   