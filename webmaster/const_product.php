<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
//include('../includes/template.php');

//include_once('../includes/links_frontend.php');
if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}
if($_REQUEST['m']==3) { $msg='Record Deleted';}
if($_REQUEST['m']==4) { $msg='Order Updated';}
if($_REQUEST['m']==9) { $msg='Content should not be blank';}
if($_REQUEST['m']==5) { $msg='Please upload mentioned size of image';}
$pg =($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0';
page_header($cfg['ADMIN_TITLE']." - Construction Product Management");

$show=$_REQUEST['show'];
?>


<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="scripts/common.js"></script>
<script language="javascript" src="scripts/prod.js"></script>
<script language="javascript" src="boxover.js"></script>
<!--<script language="javascript" type="text/javascript">

function showcategory(id){
	document.getElementById('im').src=id;
}

</script>-->

<script language="javascript" src="scripts/common.js"></script>

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
      <td align="center" valign="top" width="99%">
	  <table width="698" align="center" border="0" cellspacing="0" cellpadding="0">
	  <tr height="35" background="images/welcome_head.jpg">
	  <td width="658" align="left" valign="middle">&nbsp;&nbsp;<span class="style1">Welcome 
  <?=$_SESSION['admin_user_name']?></span></td>
	  <td  width="56"align="right" valign="middle"><a href="login.php?act=<?=md5("logout")?>"><img src="images/lock.png" title="Logout" width="24" height="24" border="0" /></a>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	  </tr>
	  <tr height="16">
	  <td colspan="2" align="left" valign="middle" bgcolor="#CFCFCF">&nbsp;</td>
	  </tr>
        <tr>
          <td colspan="2" bgcolor="#CFCFCF" align="center">
	  <? //show all record
	   if($_REQUEST['show']==''){
	   $returnCatId=($_REQUEST['catId']=="")?'0':$_REQUEST['catId'];
	   ?>
	   <form name="frm1" id="frm1" action="fab_category_process.php" method="post">
		 <input type="hidden" name="act" id="act" value="order" /> 
		 <? $pageno=($_REQUEST['pageno']!='')?$_REQUEST['pageno']:'0'; ?>
		 <input type="hidden" name="pageno" id="pageno" value="<?=$pageno?>" />
	    <table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="3" align="left">&nbsp;<span class="style2">Product Section</span> </td>
              <td colspan="3" align="right">
			  <?
			$sql_cat="SELECT * FROM ".$cfg['DB_CONSTRUCTION']." WHERE `cat_parent_id`=0 AND `status` ='A'";
			$res_cat=$mycms->sql_query($sql_cat);
			?>
                  <select name="catId" class="forminputelement" id="catId" onchange="window.location.href='const_product.php?catId='+this.value">
                    <option value="0" selected="selected">All Product</option>
					<? while($row_cat=$mycms->sql_fetchrow($res_cat)){
					$parentCatId=$row_cat['cat_id'];
					?>
					 <optgroup label="<?=$row_cat['cat_name']?>">
			<?
			/*$child=count(getChildCategories($parentCatId));
			while($child>0){*/
			$sql_cat1="SELECT * FROM ".$cfg['DB_CONSTRUCTION']." WHERE `cat_parent_id`='".$parentCatId."' AND `status` ='A'";
			$res_cat1=$mycms->sql_query($sql_cat1);
			while($row_cat1=$mycms->sql_fetchrow($res_cat1)){
			?>
				<option value="<?=$row_cat1['cat_id']?>" <?=($row_cat1['cat_id']==$returnCatId)?'selected="selected"':''?>><?=$row_cat1['cat_name']?></option>
					 <? 
					/* $parentCatId=$row_cat1['cat_id'];
					 	}*/
					 }?>
					 </optgroup>
					 <? }?>
                  </select>
			  </td>
              </tr>
          </thead>
          <tbody>

            <tr class="row2">
              <td colspan="6" align="right" class="redbuttonelements"><?=@$msg?></td>
            </tr>
            <tr class="headercontent">
			<td width="6%" align="center" class="leftBarText_new1">
			  	<input name="check_all" id="check_all" class="check-all" type="checkbox" onclick="checkall4();"/></td>
              <td width="7%" align="center" class="leftBarText_new1">Sl No </td>
              <td width="30%" align="left" class="leftBarText_new1">Product Title </td>
              <td width="19%" align="right" class="leftBarText_new1">Product Price ($)</td>
              <td width="17%" align="center" class="leftBarText_new1">Status</td>
              <td width="21%" align="center" class="leftBarText_new1">Action</td>
            </tr>
		  
		<? 
		$i=0;
		if($returnCatId=="" || $returnCatId==0){
		$sql="SELECT * FROM ".$cfg['DB_CONST_PRODUCT']."WHERE (`pd_status`='A' OR `pd_status`='I') ORDER BY `pd_name` ASC";
		}else{
		$sql="SELECT * FROM ".$cfg['DB_CONST_PRODUCT']."WHERE `cat_id`='".$returnCatId."' AND (`pd_status`='A' OR `pd_status`='I') ORDER BY `pd_name` ASC";
		}
		$res=$mycms->sql_query($sql);
		$maxrow=$mycms->sql_numrows($res);
		$sql = $sql. " LIMIT $offset,$limit";
		$res = $mycms->sql_query($sql);
		if($maxrow >0){
		while($row=$mycms->sql_fetchrow($res)){
		@$i++;
		?>
            <tr class="<?=($i%2==0)?'row1':'row2'?>">
			<td align="center"><input  name="checkvalue" id="checkvalue"  value="<?=$row['pd_id']?>" type="checkbox" /></td>
              <td align="center"><?=$i+$offset?></td>
              <td align="left" <?=($row['pd_id']==$_REQUEST['proId'])?'style="background:url(images/bot.png) left center no-repeat;"':''?>>&nbsp;<?=$row['pd_name']?></td>
              <td align="right" valign="middle" ><?=$row['pd_price']?></td>
              <td align="center"><a href="const_product_process.php?act=<?=($row['pd_status']=='A')?'Inactive':'Active'?>&id=<?=$row['pd_id']?>&catId=<?=$returnCatId?>" class="<?=($row['pd_status']=='A')?'greenbuttonelementsNew':'redbuttonelementsNew'?>"><?=($row['pd_status']=='A')?'Active':'Inactive'?></a></td>
              <td align="center"><a href="const_product_process.php?act=view&id=<?=$row['pd_id']?>&catId=<?=$returnCatId?>"><img src="images/view.gif" title="View" width="16" height="16" border="0" /></a><a href="const_product_process.php?act=edit&id=<?=$row['pd_id']?>&catId=<?=$returnCatId?>"><img src="images/edit.gif" title="Edit" width="16" height="16" border="0" /></a><a href="const_product_process.php?act=del&id=<?=$row['pd_id']?>&catId=<?=$returnCatId?>"><img src="images/drop.gif" title="Delete" width="16" height="16" border="0" onClick="return confirm('Do you really want to delete this record');" /></a></td>
            </tr>
			<? }
			}
			  else {?>
            <tr class="row1">
              <td colspan="6" align="center" class="msg">No Record.</td>
            </tr>  <? }

?>
<tr >
		<td colspan="3" align="left" class="redbuttonelements">
				
				<select name="dropdown1" class="forminputelement">
					<option value="">Choose an action...	</option>
					<option value="delete">Delete</option>	
					<option value="Active">Active</option>
					<option value="Inactive">Inactive</option>							
				</select>
				<input value="Apply to selected"  name="submit" type="button" onclick="return validation_delete4('<?=$pg?>');" class="loginbttn"/>
			
			</td>
                <td colspan="3" align="right" class="redbuttonelements"></td>
              </tr>
          </tbody>
        </table>
		<div style="width:90%; text-align:right;">
		<?=$mycms->paginate($maxrow, $limit, $pageno, "pageno", "link")?>
		<p><a href="const_product_process.php?act=add">Add new Product</a></p>
		</div>
		</form>
		<? }?>
		<? // show insert window
		if($show=='add'){?>
	  
	  <form name="frmadd" method="post" action="const_product_process.php" id="frmadd" onsubmit="return chkAddProduct();" enctype="multipart/form-data">
          <p>
            <input type="hidden" name="act" value="insert" />
          </p>
          <table width="90%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
            <thead> 
              <tr> 
                <td colspan="5" align="left" class="style2">&nbsp;Add Product Section </td> 
              </tr> 
            </thead> 
            <tbody> 
              <tr class="row1">
                <td colspan="5" align="right" class="redbuttonelements"><?=@$msg?></td>
              </tr>
              <tr class="row2">
                <td align="left" class="leftBarText"><span class="leftBarText_new">Product Name  </span> <span class="style3">*</span></td>
                <td colspan="4" align="left"><input name="imgTitle" type="text" class="forminputelement" id="imgTitle" value="<?=($_SESSION['imgTitle']!='')?$_SESSION['imgTitle']:''?>"/></td>
              </tr>
			  <tr class="row1">
              <td align="left" valign="top" class="leftBarText_new"><span class="leftBarText_new">Product Price<span class="style3">*</span></span></td>
              <td align="left"><input name="imgPrice" type="text" class="forminputelement" id="imgPrice" value="<?=($_SESSION['imgPrice']!='')?$_SESSION['imgPrice']:''?>"/></td>
            </tr>
              <tr class="row2"> 
                <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new"> Product Image </span> <span class="style3">*</span></td> 
                <td width="70%" colspan="4" align="left"><input  name="imgPhotoAdd" type="file" class="forminputelement" id="imgPhotoAdd" />               </td>
              </tr> 
              <tr class="row1">
                <td class="leftBarText_new" align="left"> Category <span class="style3">*</span></td>
                <td colspan="4" align="left">
			<?
		$sql_cat="SELECT * FROM ".$cfg['DB_CONSTRUCTION']." WHERE `cat_parent_id`=0 AND `status` ='A'";
			$res_cat=$mycms->sql_query($sql_cat);
			?>
                  <select name="categoryId" class="forminputelement" id="categoryId">
                    <option value="0" selected="selected">Select Category</option>
					<? while($row_cat=$mycms->sql_fetchrow($res_cat)){?>
					 <optgroup label="<?=$row_cat['name']?>">
					 <?
			$sql_cat1="SELECT * FROM ".$cfg['DB_CONSTRUCTION']." WHERE `cat_parent_id`='".$row_cat['id']."' AND `status` ='A'";
			$res_cat1=$mycms->sql_query($sql_cat1);
			while($row_cat1=$mycms->sql_fetchrow($res_cat1)){
			?>
				<option value="<?=$row_cat1['id']?>" <?php if($_SESSION['categoryId']==$row_cat1['id']){?> selected="selected" <? } ?>><?=$row_cat1['name']?></option>
					 <? }?>
					 </optgroup>
					 <? }?>
                  </select>                </td>
              </tr>
			  <!--<tr class="row2">
              <td align="left" valign="top" class="leftBarText_new"><span class="leftBarText_new">Product Quantity <span class="style3">*</span></span></td>
              <td align="left"><input name="pQty" type="text" class="forminputelement" id="pQty" /></td>
            </tr>-->
			  <tr class="row2">
              <td align="left" valign="top" class="leftBarText_new" colspan="2"><span class="leftBarText_new">Product Description</span>
			</td>
            </tr>
			  <tr class="row1">
              <td align="left" valign="top" class="leftBarText_new" colspan="2">
             
			  <?php
				// FCKEDITOR
				$oFCKeditor = new FCKeditor('description_add') ;
				$oFCKeditor->BasePath	= $sBasePath;
				$oFCKeditor->Width		= '100%';
				$oFCKeditor->Height		= '400';
				$oFCKeditor->ToolbarSet	= 'Default';
				$oFCKeditor->Value		= '';
				print $oFCKeditor->CreateHtml();
				?>			  </td>
            </tr>
			
            <tr class="row2">
              <td colspan="2" align="left" valign="top" class="leftBarText_new">&nbsp;</td>
              </tr>
              <tr> 
                <td align="right"><a href="const_product.php">&lt;&lt;back</a></td> 
                <td colspan="4" align="left"><input type="submit" name="Save" id="Save" value="Save" class="loginbttn"> 
&nbsp;</td> 
              </tr> 
            </tbody> 
          </table> 
      </form>
	  <? } 
	  // show edit window
	  if($show=='edit'){
	 		$sql="SELECT * FROM ".$cfg['DB_CONST_PRODUCT']." WHERE  pd_id =".$_REQUEST['id']."";
			$res=$mycms->sql_query($sql);
			$row=$mycms->sql_fetchrow($res);
	  
	  ?>
	  <form action="const_product_process.php" method="post" name="frmedit" id="frmedit" enctype="multipart/form-data" onsubmit="return chkEditProduct();">
        <p>
          <input type="hidden" name="act" value="update" />
		  <input type="hidden" name="id" value="<?=$_REQUEST['id']?>" />
      </p>
	    <table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="2" align="left" class="style2">&nbsp;Edit Product Section </td>
            </tr>
          </thead>
          <tbody>
           <tr class="row1">
              <td colspan="2" align="right" class="redbuttonelements"><?=@$msg?></td>
            </tr>
            <tr class="row2">
              <td align="left" valign="top" class="leftBarText_new"><span class="leftBarText_new">Product Name<span class="style3">*</span></span></td>
              <td align="left"><input name="imgTitle" type="text" class="forminputelement" id="imgTitle" value="<?=($_SESSION['imgTitle']!='')?$_SESSION['imgTitle']:$row['pd_name']?>" /></td>
            </tr>
			<tr class="row1">
              <td align="left" valign="top" class="leftBarText_new"><span class="leftBarText_new">Product Price<span class="style3">*</span></span></td>
              <td align="left"><input name="imgPrice" type="text" class="forminputelement" id="imgPrice" value="<?=($_SESSION['imgPrice']!='')?$_SESSION['imgPrice']:$row['pd_price']?>" /></td>
            </tr>
            <tr class="row2">
              <td width="30%" align="left" valign="top" class="leftBarText_new"><span class="leftBarText_new">Product Image </span> <span class="style3">*</span></td>
              <td align="left">
                	<? $sql1="SELECT * FROM ".$cfg['DB_CONST_IMAGE']." WHERE  `pd_id` =".$row['pd_id']."";
			   $res1=$mycms->sql_query($sql1);
				$row1=$mycms->sql_fetchrow($res1);
				if($row1['pd_image']!="")
				{ ?>
                <input  name="imgPhotoEdit" type="file" class="forminputelement" id="imgPhotoEdit" value="" onfocus="getimg(this.value)" />&nbsp;<img src="../<?=$cfg['CONST_PRODUCT']?><?=$row1['pd_image']?>" width="50" height="50" id="im" /><?
				} ?>
                <!--(*image size should be 182 X 256)--></td>
            </tr>
            <tr class="row1">
              <td class="leftBarText_new" align="left" valign="top">Category <span class="style3">*</span></td>
              <td  class="leftBarText" align="left" valign="top">
			  <?
			$sql_cat="SELECT * FROM ".$cfg['DB_CONSTRUCTION']." WHERE `cat_parent_id`=0 AND `status` ='A'";
			$res_cat=$mycms->sql_query($sql_cat);
			?>
                  <select name="categoryId" class="forminputelement" id="categoryId">
                   
					<? while($row_cat=$mycms->sql_fetchrow($res_cat)){?>
					 <optgroup label="<?=$row_cat['name']?>">
					<?
			$sql_cat1="SELECT * FROM ".$cfg['DB_CONSTRUCTION']." WHERE `cat_parent_id`='".$row_cat['id']."' AND `status` ='A'";
			$res_cat1=$mycms->sql_query($sql_cat1);
			while($row_cat1=$mycms->sql_fetchrow($res_cat1)){
			
			if($_SESSION['categoryId']!='')
				{
					$cat_id=$_SESSION['categoryId'];
				}
				else
				{
					$cat_id=$row_cat1['id'];
				}
			?>
				<option value="<?=$row_cat1['id']?>" <?php if($row_cat1['id']==$cat_id){?>selected="selected"<? } ?>><?=$row_cat1['name']?></option>
					 <? }?>
					 </optgroup>
					 <? }?>
                  </select>			  </td>
            </tr>
			<!--<tr class="row2">
              <td align="left" valign="top" class="leftBarText_new"><span class="leftBarText_new">Product Quantity <span class="style3">*</span></span></td>
              <td align="left"><input name="pQty" type="text" class="forminputelement" id="pQty" value="<?=$row['pd_qty']?>" /></td>
            </tr>-->
			  <tr class="row2">
              <td align="left" valign="top" class="leftBarText_new" colspan="2"><span class="leftBarText_new">Product Description <span class="style3">*</span></span>
			  </td>
			  </tr>
            <tr class="row1">
              <td align="left" valign="top" class="leftBarText_new" colspan="2">
			  <?php
				// FCKEDITOR
				$oFCKeditor = new FCKeditor('description_edit') ;
				$oFCKeditor->BasePath	= $sBasePath;
				$oFCKeditor->Width		= '100%';
				$oFCKeditor->Height		= '400';
				$oFCKeditor->ToolbarSet	= 'Default';
				$oFCKeditor->Value		= stripslashes($row['pd_description']);
				print $oFCKeditor->CreateHtml();
				?>			  </td>
            </tr>
			
            <tr class="row2">
              <td colspan="2" align="left" valign="top" class="leftBarText_new">&nbsp;</td>
              </tr>
            <tr>
              <td align="right"><a href="const_product.php?catId=<?=$_REQUEST['catId']?>&proId=<?=$_REQUEST['id']?>">&lt;&lt;back</a></td>
              <td align="left"><input type="submit" name="Save" id="Save" value="Save" class="loginbttn" />
                &nbsp;</td>
            </tr>
          </tbody>
        </table>
	    </form>
	  <?  } 
	  
	  if($show=='view'){
	  $sql="SELECT * FROM ".$cfg['DB_CONST_PRODUCT']." WHERE  pd_id =".$_REQUEST['id']."";
			$res=$mycms->sql_query($sql);
			$row=$mycms->sql_fetchrow($res);
	  
	  ?>
	  <table width="90%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="2" align="left" class="style2">&nbsp;View Product Details Section </td>
            </tr>
          </thead>
          <tbody>
            
            <tr class="row1">
              <td colspan="2" align="right" class="redbuttonelements"><?=@$msg?></td>
            </tr>
            <tr class="row2">
              <td colspan="2" align="right"><a href="const_product_process.php?act=edit&amp;id=<?=$row['pd_id']?>">Edit</a></td>
            </tr>
            
            
			<tr class="row1">
			  <td align="center" valign="top">
			    <table width="100%" height="100%" border="0">
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="leftBarText_new">&nbsp;Product Name</td>
                  <td align="left">&nbsp;<?=$row['pd_name']?></td>
                </tr>
                <tr>
                  <td align="left" class="leftBarText_new">&nbsp;Product Price</td>
                  <td align="left">&nbsp;$ <?=$row['pd_price']?></td>
                </tr>
                <tr>
                  <td width="34%" align="left" class="leftBarText_new">&nbsp;Category</td>
                  <td width="66%" align="left">&nbsp;<?=Constcatname($row['cat_id'])?></td>
                </tr>
				<!--<tr>
				  <td align="left" valign="top" class="leftBarText_new">&nbsp;Product Qty</td>
				  <td align="left" valign="top">&nbsp;<?=$row['pd_qty']?></td>
				  </tr>-->
				
				<tr>
				  <td align="left" valign="top" class="leftBarText_new">&nbsp;Product Description</td>
				  <td align="left" valign="top">&nbsp;<?=stripslashes($row['pd_description'])?></td>
				  </tr>
				
				<tr>
                  <td width="34%" align="left" class="leftBarText_new">&nbsp;Status</td>
                  <td width="66%" align="left">&nbsp;<?=($row['pd_status']=='A')?'Active':'Inactive'?></td>
                </tr>
			  </table></td>
			  <td width="39%" align="center" valign="middle" class="leftBarText_new"><table width="100%" height="100%" border="0">
                <tr>
                  <td align="center" valign="middle">
			<? $sql1="SELECT * FROM ".$cfg['DB_CONST_IMAGE']." WHERE  `pd_id` =".$row['pd_id']."";
			   $res1=$mycms->sql_query($sql1);
				$row1=$mycms->sql_fetchrow($res1);
				if($row1['pd_image']!="")
				{ ?>
				  	<img src="../<?=$cfg['CONST_PRODUCT']?><?=$row1['pd_image']?>" width="190" height="170" />
				<?
				} ?>	
				</td>
                </tr>
				
              </table></td>
			</tr>
			
            
            <tr>
              <td colspan="2" align="center" ><a href="const_product.php?catId=<?=$_REQUEST['catId']?>&proId=<?=$_REQUEST['id']?>">&lt;&lt;back</a></td>
            </tr>
          </tbody>
        </table>
	   
	  <? }?>	  </td>
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
	//session_unregister('categoryId');
	//session_unregister('imgTitle');
	//session_unregister('imgPrice');
	
	unset($_SESSION['categoryId']);
	unset($_SESSION['imgTitle']);
	unset($_SESSION['imgPrice']);
?>