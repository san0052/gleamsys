<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
//include('../includes/template.php');
//$this_page='spe_category.php';
//include_once('../includes/links_frontend.php');
if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}
if($_REQUEST['m']==3) { $msg='Record Deleted';}
//if($_REQUEST['m']==4) { $msg='Order Updated';}
//if($_REQUEST['m']==5) { $msg='Record Details';}
//if($_REQUEST['m']==9) { $msg='Content should not be blank';}
if($_REQUEST['m']==10) { $msg='File type should be Image file';}

page_header($cfg['ADMIN_TITLE']." - Gallery Management");
// $parentId=($_REQUEST['pId']=="")?'0':$_REQUEST['pId'];
$show=$_REQUEST['show'];
$pg =($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0';
?>


<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />

<script language="javascript" src="scripts/category.js"></script>
		

 

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
			<a href="login.php?act=<?=md5("logout")?>"><img src="images/lock.png" height="24" width="24" border="0" style="vertical-align: middle;" /></a>&nbsp;&nbsp;
			</td>
	  <?php /*?><!--<td width="658" align="left" valign="middle">&nbsp;&nbsp;<span class="style1">Welcome <?=$_SESSION['admin_user_name']?></span></td>
	  <td  width="56"align="right" valign="middle"><a href="login.php?act=<?=md5("logout")?>"><img src="images/lock.png" title="Logout" width="24" height="24" border="0" /></a>&nbsp;&nbsp;&nbsp;&nbsp;</td>--><?php */?>
	  </tr>
	  <tr height="16">
	  <td colspan="2" align="left" valign="middle" style="background-color:#eee8e8;">&nbsp;</td>
	  </tr>
        <tr>
          <td colspan="2" align="center" style="background-color:#eee8e8;">
	  <? //show all record
	   if($_REQUEST['show']=='')
	   {
	  		/* $returnCatId=($_REQUEST['catId']=="")?'0':$_REQUEST['catId'];*/
	  		 $albumid=='';
	  		 ?>
	  		
	  		
			<!-- <input type="hidden" name="act" id="act" value="order" /> -->
			
			 <? $pageno=($_REQUEST['pageno']!='')?$_REQUEST['pageno']:'0'; ?>
		 	<input type="hidden" name="pageno" id="pageno" value="<?=$pageno?>" />
		 
			 <? /*if($parentId!=0){?><div style="text-align:left; width:90%; padding-bottom:2px;"><a href="watermark.php?pId=0" class="likcat">Parent</a> &raquo; <?=getcategoryname($parentId)?></div><? }*/?>
		 
	    	<table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
        	  <thead>
          	  <tr>
             	 <td colspan="2" align="left">&nbsp;<span class="style2">Gallery</span> </td>
             	  <td colspan="2" align="right">
             	  	 <form name="frm1" id="frm1" action="gallary.php" method="post">
             	  	 <select name="album" id="album" class="forminputelement" style="min-width: 100px;">	
             	  	<?php
             	  	if($_REQUEST['album']!=''){
             	  	$sqltype="SELECT * FROM ".$cfg['DB_ALBUM']." WHERE `status`!='D'  AND  `id`='".addslashes($_REQUEST['album'])."'";
					}else{
						$sqltype="SELECT * FROM ".$cfg['DB_ALBUM']." WHERE `status`!='D' ";
					}
						$restype=$heart->sql_query($sqltype);
						$maxrow=$heart->sql_numrows($restype);
						while($rowtype=$heart->sql_fetchrow($restype)){
             	  	?>
             	  		<option value="<?=$rowtype['id'];?>"><?=$rowtype['name'];?></option>
             	  	<?php
						}
             	  	?>
             	  	</select>
             	  	<input type="submit" name="search" id="search" value="search"  class="loginbttn">
             	  	</form>
             	  	</td>
              </tr>
          	</thead>
         	 <tbody>
            	<? if($_REQUEST['m']){ ?>
            	<tr class="row1">
              		<td colspan="4" align="right" class="redbuttonelements"><?=@$msg?></td>
           		 </tr>
			<? } ?>			
            <tr class="headercontent">
				 
              <td width="16%" align="center" class="leftBarText_new1">Sl No </td>
			  <td width="30%" align="center" class="leftBarText_new1">Image File</td>
			 <td width="23%" align="center" class="leftBarText_new1">Status</td>
			  <td width="25%" align="center" class="leftBarText_new1">Action</td>
            </tr>		  
		<? 
		
		$albumid=$_REQUEST['album'];
		if($albumid==''){
			$albumid=1;
		}
		
			$sql="SELECT * FROM ".$cfg['DB_GALLERY']."  WHERE `status`!= 'D' AND albumid='".$albumid."'";
			$res=$heart->sql_query($sql);
			$maxrow=$heart->sql_numrows($res);
			 $sql = $sql. " LIMIT $offset,$limit";
			 $res = $heart->sql_query($sql);
			 if($maxrow >0)
			 {
			 	while($row=$heart->sql_fetchrow($res)){
				 @$i++;
			?>
        	    <tr class="<?=($i%2==0)?'row1':'row2'?>">
				
    	          <td align="center"><?=$i+$offset?></td>
        
				  <td align="center" class="leftBarText">
				  <? if($row['image_name']==''){ ?>No File Exists <? } else{ ?> <img src="../<?=$cfg['GALLERY_IMAGES']?><?=$row['image_name']?>" width="170" height="120"> <? } ?></td>
			  
	              <td align="center">
				  	<a href="gallary.process.php?act=<?=($row['status']=='A')?'Inactive':'Active'?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['id']?>" class="<?=($row['status']=='A')?'greenbuttonelementsNew':'redbuttonelementsNew'?>"><?=($row['status']=='A')?'Active':'Inactive'?></a>				</td>
			  
				<td align="center">
					
					<a href="gallary.process.php?act=add&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['id']?>&album=<?=$row['albumid']?>"><img src="images/add-l.gif" title="Add" width="16" height="16" border="0" /></a>
					<a href="gallary.process.php?act=edit&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['id']?>&album=<?=$row['albumid']?>"><img src="images/edit.gif" title="Edit" width="16" height="16" border="0" /></a>
					<a href="gallary.process.php?act=delete&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['id']?>&album=<?=$row['albumid']?>"><img src="images/drop.gif" title="Delete" width="16" height="16" border="0" /></a>
				</td>
            </tr>
			<? }
			}
			else
			 {
				?>
	            <tr class="row1">
    	          <td colspan="4" align="center" class="msg">No Record.</td>
        	    </tr>  <? }?>
        	    <tr>
        	    	<td colspan="3"> <?=$heart->paginate($maxrow, $limit, $pageno, "pageno", "link")?></td>
        	    	<td colspan="1" align="right" style="padding-top:15px; padding-bottom:15px;">
						<a class="brownbttn" href="gallary.process.php?act=add&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['id']?>">Add Image</a>
					</td>
        	    </tr>
          </tbody>
        </table>
		
		</form>
		<? }
		
          if($show=='edit')
		  {
            $sql="SELECT * FROM ".$cfg['DB_GALLERY']."  WHERE `id`= '".$_REQUEST['id']."' ";
			$res=$heart->sql_query($sql);
			$row=$heart->sql_fetchrow($res);
	  ?>
	  <form name="frmedit"  id="frm3" method="post" action="gallary.process.php" onsubmit="return mark();"enctype="multipart/form-data">
          <p>
            <input type="hidden" name="act" value="update" />
            
            <input type="hidden" name="id" value="<?=$row['id']?>" />
             <input type="hidden" name="albumid" value="<?=$row['albumid']?>" />
			<input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>" />
			

          </p>
          <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="5" align="left" class="style2">Edit Image</td> 
              </tr> 
            </thead> 
            <tbody> 
              <? if($_REQUEST['m']){ ?>
              <tr class="row1">
                <td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
              </tr>
			  <? } ?>
			  
			 	<tr class="row1"> 
	                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Parent Name</span></td> 
	                <td width="70%" colspan="4" align="left">
	                <select name="album" id="album" class="forminputelement" style="min-width: 100px;">	
					<?php
	             	  	$sqltype="SELECT * FROM ".$cfg['DB_ALBUM']." WHERE `status`!='D'";
							$restype=$heart->sql_query($sqltype);
							$maxrow=$heart->sql_numrows($restype);
							while($rowtype=$heart->sql_fetchrow($restype)){
	             	  	?>
	             	  		<option value="<?=$rowtype['id'];?>" <?=($rowtype['id']==$_REQUEST['album'])?'selected':''?>><?=$rowtype['name'];?></option>
             	  	<?php
						}
             	  	?>
             	   	</select>
					</td>
 			 	</tr> 			
				<tr class="row1"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">File Name</span></td> 
                <td width="70%" colspan="4" align="left">
				<input type="text" name="name" class="forminputelement" id="name" value="<?=$row['name']?>"/>&nbsp;&nbsp;
			
				</td>
  </tr> 
				<tr class="row1"> 
                <td width="30%" align="left" class="leftBarText">
                	<span class="leftBarText_new">Upload to change file</span>
                	<span style="color: red">(500X375)</span>
                	</td> 
                <td width="70%" colspan="4" align="left">
				<input name="image_name" type="file" class="forminputelement" id="image_name"/>&nbsp;&nbsp;
				<img src="../<?=$cfg['GALLERY_IMAGES']?><?=$row['image_name']?>" width="60"  align="middle">
			
				</td>
  </tr> 
				
				
  
  
  <tr> 
				<td colspan="5" align="center">
					<a class="brownbttn" href="gallary.php?pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>">&lt;&lt;back</a>
					<input type="submit" name="Save" id="Save" value="Save" class="loginbttn">
				</td> 
                
              </tr> 
            </tbody> 
          </table> 
      </form>
	 <?
	  }
     if($show=='add')
		  {
            
	  ?>
	  <form name="frmedit"  id="frm3" method="post" action="gallary.process.php" onsubmit="return gallary();"enctype="multipart/form-data">
          <p>
            <input type="hidden" name="act" value="add_image" />
            
            <input type="hidden" name="id" value="<?=$row['id']?>" />
			<input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>" />
			

          </p>
          <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="5" align="left" class="style2">Add Image</td> 
              </tr> 
            </thead> 
            <tbody> 
              <? if($_REQUEST['m']){ ?>
              <tr class="row1">
                <td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
              </tr>
			  <? } ?>
			 	<tr class="row1"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Name</span></td> 
                <td width="70%" colspan="4" align="left">
                <select name="album" id="album" class="forminputelement" style="min-width: 100px;">
					<?php
	             	  	$sqltype="SELECT * FROM ".$cfg['DB_ALBUM']." WHERE `status`!='D'";
							$restype=$heart->sql_query($sqltype);
							$maxrow=$heart->sql_numrows($restype);
							while($rowtype=$heart->sql_fetchrow($restype)){
	             	  	?>
	             	  	<option value="<?=$rowtype['id'];?>" <?=($rowtype['id']==$_REQUEST['album'])?'selected':''?>><?=$rowtype['name'];?></option>
             	  	<?php
						}
             	  	?>
             	  </select>
				</td>
 			 </tr> 		
				<tr class="row1"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Name</span></td> 
                <td width="70%" colspan="4" align="left">
				<input type="text" name="name" id="name" value="" class="forminputelement">&nbsp;
			
				</td>
  </tr> 
				<tr class="row1"> 
                <td width="30%" align="left" class="leftBarText">
                	<span class="leftBarText_new">Upload to Add file</span>
                	<span style="color:#ce0e0e; margin-left:2px;">(500X375)</span>
                	
                </td> 
                <td width="70%" colspan="4" align="left">
				<input name="image_name" type="file" class="forminputelement" id="image_name"/>&nbsp;&nbsp;
			
				</td>
  </tr> 
				
				
  
  
  <tr> 
				<td colspan="5" align="center">
					<a class="brownbttn" href="gallary.php?pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>">&lt;&lt;back</a>
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
	   
