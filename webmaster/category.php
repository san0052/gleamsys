<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
$this_page='category.php';

//include_once('../includes/links_frontend.php');
if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}
if($_REQUEST['m']==3) { $msg='Record Deleted';}
if($_REQUEST['m']==4) { $msg='Order Updated';}
if($_REQUEST['m']==9) { $msg='Content should not be blank';}

page_header($cfg['ADMIN_TITLE']." - Category Management");

$secparent=($_REQUEST['secpid']=="")?'0':$_REQUEST['secpid'];
$parentId=($_REQUEST['pId']=="")?'0':$_REQUEST['pId'];
$show=$_REQUEST['show'];

$pg =($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0';
$secpid =($_REQUEST['secpid']!="")?$_REQUEST['secpid']:'0';
$pId =($_REQUEST['pId']!="")?$_REQUEST['pId']:'0';

?>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="scripts/common.js"></script>
<script language="javascript" src="scripts/ajax.js"></script>
<script language="javascript" src="scripts/ajax1.js"></script>
<script language="javascript" src="scripts/category.js"></script>
<script language="javascript" src="scripts/jquery.js"></script>
<style type="text/css">

<!--

.style3 {color: #FFFFFF}

-->

</style>
      <td vAlign=top align="center" width="99%"><!-- Start Body Here -->
  <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr height="34">
      <td width="25%" rowspan="2" colspan="3" align="center" valign="top"><br />
        <br />
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
      			<?php
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
           
          </tr>
          <tr height="16">
            <td colspan="2" align="left" valign="middle" style="background-color:#eee8e8;">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" style="background-color:#eee8e8;" align="center"><? //show all record

	   if($_REQUEST['show']==''){

	  /* $returnCatId=($_REQUEST['catId']=="")?'0':$_REQUEST['catId'];*/

	   ?>
              <form name="frm1" id="frm1" action="category_process.php" method="post">
                <input type="hidden" name="act" id="act" value="order" />
                <? $pageno=($_REQUEST['pageno']!='')?$_REQUEST['pageno']:'0'; ?>
                <input type="hidden" name="pageno" id="pageno" value="<?=$pageno?>" />
                <? if($parentId!=0){?>
                <div style="text-align:left; width:98%; padding-bottom:8px;"><a href="category.php?pId=0&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>" class="linkcat">Parent</a>
                  <? if($_REQUEST['secpid']!=0){?>
                  &raquo; <a href="category.php?pId=<?=$_REQUEST['secpid']?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>" class="linkcat">
                  <input type="hidden" name="secpid" id="secpid" value="<?=$_REQUEST['secpid']?>" />
                  <?=getcategoryname($_REQUEST['secpid'])?>
                  </a>
                  <? }?>
                  &raquo;
                  <?=getcategoryname($parentId)?>
                </div>
                <? }?>
                <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
                  <thead>
                    <tr>
                      <td colspan="11" align="left">&nbsp;<span class="style2">Category  Section</span> </td>
                    </tr>
                  </thead>
                  <tbody>
                    <? if($_REQUEST['m']){ ?>
                    <tr class="row1">
                      <td colspan="11" align="right" class="redbuttonelements"><?=@$msg?></td>
                    </tr>
                    <? } ?>
                    <tr class="headercontent">
                      <td width="5%" align="center" class="leftBarText_new1"><input name="check_all" id="check_all" class="check-all" type="checkbox" onclick="checkall();"/></td>
                      <td width="6%" align="center" class="leftBarText_new1">Sl No </td>
                      <td width="8%" align="left" class="leftBarText_new1">Db Id </td>
                      <td align="left" class="leftBarText_new1" colspan="3">Category</td>
                      <td class="leftBarText_new1">Category Image</td>
                      <td width="13%" align="center" class="leftBarText_new1">Order &nbsp;
                        <input type="image" src="images/1308660287_order.png"  name="save" value="Save" title="Save" align="absmiddle" />
                      </td>
                      <td width="8%" align="center" class="leftBarText_new1">Status</td>
                      <td width="13%" align="center" class="leftBarText_new1">Action</td>
                    </tr>
                    <? 

            		    $sql="SELECT * FROM ".$cfg['DB_CATEGORY']."  WHERE `cat_parent_id`=".$parentId." AND `siteId`='".$cfg['SESSION_SITE']."' ORDER BY `order`";

            			 $res=$heart->sql_query($sql);

            			 $maxrow=$heart->sql_numrows($res);

            			 if($maxrow >0){

            			 while($row=$heart->sql_fetchrow($res)){

            			 @$i++;

            			?>
                    <tr class="<?=($i%2==0)?'row1':'row2'?>">
                      <td align="center"><input  name="checkvalue" id="checkvalue"  value="<?=$row['id']?>" type="checkbox" />
                      </td>
                      <td align="center"><?=$i+$offset?></td>
                      <td align="left" ><?=$row['id']?></td>
                      <td align="left" colspan="3" >&nbsp;
                        <? if(count(getChildCategories($row['id']))>0){?>
                        <a href="category.php?pId=<?=$row['id']?>&secpid=<?=$_REQUEST['pId']?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>">
                        <?=$row['name']?>
                        </a>
                        <? }else{?>
                        <?=$row['name']?>
                        <? }?></td>
                        <td width="20%">
                          <?php if($row['image']){ ?>
                            <image src="../uploads/category/<?php echo $row['image']?>" style="width:50%; height: auto">
                            <?php } else{ ?>
                              Image not available
                          <?php }?>
                        </td>
                      <td align="center" class="leftBarText"><input name="catorder[<?=$row['id'];?>]" type="text" class="forminputelement" id="catorder[<?=$row['id'];?>]"  size="3" value="<?=$row['order'];?>"/></td>
                      
                      <td align="center"><a href="category_process.php?act=<?=($row['status']=='A')?'Inactive':'Active'?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['id']?>&secpid=<?=($_REQUEST['secpid']!="")?$_REQUEST['secpid']:'0'?>&pId=<?=($_REQUEST['pId']!="")?$_REQUEST['pId']:'0'?>" class="<?=($row['status']=='A')?'greenbuttonelementsNew':'redbuttonelementsNew'?>">
                        <?=($row['status']=='A')?'Active':'Inactive'?>
                        </a> </td>
                      <td align="center"><a href="category.php?show=edit&id=<?=$row['id']?>&pId=<?=$parentId?>&secpid=<?=$secparent?>"><img src="images/edit.gif" title="Edit" width="16" height="16" border="0" /></a><a href="category_process.php?act=del&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['id']?>&secpid=<?=($_REQUEST['secpid']!="")?$_REQUEST['secpid']:'0'?>&pId=<?=($_REQUEST['pId']!="")?$_REQUEST['pId']:'0'?>"><img src="images/drop.gif" title="Delete" width="16" height="16" border="0" onClick="return confirm('Do you really want to delete this record');" /></a></td>
                    </tr>
                    <? }

			}

			  else {?>
                    <tr class="row1">
                      <td colspan="11" align="center" class="msg">No Record.</td>
                    </tr>
                    <? }



?>
                    <tr >
                      <td colspan="8" align="left" class="redbuttonelements"><select name="dropdown1" class="forminputelement">
                          <option value="">Choose an action... </option>
                          <option value="delete">Delete</option>
                          <option value="Active">Active</option>
                          <option value="Inactive">Inactive</option>
                        </select>
                        <input value="Apply to selected"  name="submit" type="button" onclick="return validation_delete('<?=$pg?>','<?=$pId?>','<?=$secpid?>');" class="loginbttn"/>
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
                  <a class="brownbttn" href="category.php?show=add&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&secpid=<?=($_REQUEST['secpid']!="")?$_REQUEST['secpid']:'0'?>&pId=<?=($_REQUEST['pId']!="")?$_REQUEST['pId']:'0'?>">Add New Category</a>
                </div>
              </form>
              <? }

		

		

	

		// show insert window

		

		

		

		/* Stary Brand */

		

		

	  if($show=='add') { ?>
              <form name="frmadd" id="frm2" method="post" action="category_process.php"  enctype='multipart/form-data' onsubmit="return add_typ_value()">
                <p>
                  <input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>" />
                  <input type="hidden" name="secpid" id="secpid" value="<?=$_REQUEST['secpid']?>" />
                  <input type="hidden" name="pId" id="pId" value="<?=$_REQUEST['pId']?>" />
                  <input type="hidden" name="act" value="insert" />
                  <input type="hidden" name="type_check" value=""  id="type_check"/>
                </p>
                <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
                  <thead>
                    <tr>
                      <td colspan="5" align="left" class="style2">&nbsp;Add  Category Section </td>
                    </tr>
                  </thead>
                  <tbody>
                    <? if($_REQUEST['m']){ ?>
                    <tr class="row1">
                      <td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
                    </tr>
                    <? } ?>
                    <tr class="row2">
                      <td align="left"><span class="leftBarText_new">Parent Category</span> <span class="redstar">*</span></td>
                      <td colspan="4" align="left">
                        <?php
                  				$sql1 ="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE  `cat_parent_id` = '0' AND `status`='A' AND `siteId`= '".$cfg['SESSION_SITE']."'  ";
                  				$res1 =$heart->sql_query($sql1);
				                ?>
                        <select name="pId" id="pId" class="forminputelement" onchange="getsec_category(this.value);category_availability();">
                          <option value="0">Parent Category</option>
                          <?

                				  while($row1=$heart->sql_fetchrow($res1)){

                				?>
                          <option value=<?=$row1['id']?>>
                          <?=$row1['name']?>
                          </option>
                          <? }?>
                        </select>
                      </td>
                    </tr>
                    <tr class="row1">
                      <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Second Parent Name </span> <span class="redstar">*</span></td>
                      <td><div id="sec_parent">
                          <select name="secpid" id="secpid" class="forminputelement" onchange="category_availability();">
                            <option value="0" >Second parent</option>
                          </select>
                        </div></td>
                    </tr>
                    <tr class="row2">
                      <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Category Name</span> <span class="redstar">*</span></td>
                      <td width="70%" colspan="4" align="left">
                        <input name="cat_name" type="text" class="forminputelement" id="cat_name" onkeyup="category_availability();" onblur="category_availability();" />
                        &nbsp;&nbsp;<span style="display:none;" id="exsists">
                          <img src="images/cross_circle.png"  align="absmiddle" width="16"/>&nbsp;Already exists</span><span style="display:none;" id="notexsists">
                            <img src="images/tick_circle.png" width="16" align="absmiddle" />&nbsp;Ok</span>
                        </div>
                        <? if(countShowinTop() <5){?>
                        <div id="show_in_menu">
                          <input type="checkbox" name="ch1" id="ch1" value="Y" />
                          &nbsp;<span class="leftBarText_new">Show in top menu</span></div>
                        <? }?>
                      </td>
                      <tr>
                        <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Category image</span></td>
                         <td width="70%">
                            <input type="file" name="image" id="image">
                       </td>
                      </tr>
                    </tr>

                    

                    <tr>
                      <td colspan="4" align="center">
            						<a class="brownbttn" href="category.php?pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&secpid=<?=($_REQUEST['secpid']!="")?$_REQUEST['secpid']:'0'?>&pId=<?=($_REQUEST['pId']!="")?$_REQUEST['pId']:'0'?>">&lt;&lt;back</a>
            						<input type="submit" name="Save" id="Save" value="Save" class="loginbttn">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </form>
              <? }

          if($show=='edit'){

            $sql="SELECT * FROM ". $cfg['DB_CATEGORY']." WHERE  `id` =".$_REQUEST['id']."";

			     $res=$heart->sql_query($sql);

			     $row=$heart->sql_fetchrow($res);

	         ?>
              <form name="frmedit"  id="frm3" method="post" action="category_process.php" enctype="multipart/form-data" onsubmit="return edit_typ_value()">
                <p>
                  <input type="hidden" name="act" value="edit_category" />
                  <input type="hidden" name="type_check_edit" value=""  id="type_check_edit"/>
                  <input type="hidden" name="typeids" value="<?=$_REQUEST['id']?>" />
                  <input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>" />
                  <input type="hidden" name="secpid" id="secpid" value="<?=$_REQUEST['secpid']?>" />
                  <input type="hidden" name="pId" id="pId" value="<?=$_REQUEST['pId']?>" />
                  <input name="category_or" type="hidden" style=" border-color:#98C1B5; background-color:#98C1B5;" class="forminputelement" id="category_or" value="<?=$row['name']?>" readonly="readonly" />
                </p>
                <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
                  <thead>
                    <tr>
                      <td colspan="5" align="left" class="style2">&nbsp;Edit  Category Section </td>
                    </tr>
                  </thead>
                  <tbody>
                    <? if($_REQUEST['m']){ ?>
                    <tr class="row1">
                      <td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
                    </tr>
                    <? } ?>
                    <tr class="row2">
                      <td align="left"><span class="leftBarText_new">Parent Category</span> <span class="redstar">*</span></td>
                      <td colspan="4" align="left">
                      <?php

                				$sql1="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE  `id` = '".$_REQUEST['id']."' AND `status`='A' AND `siteId`= '".$cfg['SESSION_SITE']."'";

                				$res1=$heart->sql_query($sql1);
                				$row1=$heart->sql_fetchrow($res1);
              				?>
                        <select name="pId" id="pId" class="forminputelement" onchange="getsec_category(this.value);category_availability();">
                          <?php
				                    if($row1['cat_parent_id']==0){
				                  ?>
                          <option value="0">Parent Category</option>
                          <?php	$sql4="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `cat_parent_id`='0'";
						                $res4=$heart->sql_query($sql4);
						                while($row4=$heart->sql_fetchrow($res4)){
				                  ?>
                          <option value="<?=$row4['id']?>">
                          <?=$row4['name']?>
                          </option>
                          <?php 
				                    } }else{				
					                   echo $sql2="select * from ".$cfg['DB_CATEGORY']." where `cat_parent_id`='0'";
				                      $res2=$heart->sql_query($sql2);	
				                      while($row2=$heart->sql_fetchrow($res2)){
			 	                   ?>
                          <option value="<?=$row2['id']?>"<? if($row2['id']==$_REQUEST['pId']){echo "selected";}?>>
                          <?=$row2['name']?>
                          </option>
                          <? }}?>
                        </select>
                      </td>
                    </tr>
                    <tr class="row1">
                      <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Second Parent Name </span> <span class="redstar">*</span></td>
                      <td><div id="sec_parent">
                          <select name="secpid" id="secpid" class="forminputelement" onchange="category_availability();">
                            <?php
              							if($row1['cat_parent_id']==0){
              								$sql3="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE  `cat_parent_id` = '".$_REQUEST['id']."' ";
              							}
              							else{
              								$sql3="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE  `cat_parent_id` = '".$_REQUEST['pId']."' ";
              							}
              							 
              							$res3=$heart->sql_query($sql3);
						              ?>
                            <option value="0" >Second parent</option>
                            <?php
								              while($row3=$heart->sql_fetchrow($res3)){
							              ?>
                            <option value="<?=$row3['cat_parent_id']?>">
                            <?=$row3['name']?>
                            </option>
                            <?php }?>
                          </select>
                        </div></td>
                    </tr>
                    <tr class="row2">
                      <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Category Name </span> <span class="redstar">*</span></td>
                      <td width="70%" colspan="4" align="left"><input name="cat_name" type="text" class="forminputelement" id="cat_name" onkeyup="category_availability();" onblur="category_availability();" value="<?=$row1['name']?>" />
                        &nbsp;&nbsp;<span style="display:none;" id="exsists"><img src="images/cross_circle.png"  align="absmiddle" width="16"/>&nbsp;Already exists</span><span style="display:none;" id="notexsists"><img src="images/tick_circle.png" width="16" align="absmiddle" />&nbsp;Ok</span>
                        </div>

                        <tr>
                        <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Category image</span></td>
                         <td width="70%">
                            <input type="file" name="image" id="image">&nbsp;&nbsp;
                           <br><img src="../uploads/category/<?php echo $row1['image']?>" alt="" style="width:30%;height:auto;">
                       </td>
                      </tr>
                    </tr>
                        <!-- <? //if(countShowinTop() <5){?>
                        <div id="show_in_menu">
                          <input type="checkbox" name="ch1" id="ch1" value="Y" <?//=($row1['show_in_top_menu']=='Y')?'checked="checked"':'';?>>
                          &nbsp;<span class="leftBarText_new">Show in top menu</span> 
                        </div>
                        <? //} ?> -->
                      </td>
                    </tr>
                    <tr>
                      <td colspan="4" align="center">
            						<a class="brownbttn" href="category.php?pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>">&lt;&lt;back</a>
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
        </table></td>
    </tr>
    <tr>
      <td colspan="3" align="right"></td>
    </tr>
  </table>
