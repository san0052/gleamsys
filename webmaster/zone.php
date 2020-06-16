<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
//include('../includes/template.php');
$this_page='zone.php';
//include_once('../includes/links_frontend.php');
if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}
if($_REQUEST['m']==3) { $msg='Record Deleted';}
if($_REQUEST['m']==9) { $msg='Content should not be blank';}
//if($cfg['SESSION_SITE']==5)
//	{
//		$cfg['SESSION_SITE'] =5;
//		$_SESSION['title']=$cfg['TITLE5'];
//	}
page_header($cfg['ADMIN_TITLE']." - Zone Management");

$show=$_REQUEST['show'];
$pg =($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0';
?>
<script>
function getSes1(site){
window.location.href="admin.php?act=ses&site="+site;	
}
</script>
<?
	if($_REQUEST['act']=='ses')
	{ 
		session_register('site');
		$cfg['SESSION_SITE']=$_REQUEST['site'];
		$heart->redirect('admin.php');
	}
?>


<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="scripts/common.js"></script>
<script language="javascript" src="scripts/ajax.js"></script>
<script language="javascript" src="scripts/ajax1.js"></script>
<script language="javascript" src="scripts/city.js"></script>

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
	  <table width="698" align="center" border="0" cellspacing="0" cellpadding="0" style="background:url(images/welcome_head.jpg) center top no-repeat;">
	  <tr height="35">
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
              <td colspan="6" align="left">&nbsp;<span class="style2">Zone  Section</span> </td>
              </tr>
          </thead>
          <tbody>

            <? if($_REQUEST['m']){ ?>
            <tr class="row1">
              <td colspan="6" align="right" class="redbuttonelements"><?=@$msg?></td>
            </tr>
			<? } ?>
			
            <tr class="headercontent">
				 <td width="7%" align="center" class="leftBarText_new1"><input name="check_all" id="check_all" class="check-all" type="checkbox" onclick="checkall();"/></td>
              <td width="7%" align="center" class="leftBarText_new1">Sl No </td>
			  <td width="12%" align="center" class="leftBarText_new1">DB No </td>
              <td align="left" class="leftBarText_new1">Zone Name</td>
              <td width="14%" align="center" class="leftBarText_new1">Status</td>
              <td width="center" align="center" class="leftBarText_new1">Action</td>
			  
            </tr>
		  
		<?  $sql="SELECT * FROM ".$cfg['DB_CITY']." WHERE `parent_id`='0' ";
			 $res=$heart->sql_query($sql);
			 $maxrow=$heart->sql_numrows($res);
			//  $sql = $sql. " LIMIT $offset,$limit";
			// $res = $heart->sql_query($sql);
			 if($maxrow >0){
			 
			//  '55';
			// $row=$heart->sql_fetchrow($res1);
		//	 $row['id'];
			 while($row=$heart->sql_fetchrow($res)){
			 // $row['id'];
			 
		 @$i++;
			?>
            <tr class="<?=($i%2==0)?'row1':'row2'?>">
			<td align="center"><input  name="checkvalue" id="checkvalue"  value="<?=$row['id']?>" type="checkbox" /></td>
			
              <td align="center"><?=$i+$offset?></td>
			  <td align="center"><?=$row['id']?></td>
              <td align="left">&nbsp;<?=$row['name']?></td>
              <td align="center">
			
			 			  <a href="zone_process.php?act=<?=($row['status']=='A')?'Inactive':'Active'?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['id']?>" class="<?=($row['status']=='A')?'greenbuttonelementsNew':'redbuttonelementsNew'?>"><?=($row['status']=='A')?'Active':'Inactive'?></a>
			
			  </td>
              <td align="center"><a href="zone.php?show=view&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['id']?>"><img src="images/view.gif" title="View" width="16" height="16" border="0" /></a><a href="zone.php?show=edit&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['id']?>"><img src="images/edit.gif" title="Edit" width="16" height="16" border="0" /></a><a href="zone_process.php?act=del&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['id']?>"><img src="images/drop.gif" title="Delete" width="16" height="16" border="0" onClick="return confirm('Do you really want to delete this record');" /></a></td>
            </tr>
			<? }
			}
			  else {?>
            <tr class="row1">
              <td colspan="6" align="center" class="msg">No Record.</td>
            </tr>  <? }

?>


		<tr>
		<td colspan="4" align="left" class="redbuttonelements">
				
				<select name="dropdown1" class="forminputelement">
					<option value="">Choose an action...	</option>
					<option value="delete">Delete</option>	
					<option value="Active">Active</option>
					<option value="Inactive">Inactive</option>							
				</select>
				<input value="Apply to selected"  name="submit" type="button" onclick="return validation_delete('<?=$pg?>');" class="loginbttn"/>
			
			</td>
                <td colspan="2" align="right" class="redbuttonelements"></td>
              </tr>

          </tbody>
        </table>
		<div class="bottomsecc">
		<?=$heart->paginate($maxrow, $limit, $pageno, "pageno", "link")?>
		<a class="brownbttn" href="zone.php?show=add&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>">Add New Zone</a>
		</div>
		</form>
		<? }
		
		
	
		// show insert window
		
		
		
		/* Stary Brand */
		
		
	  if($show=='add') { ?>
	  <form name="frmadd" id="frm2" method="post" action="zone_process.php"  onsubmit="return add_typ_value()">
          <p>
		    <input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>" />
            <input type="hidden" name="act" value="insert" />
			<input type="hidden" name="type_check" value=""  id="type_check"/>
          </p>
          <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="3" align="left" class="style2">&nbsp;Add  Zone Section </td> 
              </tr> 
            </thead> 
            <tbody> 
              <? if($_REQUEST['m']){ ?>
              <tr class="row2">
                <td colspan="3" align="left" class="redbuttonelements"><?=@$msg?></td>
              </tr>
			  <? } ?>
              <tr> 
                <td width="30%" align="left" class="row1"><span class="leftBarText_new">Zone Name</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="2" align="left" class="row2"><input name="zone" type="text" class="forminputelement" id="zonse"/></td>
              </tr>
			  
			  <tr class="row1">
			    <td colspan="3" align="left" valign="top"><span class="leftBarText_new">Zone List</span> <span class="redstar">*</span></td>
			    </tr>
			  <tr class="row2">
				<?
				$n = 0;
                $sqlloc="SELECT * FROM ".$cfg['DB_LOCATION']." WHERE `status`='A' ORDER BY `name` ASC";
                $resloc=$heart->sql_query($sqlloc);
                while($rowloc=$heart->sql_fetchrow($resloc)){
				$n++;
				?>
                <td width="33%" align="left" valign="top">
                <input type="checkbox" name="prod_loc[]"  id="prod_loc" value="<?=$rowloc['id']?>"  />
                <?=stripslashes($rowloc['name'])?>
                </td>
                <? if($n%3==0){echo '</tr><tr class="row2">';}
				} ?>
			  </tr> 
               
              <tr> 
                <td align="center" colspan="3">
					<a class="brownbttn" href="zone.php?pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>">&lt;&lt;back</a>
					<input type="submit" name="Save" id="Save" value="Save" class="loginbttn">
				</td> 
              </tr> 
            </tbody> 
          </table> 
      </form>
	  
	    <tr height="16">
			<td height="16" colspan="2" style="background:url(images/foot_bg.jpg) center top no-repeat;">&nbsp;</td>
		</tr>
	  
	  
	  
	  <? }
          if($show=='edit'){
             $sql="SELECT * FROM ". $cfg['DB_CITY']." WHERE  `id` =".$_REQUEST['id']."";
			$res=$heart->sql_query($sql);
			$row=$heart->sql_fetchrow($res);
			 $loc = explode(',',$row['city_id']);
			// print_r($loc);
	  ?>
	  <form name="frmedit"  id="frm3" method="post" action="zone_process.php" onsubmit="return edit_typ_value()">
          <p>
            <input type="hidden" name="act" value="update" />
			<input type="hidden" name="type_check_edit" value=""  id="type_check_edit"/>
			<input type="hidden" name="typeids" value="<?=$_REQUEST['id']?>" />
			<input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>" />
			<input name="category_or" type="hidden" style=" border-color:#98C1B5; background-color:#98C1B5;" class="forminputelement" id="category_or" value="<?=$row['name']?>" readonly="readonly" />
          </p>
          <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="3" align="left" class="style2">&nbsp;Edit Zone Section </td> 
              </tr> 
            </thead> 
            <tbody> 
              <? if($_REQUEST['m']){ ?>
              <tr class="row2">
                <td colspan="3" align="left" class="redbuttonelements"><?=@$msg?></td>
              </tr>
			  <? } ?>
			  <tr> 
                <td width="30%" align="left" class="row1"><span class="leftBarText_new">Change Zone</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="2" align="left" class="row2"><input name="zone" type="text" class="forminputelement" id="zone" value="<?=$row['name']?>"/></td>
              </tr>
			  
			  <tr class="row1">
			    <td colspan="3" align="left" valign="top"><span class="leftBarText_new">Zone List</span> <span class="redstar">*</span></td>
			    </tr>           
            
			  
			  
			    <tr class="row2">  
				         
						<?
						$n=0;
						$sqlloc="SELECT * FROM ".$cfg['DB_LOCATION']." WHERE `status`='A' ORDER BY `name` ASC";
						$resloc=$heart->sql_query($sqlloc);
						while($rowloc=$heart->sql_fetchrow($resloc))
						{  $n++;?>
						<td width="33%" align="left" valign="top">
						<input type="checkbox" name="prod_loc[]" id="prod_loc" value="<?=$rowloc['id']?>"  <? if(in_array($rowloc['id'],$loc)){?> checked="checked"<? } ?>/><?=stripslashes($rowloc['name'])?><br />
						</td><? if($n%3==0){echo '</tr><tr class="row2">';}
						} ?>
                          
                   
              </tr> 
                 
	
              <tr> 
                <td align="center" colspan="3">
					<a class="brownbttn" href="zone.php?pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>">&lt;&lt;back</a>
					<input type="submit" name="Save" id="Save" value="Save" class="loginbttn"> 
				</td> 
                
              </tr> 
            </tbody> 
          </table> 
		  
		  
      </form>
	  
	  
	    <tr height="16">
			<td height="16" colspan="2" style="background:url(images/foot_bg.jpg) center top no-repeat;">&nbsp;</td>
		</tr>
	 <? }	  	
			  if($show=='view')
			{
				//die('555');
				$sql="SELECT * FROM " .$cfg['DB_CITY']. "WHERE `id`=".$_REQUEST['id']."";
				$res=$heart->sql_query($sql);
				$row=$heart->sql_fetchrow($res)
			 ?>
			<form name="frmadd" id="frm5" method="post"  ><p>
		    	<input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>" />
	            <input type="hidden" name="act" value="view" />
				<!--<input type="hidden" name="type_check" value=""  id="type_check"/>--></p>
				
          <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="5" align="left" class="style2">&nbsp;Details of Zone </td> 
				<td colspan="5" align="right" class="style2">
			<a style="text-decoration:none; color:#FFFFFF;" href="zone.php?show=edit&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['id']?>"><strong>[Edit]</strong></a></td>
              </tr> 
            </thead> 
            <tbody>
			  
			  <tr class="row2"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Zone Name</span></td>
                <td width="70%" colspan="9" align="left"><?=stripslashes($row['name'])?></td>
			</tr>
			<tr class="row1"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Zone List</span></td>
                <td width="70%" colspan="9" align="left"><?=getlocationname($row['city_id'])?></td>
			</tr>
			
			<tr>
				<td colspan="6" align="center" style="padding-top:10px; padding-bottom:10px;"><a class="brownbttn" href="zone.php?pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>">&lt;&lt;back</a></td >
			</tr>
			
			
		 
          </tbody> 
          </table>
		  
		  
		  <tr height="16">
			<td height="16" colspan="2" style="background:url(images/foot_bg.jpg) center top no-repeat;">&nbsp;</td>
		</tr>
     
	  
   
	<tr><td colspan="3" align="right"></td></tr>
 
		  
		   
      </form>
	  <? }	?>
			  
			  
	<!--		  
			  
			  	
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
-->
	  
	  
	  
	   