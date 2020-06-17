<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');

if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}
if($_REQUEST['m']==3) { $msg='Record Deleted';}
if($_REQUEST['m']==6) { $msg='Record Showing in Ascending Order';}
if($_REQUEST['m']==7) { $msg='Record Showing in Descending Order';}
if($_REQUEST['m']==9) { $msg='Content should not be blank';}

page_header($cfg['ADMIN_TITLE']." - Home Counter");

$show=$_REQUEST['show'];
$pg =($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0';

?>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="scripts/notes.js"></script>
<script language="javascript" src="scripts/ckeditor/ckeditor.js"></script> 
<style type="text/css">

.style3 {color: #FFFFFF}

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
	  
	  </tr>
	  <tr height="16">
	  <td colspan="2" align="left" valign="middle" style="background-color:#eee8e8;">&nbsp;</td>
	  </tr>
        <tr>
          <td colspan="2" style="background-color:#eee8e8;" align="center">
		  
	  <? //show all record
	   if($_REQUEST['show']=='')
	   {
	 
	   ?>
	  	 <form name="frm1" id="frm1" action="service-process.php" method="post">
		 	<input type="hidden" name="act" id="act" value="order" /> 
		 	<? $pageno=($_REQUEST['pageno']!='')?$_REQUEST['pageno']:'0'; ?>
			 <input type="hidden" name="pageno" id="pageno" value="<?=$pageno?>" />
			
	    <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="11" align="left">&nbsp;<span class="style2">Manage IT Service Section</span> </td>
            </tr>
          </thead>
          <tbody>
            <?php if($_REQUEST['m']){ ?>
            <tr class="row1">
              <td colspan="17" align="right" class="redbuttonelements"><?=@$msg?></td>
            </tr>
			<? } ?>			
            <tr class="headercontent">
				 <td width="6%" align="center" class="leftBarText_new1"><input name="check_all" id="check_all" class="check-all" type="checkbox" onclick="checkall();"/></td>
          	     <td width="6%" align="center" class="leftBarText_new1">Sl No </td>
				 <!-- <td width="6%" align="center" class="leftBarText_new1">Db No </td> -->
				 <td width="17%" align="center" colspan="3" class="leftBarText_new1">Computer Details</td>
	             <td width="23%" align="center" colspan="3" class="leftBarText_new1">Description</td>
	             <td width="17%" align="center" colspan="3" class="leftBarText_new1">Image</td>
	             <td width="17%" align="center" colspan="3" class="leftBarText_new1">Image Alt Tag</td>
				 <td width="13%" align="center" class="leftBarText_new1">Status</td> 
				 <td width="15%" align="center" class="leftBarText_new1">Action</td>
            </tr>		  
			
		<?php

		 	$sql    = "SELECT * FROM ".$cfg['DB_COMPUTER_TRAIN']." WHERE 
						`siteId`= '".$cfg['SESSION_SITE']."' 
						AND `status` != 'D'
						"; 
			$res    = $heart->sql_query($sql);
			$maxrow = $heart->sql_numrows($res);
				
			 if($maxrow >0)
			 {
			 	while($row=$heart->sql_fetchrow($res))
				{
					 @$i++;
		?>
            <tr class="<?=($i%2==0)?'row1':'row2'?>">
			
				<td align="center"><input  name="checkvalue" id="checkvalue"  value="<?=$row['id']?>" type="checkbox" />	</td>
			
              	<td align="center"><?=$i+$offset?></td>
              	<td align="center" colspan="3" >&nbsp;<?=$row['serviceOption'];?></td>
				<td align="center" colspan="3" >&nbsp;<?=$row['serviceDescription'];?></td>
				<td align="center" colspan="3" >&nbsp;
					<?php if($row['computerImg']){?>
					<img src="../images/<?=$row['computerImg']?>"  width="70" align="top"/>
				<?php }else{ ?>
					Image Not Available
				<?php }?>
				</td>
				<td align="center" colspan="3" >&nbsp;
					<?php if($row['altTag']){ ?>
						<?=$row['altTag'];?>
					<?php }else{ ?>
						Not Available Alt Tag
					<?php }?>
					</td>	
				<td align="center">
				  <a href="service-process.php?act=<?=($row['status']=='A')?'InactiveTraining':'ActiveTraining'?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['id']?>" class="<?=($row['status']=='A')?'greenbuttonelementsNew':'redbuttonelementsNew'?>"><?=($row['status']=='A')?'Active':'Inactive'?></a>
				  
				  </td>
				  <td align="center">
				  
					  <a href="service-process.php?act=editComputerService&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['id']?>"><img src="images/edit.gif" title="Edit" width="16" height="16" border="0" /></a>
				  
					  <!-- <a href="service-process.php?act=del&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['id']?>"><img src="images/drop.gif" title="Delete" width="16" height="16" border="0" onClick="return confirm('Do you really want to delete this record ?');" /></a> -->
				  
				  </td>
			  
            </tr>
			<? }
			}
			else {?>
            <tr class="row1">
              <td colspan="17" align="center" class="msg">No Record.</td>
            </tr>  <? }?>
		
          </tbody>
        </table>
		<!--  <div class="bottomsecc">		
			<a class="brownbttn" href="service-process.php?act=addIt&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>">Add IT-service Info</a>
		</div>  --> 
		
		<tr height="16">
			<td height="16" colspan="2" style="background:url(images/foot_bg.jpg) center top no-repeat;">&nbsp;</td>
		</tr>  
			<tr><td colspan="3" align="right"></td></tr>
		</form>
		<? }
		
		// show individual records
	if($show=='addIT-service') 
	{ 
		
	?>
		<form name="frmadd" id="frm2" method="post" action="service-process.php" onsubmit="return add_typ_value()" ><p>
		    <input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>" />
            <input type="hidden" name="act" value="insertIt-info" />
			</p>
          <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="5" align="left" class="style2">&nbsp;Add IT-Service Info</td> 
              </tr> 
            </thead> 
            <tbody> 
              <? if($_REQUEST['m']){ ?>
              <tr class="row2">
                <td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
             </tr>
			  <? } ?>
			
			<tr class="row1"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Service Title</span></td> 
                <td width="70%" colspan="4" align="left"><input type="text" name="serviceTitle" id="serviceTitle" style="width: 83%;">
                </td>
			</tr>	
			
			<tr class="row2"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Description</span></td> 
                 <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
			</tr>
				
			<tr class="row1">
                <td colspan="2" align="center">
					<textarea name="serviceDescription" id="serviceDescription" class="forminputelement textareawid" rows="4"></textarea>	
				</td>
            </tr>

            <tr class="row1"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Subject Name</span></td> 
                <td width="70%" colspan="4" align="left"><input type="text" name="subjectName" id="subjectName" style="width: 83%;">
                </td>
			</tr>
			      
              <tr> 
                <td align="center" colspan="2">
					<a class="brownbttn" href="tech-service.php?pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>">&lt;&lt;back</a>
					<input type="submit" name="Save" id="Save" value="Save" class="loginbttn">
				</td> 
                
              </tr>
			   
            </tbody> 
          </table> 
      </form>
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
	
	  <? }
	  
	// show edit window
	  
	  
	  
	    if($show=='editComputer')
		{
			$sql="SELECT * FROM ". $cfg['DB_COMPUTER_TRAIN'] ." 
			 		where `id`=".$_REQUEST['id']." "; 
			$res=$heart->sql_query($sql);
			$row=$heart->sql_fetchrow($res);
	  ?>
	  <form name="frmedit"  id="frm3" method="post" action="service-process.php" onsubmit="return edit_typ_value()" enctype="multipart/form-data">
          <p>
            <input type="hidden" name="act" value="updateComputerService" />            
            <input type="hidden" name="id" value="<?=$row['id']?>" />
			<input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>" />
			<input name="title" type="hidden"  id="category_or" value="<?=$row['title']?>" />
          </p>
          <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="5" align="left" class="style2">&nbsp;Edit  Section </td> 
              </tr> 
            </thead> 
            <tbody> 
              <? if($_REQUEST['m']){ ?>
              <tr class="row2">
                <td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
              </tr>
			  <? } ?>
              <tr class="row1"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Computer Details</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				<input type="text" class="forminputelement" name="serviceOption" id="serviceOption" value="<?=stripslashes($row['serviceOption'])?>"/>
				&nbsp;&nbsp;</td>
			 </tr> 
				<tr class="row2"> 
	                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Description</span><span class="redstar">*</span></td> 
	                <td  width="70%" colspan="4" class="leftBarText" align="left" valign="top">
	                	<textarea name="serviceDescription" id="serviceDescription" rows="4" style="width:94%;height:auto;"><?php echo $row['serviceDescription'];?></textarea>
	                	<script>
                   			 CKEDITOR.replace( 'serviceDescription' );
                		</script>
	                </td>
		  		</tr>

		  		<tr class="row1"> 
	                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Image</span> <span class="redstar">*</span></td> 
	                <td width="70%" colspan="4" align="left">
						<input type="file" class="forminputelement" name="image" id="image"/>
					&nbsp;&nbsp;<img src="../images/<?=$row['computerImg']?>"  width="70" align="top" />
				</td>
			 </tr>

		  		<tr class="row1"> 
	                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Alt Tag</span> <span class="redstar">*</span></td> 
	                <td width="70%" colspan="4" align="left">
						<input type="text" class="forminputelement" name="altTag" id="altTag" value="<?=stripslashes($row['altTag'])?>"/>
					&nbsp;&nbsp;</td>
			 </tr>
		 		
		   <td align="center" colspan="2">
				<a class="brownbttn" href="computer-training.php?pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>">&lt;&lt;back</a>
				<input type="submit" name="Save" id="Save" value="Save" class="loginbttn">
		   </td> 
		  
        </tbody> 
      </table> 
      </form>
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
	  
	 <?
	  }
	?>	  </td>
        </tr>
		
		<tr height="16">
			<td height="16" colspan="2" style="background:url(../heart2heart/webmaster/images/foot_bg.jpg) center top no-repeat;">&nbsp;</td>
		</tr>
      </table> 
      </td>   
	  
    </tr>
	<tr><td colspan="3" align="right"></td></tr>
  </table>	  
  
  <?
	//session_unregister('title');
	unset($_SESSION['title']);
?>
	   