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
	  	 <form name="frm1" id="frm1" action="homeCounter-process.php" method="post">
		 	<input type="hidden" name="act" id="act" value="order" /> 
		 	<? $pageno=($_REQUEST['pageno']!='')?$_REQUEST['pageno']:'0'; ?>
			 <input type="hidden" name="pageno" id="pageno" value="<?=$pageno?>" />
			
	    <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="11" align="left">&nbsp;<span class="style2">Manage Testimonial</span> </td>
            </tr>
          </thead>
          <tbody>
            <?php if($_REQUEST['m']){ ?>
            <tr class="row1">
              <td colspan="11" align="right" class="redbuttonelements"><?=@$msg?></td>
            </tr>
			<? } ?>			
            <tr class="headercontent">
				 <td width="6%" align="center" class="leftBarText_new1"><input name="check_all" id="check_all" class="check-all" type="checkbox" onclick="checkall();"/></td>
          	     <td width="6%" align="center" class="leftBarText_new1">Sl No </td>
				 <!-- <td width="6%" align="center" class="leftBarText_new1">Db No </td> -->
            	 <td width="17%" align="center" colspan="3" class="leftBarText_new1">Content</td>
	             <td width="23%" align="center" colspan="3" class="leftBarText_new1">Content By</td>
				 <td width="13%" align="center" class="leftBarText_new1">Status</td> 
				 <td width="15%" align="center" class="leftBarText_new1">Action</td>
            </tr>		  
			
		<?
		 	$sql    = "SELECT * FROM ".$cfg['DB_TESTIMONIAL']." WHERE 
						`siteId`= '".$cfg['SESSION_SITE']."' 
						AND `status` != 'D'"; 
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
				<!-- <td align="center"><?//=$row['id']?></td> -->
			  
              	<td align="center" colspan="4" >&nbsp;<?=$row['subject'];?></td>
				<td align="center" colspan="2" >&nbsp;<?=$row['subjectBy'];?></td>		 	  
			  
              	<td align="center">
			  
				  <a href="testimonials-process.php?act=<?=($row['status']=='A')?'Inactive':'Active'?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['id']?>" class="<?=($row['status']=='A')?'greenbuttonelementsNew':'redbuttonelementsNew'?>"><?=($row['status']=='A')?'Active':'Inactive'?></a>
				  
				  </td>
			  
			  <td align="center">
			  	 <!--  <a href="homeCounter?show=view&pageno=<?//=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?//=$row['id']?>"><img src="images/view.gif" title="View" width="16" height="16" border="0" /></a> -->
			  
				  <a href="testimonials-process.php?act=edit&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['id']?>"><img src="images/edit.gif" title="Edit" width="16" height="16" border="0" /></a>
			  
				  <a href="testimonials-process.php?act=del&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['id']?>"><img src="images/drop.gif" title="Delete" width="16" height="16" border="0" onClick="return confirm('Do you really want to delete this record ?');" /></a>
			  
			  </td>
			  
            </tr>
			<? }
			
			
			
			}
			else {?>
            <tr class="row1">
              <td colspan="11" align="center" class="msg">No Record.</td>
            </tr>  <? }?>

		<!-- <tr >
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
        </tr> -->
		
          </tbody>
        </table>
		 <div class="bottomsecc">		
			<a class="brownbttn" href="testimonials-process.php?act=add&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>">Add Tesimonal</a>
		</div> 
		
		<tr height="16">
			<td height="16" colspan="2" style="background:url(images/foot_bg.jpg) center top no-repeat;">&nbsp;</td>
		</tr>  
	<tr><td colspan="3" align="right"></td></tr>
 
		
		</form>
		<? }
		
		// show individual records
		
		
		
		
	
	if($show=='add') 
	{ 
		
	?>
		<form name="frmadd" id="frm2" method="post" action="testimonials-process.php" onsubmit="return add_typ_value()" ><p>
		    <input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>" />
            <input type="hidden" name="act" value="insert" />
			</p>
          <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="5" align="left" class="style2">&nbsp;Add Testimonial</td> 
              </tr> 
            </thead> 
            <tbody> 
              <? if($_REQUEST['m']){ ?>
              <tr class="row2">
                <td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
             </tr>
			  <? } ?>
			<tr class="row1"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Content By</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left"><input type="text" name="subjectBy" id="subjectBy">

                </td>
			</tr>	
			
			<tr class="row2"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Content</span><span class="redstar">*</span></td> 
                 <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
			</tr>
				
				<tr class="row1">
                 <td colspan="2" align="center">
					<textarea name="subject" id="subject" class="forminputelement textareawid" rows="4"></textarea>	
				 </td>
            </tr>
			      
              <tr> 
                <td align="center" colspan="2">
					<a class="brownbttn" href="testimonials.php?pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>">&lt;&lt;back</a>
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
			 
			$sql="SELECT * FROM ". $cfg['DB_TESTIMONIAL'] ." 
			 		where `id`=".$_REQUEST['id']."  "; 
			$res=$heart->sql_query($sql);
			$row=$heart->sql_fetchrow($res);
	  ?>
	  <form name="frmedit"  id="frm3" method="post" action="testimonials-process.php" onsubmit="return edit_typ_value()">
          <p>
            <input type="hidden" name="act" value="update" />            
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
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Content By</span> <span class="redstar">*</span></td> 
                <td width="70%" colspan="4" align="left">
				<input type="text" class="forminputelement" name="subjectBy" id="subjectBy" value="<?=stripslashes($row['subjectBy'])?>"/>
				&nbsp;&nbsp;</td>
			 </tr> 
				<tr class="row2"> 
	                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Subject</span><span class="redstar">*</span></td> 
	                <td  width="70%" colspan="4" class="leftBarText" align="left" valign="top">
	                	<textarea name="subject" id="subject"><?php echo $row['subject'];?></textarea>
	                	<script>
                   			 CKEDITOR.replace( 'subject' );
                		</script>
	                </td>
		  		</tr>
		 		
		   <td align="center" colspan="2">
				<a class="brownbttn" href="testimonials.php?pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>">&lt;&lt;back</a>
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
	   