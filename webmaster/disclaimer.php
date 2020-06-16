<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
//include('../includes/template.php');
//$this_page='spe_category.php';
//include_once('../includes/links_frontend.php');
$msg='';
if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}
if($_REQUEST['m']==3) { $msg='Record Deleted';}
if($_REQUEST['m']==6) { $msg='Record Showing in Ascending Order';}
if($_REQUEST['m']==7) { $msg='Record Showing in Descending Order';}
//if($_REQUEST['m']==4) { $msg='Order Updated';}
//if($_REQUEST['m']==5) { $msg='Record Details';}
if($_REQUEST['m']==9) { $msg='Content should not be blank';}

page_header($cfg['ADMIN_TITLE']." - Disclaimer Management");

// $parentId=($_REQUEST['pId']=="")?'0':$_REQUEST['pId'];
$show=$_REQUEST['show'];
$pg =($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0';
?>


<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="scripts/ckeditor.js"></script>
<!--<script language="javascript" src="scripts/common.js"></script>-->

<!--<script language="javascript" src="scripts/ajax.js"></script>
<script language="javascript" src="scripts/ajax1.js"></script>-->
<script language="javascript" src="scripts/disclaimer_notes.js"></script>

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
	  <?php /*?><!--<td width="658" align="left" valign="middle">&nbsp;&nbsp;<span class="style1">Welcome <?=$_SESSION['admin_user_name']?></span></td>
	  <td  width="56"align="right" valign="middle"><a href="login.php?act=<?=md5("logout")?>"><img src="images/lock.png" title="Logout" width="24" height="24" border="0" /></a>&nbsp;&nbsp;&nbsp;&nbsp;</td>--><?php */?>
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
	  	 <form name="frm1" id="frm1" action="disclaimer_process.php" method="post">
		 	<input type="hidden" name="act" id="act" value="order" /> 
		 	<? $pageno=($_REQUEST['pageno']!='')?$_REQUEST['pageno']:'0'; ?>
			 <input type="hidden" name="pageno" id="pageno" value="<?=$pageno?>" />
			 
		 	
			
	    <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="11" align="left">&nbsp;<span class="style2">Disclaimer List</span> </td>
            </tr>
          </thead>
          <tbody>
            <? if($_REQUEST['m']){ ?>
            <tr class="row1">
              <td colspan="11" align="right" class="redbuttonelements"><?=@$msg?></td>
            </tr>
			<? } ?>			
            <tr class="headercontent">
				 <td width="6%" align="center" class="leftBarText_new1"><input name="check_all" id="check_all" class="check-all" type="checkbox" onclick="checkall();"/></td>
          	     <td width="6%" align="center" class="leftBarText_new1">Sl No </td>
				 <td width="6%" align="center" class="leftBarText_new1">Db Id </td>
				 
            	 <td width="17%" align="center"  colspan="3" class="leftBarText_new1">Title</td>
			   
	             <td width="23%" align="center"   colspan="3" class="leftBarText_new1">Date</td>
				 
				 <td width="13%" align="center" class="leftBarText_new1">Status</td> 
			 
				 <td width="15%" align="center" class="leftBarText_new1">Action</td>
            </tr>		  
			
		<?
			$sql="SELECT * FROM ".$cfg['DB_DISCLAIMER']." Where `siteId`= '".$cfg['SESSION_SITE']."' ";
			$res=$heart->sql_query($sql);
			$maxrow=$heart->sql_numrows($res);
				
			 if($maxrow >0)
			 {
			 	while($row=$heart->sql_fetchrow($res))
				{
					 @$i++;
		?>
            <tr class="<?=($i%2==0)?'row1':'row2'?>">
			
				<td align="center"><input  name="checkvalue" id="checkvalue"  value="<?=$row['d_id']?>" type="checkbox" />	</td>
			
              	<td align="center"><?=$i+$offset?></td>
				<td align="center"><?=$row['d_id']?></td>
			  
              	<td align="center" colspan="3" >&nbsp;<?=$row['title']?></td>
				<td align="center" colspan="3" >&nbsp;<?=getdataformat($row['d_date'])?></td>		 	  
			  
              	<td align="center">
			  
				  <a href="disclaimer_process.php?act=<?=($row['status']=='A')?'Inactive':'Active'?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['d_id']?>" class="<?=($row['status']=='A')?'greenbuttonelementsNew':'redbuttonelementsNew'?>"><?=($row['status']=='A')?'Active':'Inactive'?></a>
				  
				  </td>
			  
			  <td align="center">
			  	  <a href="disclaimer.php?show=view&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['d_id']?>"><img src="images/view.gif" title="View" width="16" height="16" border="0" /></a>
			  
				  <a href="disclaimer_process.php?act=edit&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['d_id']?>"><img src="images/edit.gif" title="Edit" width="16" height="16" border="0" /></a>
			  
				  <a href="disclaimer_process.php?act=del&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['d_id']?>"><img src="images/drop.gif" title="Delete" width="16" height="16" border="0" onClick="return confirm('Do you really want to delete this record ?');" /></a>
			  
			  </td>
			  
            </tr>
			<? }
			
			
			
			}
			else {?>
            <tr class="row1">
              <td colspan="11" align="center" class="msg">No Record.</td>
            </tr>  <? }?>

		<tr >
			<td colspan="7" align="left" class="redbuttonelements">
				
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
			<a class="brownbttn" href="disclaimer.php?show=add&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>">Add New Disclaimer</a>
		</div>
		
		<tr height="16">
			<td height="16" colspan="2" style="background:url(images/foot_bg.jpg) center top no-repeat;">&nbsp;</td>
		</tr>  
	<tr><td colspan="3" align="right"></td></tr>
 
		</form>
		<? }
		
		// show individual records
		
		
		if($show=='view')
		{
		
			 	$sql="SELECT * FROM " .$cfg['DB_DISCLAIMER']. "WHERE `d_id`=".$_REQUEST['id']." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
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
                <td colspan="5" align="left" class="style2">&nbsp;Details of Disclaimer</td> 
				<td colspan="5" align="right" class="style2">
			<a style="text-decoration:none; color:#FFFFFF;" href="disclaimer_process.php?act=edit&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['d_id']?>"><strong>[Edit]</strong></a></td>
              </tr> 
            </thead> 
            <tbody>
			
			
              <?php /*?><? if($_REQUEST['m']){ ?>
              <tr class="row2">
                <td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
              </tr>
			  <? } ?><?php */?>
			
							  
			  <tr class="row2"> 
			    <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Title</span></td>
                <td width="70%" colspan="9" align="left"><?=stripslashes($row['title'])?></td>
			</tr>
			<tr class="row1"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Date</span></td>
                <td width="70%" colspan="9" align="left"><?=getdataformat($row['d_date'])?></td>
			</tr>
			<tr class="row2"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Description</span></td> 
                <td width="70%" colspan="9" align="left"><?=($row['description']=='')?'Not Applicable':stripslashes($row['description'])?></td>
			</tr>
			
			<tr class="row1"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Status</span></td> 
                <td width="70%" colspan="9" align="left"><?=($row['status']=='A')?'Active':'Inactive'?></td>
			</tr>
			
			<tr>
				<td align="center" colspan="7" style="padding-top:10px; padding-bottom:10px;">
					<a class="brownbttn" href="disclaimer.php?pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>">&lt;&lt;back</a>
				</td>
			</tr>
			
			
		 
          </tbody> 
          </table>
		  
		  
		  <tr height="16">
			<td height="16" colspan="2" style="background:url(images/foot_bg.jpg) center top no-repeat;">&nbsp;</td>
		</tr>
     
	  
   
	<tr><td colspan="3" align="right"></td></tr>
 
		  
		   
      </form>
	  <? }	
	
		// show insert window
		
		/* Stary Brand */
		
	
	if($show=='add') 
	{ ?>
		<form name="frmadd" id="frm2" method="post" action="disclaimer_process.php" onsubmit="return add_typ_value()" ><p>
		    <input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>" />
            <input type="hidden" name="act" value="insert" />
			</p>
          <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="5" align="left" class="style2">&nbsp;Add Disclaimer </td> 
              </tr> 
            </thead> 
            <tbody> 
              <? if($_REQUEST['m']){ ?>
              <tr class="row2">
                <td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
             </tr>
			  <? } ?>
			<tr class="row1"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Title </span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left"><input name="title" type="text" class="forminputelement" id="title" value="<?=($_SESSION['title']!='')?$_SESSION['title']:''?>"/>&nbsp;&nbsp;</td>
			</tr>	
			
			<tr class="row2"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Description </span><span class="redstar">*</span></td> 
                 <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
			</tr>
				
				<tr class="row1">
                 <td colspan="2" align="left">

			 <textarea name="des_name"  class="forminputelement" cols="80" id="des_name" /></textarea>
                  <script>
                    CKEDITOR.replace( 'des_name' );
                </script>				
				 </td>
            </tr>
			      
              <tr> 
                <td colspan="4" align="center">
					<a class="brownbttn" href="disclaimer.php?pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>">&lt;&lt;back</a>
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
	  
	  
	  
	         if($show=='edit')
			 {
			 
			 if($msg=='')
			{
				//session_unregister('title');
				unset($_SESSION['title']);
			}
            	$sql="SELECT * FROM ". $cfg['DB_DISCLAIMER'] ." where `d_id`=".$_REQUEST['id']." AND `siteId`= '".$cfg['SESSION_SITE']."' "; 
				$res=$heart->sql_query($sql);
				$row=$heart->sql_fetchrow($res);
	  ?>
	  <form name="frmedit"  id="frm3" method="post" action="disclaimer_process.php" onsubmit="return edit_typ_value()">
          <p>
            <input type="hidden" name="act" value="update" />            
            <input type="hidden" name="d_id" value="<?=$row['d_id']?>" />
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
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Change Title</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
					<!--<input name="title" type="text" class="forminputelement" id="title" value="<?=stripslashes($row['title'])?>"/>-->
					<input name="title" type="text" class="forminputelement" id="title" value="<?=($_SESSION['title']!='')?$_SESSION['title']:stripslashes($row['title'])?>"/>
					&nbsp;&nbsp;</td>
					
			 </tr> 
				
			
                
  				 
		<tr class="row2"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Change Description</span><span class="redstar">*</span></td> 
                <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
				
  		</tr>
 		<tr class="row1">
                 <td colspan="2" align="left">

				 <textarea name="des_name"  class="forminputelement" cols="80" id="des_name" /><?=stripslashes($row['description'])?></textarea>
                  <script>
                    CKEDITOR.replace( 'des_name' );
                </script>				
				 </td>
           </tr>
		  <tr> 
			<td colspan="4" align="center">
				<a class="brownbttn" href="disclaimer.php?pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>">&lt;&lt;back</a>
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
	   
	   