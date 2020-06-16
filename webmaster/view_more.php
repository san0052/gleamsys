<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
//include('../includes/template.php');

if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}
if($_REQUEST['m']==3) { $msg='Record Deleted';}
if($_REQUEST['m']==4) { $msg='Order Updated';}
if($_REQUEST['m']==9) { $msg='Content should not be blank';}

page_header($cfg['ADMIN_TITLE']." - View More Management");
$category=($_REQUEST['category']!="")?$_REQUEST['category']:'';
$pageno =($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0';
$show=$_REQUEST['show'];
?>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="scripts/common.js"></script>
<script language="javascript" src="scripts/pincode.js"></script>
<script language="javascript" src="scripts/ajax.js"></script>
<script language="javascript" src="scripts/ajax1.js"></script>
<script language="javascript" src="scripts/ckeditor/ckeditor.js"></script>

<script language="javascript" type="text/javascript">

</script>
<script type="text/javascript" src="scripts/jquery.min.js"></script>
<script type="text/javascript" src="scripts/ddaccordion.js"></script>
<style type="text/css">
<!--
.style3 {
	color: #FFFFFF
}
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
			<?
			 	$sql="SELECT * FROM ".$cfg['DB_SITE']."";
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
	   if($_REQUEST['show']==''){
	   ?>
              <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
                <thead>
                  <tr>
                    <td colspan="4" align="left">&nbsp;<span class="style2">View More Section</span>&nbsp;</td>
                    <td colspan="9" align="right">
					<form name="frmsearch" id="frmsearch" action="shipping_type.php" method="post">
                        <input type="hidden" name="category" id="category" value="<?=$_REQUEST['category']?>" />
                        <input type="hidden" name="searchname" id="searchname" value="search" />
                        <input type="text" name="search_val" id="search_val" class="forminputelement" value="<?=$_REQUEST['search_val']?>" />
                        &nbsp;
                        <input type="submit" name="prodsearch"  class="loginbttn" value="Go" />
                      </form></td>
                  </tr>
                </thead>
                <form name="frm1" id="frm1" action="shipping_type_process.php" method="post">
                  <input type="hidden" name="act" id="act" value="order" />
                  <input type="hidden" name="cat_returnid" id="cat_returnid" value="<?=$_REQUEST['category']?>" />
                  <? $pageno=($_REQUEST['pageno']!='')?$_REQUEST['pageno']:'0'; ?>
                  <input type="hidden" name="pageno" id="pageno" value="<?=$pageno?>" />
                  <tbody>
                    <? if($_REQUEST['m']){ ?>
                    <tr class="row1">
                      <td colspan="12" align="right" class="redbuttonelements"><?=@$msg?></td>
                    </tr>
                    <? } ?>
                    <tr class="headercontent">
                      <td width="8%" align="center" class="leftBarText_new1">Sl No </td>
                      <td width="8%" align="center" colspan="6" class="leftBarText_new1">Title </td>
                      <td align="center" colspan="2" class="leftBarText_new1">Decription</td>
                      <td align="center" colspan="4" class="leftBarText_new1">Action</td>
                    </tr>
    <?  if($_REQUEST['category']!='')
	    {
		  		$search_query="AND `category`=".$_REQUEST['category']."";
		}
		else
		{
				
		  		$search_query='';
		  
		}
		if(isset($_REQUEST['prodsearch']))
		{
				if($_REQUEST['searchname']=='search')
				{
			  			$sql="SELECT * FROM ".$cfg['DB_SHIPPING_TYPE']." WHERE  (`name` LIKE '%".$_REQUEST['search_val']."%' OR `amount` LIKE '%".$_REQUEST['search_val']."%') ".$search_query;
				}
		}
		else
		{
			 $sql="SELECT * FROM ".$cfg['DB_HOME_VIEWMORE']." WHERE `status`='A' ORDER BY `id` ASC";
		}
		$res=$heart->sql_query($sql);
		$maxrow=$heart->sql_numrows($res);
		if(!isset($_REQUEST['prodsearch']))
		{
			 $sql = $sql. " LIMIT $offset,$limit";
			 $res = $heart->sql_query($sql);
		}
		if($maxrow >0)
		{
			 while($row=$heart->sql_fetchrow($res)){
			 @$i++;
		?>
				<tr class="<?=($i%2==0)?'row1':'row2'?>">
				  <td align="center" valign="top"><?=$i+$offset?></td>
				  <td align="center" colspan="6" valign="top"><?=$row['name']?></td>
				  <td align="center" colspan="2" valign="top"><?=$row['desc1']?></td>
				  <td align="center" colspan="4" valign="top">
					<a href="view_more.php?show=edit&id=<?=$row['id']?>&pageno=<?=$pageno?>"><img src="images/edit.gif" title="Edit" width="16" height="16" border="0" /></a>
					</td>
					
				</tr>
	<? }
	   } 
	   else 
	   {?>
                <tr class="row1">
                      <td colspan="12" align="center" class="msg">No Record.</td>
                    </tr>
	<? } ?>
</tbody>
                </form>
              </table>
              <div style="width:90%; text-align:right;">
                <? if(!isset($_REQUEST['prodsearch'])){ ?>
                <?=$heart->paginate($maxrow, $limit, $pageno, "pageno", "link")?>
                <? } ?>
              </div>
              <? }
	  
	  /* end brand */

		
	  // edit customer details
	  if($show=='edit'){
	  
	  		$sql1="SELECT * FROM ".$cfg['DB_HOME_VIEWMORE']." WHERE  `id` =".$_REQUEST['id']." ";
			$res1=$heart->sql_query($sql1);
			$row1=$heart->sql_fetchrow($res1);

	  ?>
              <form name="frmedit" method="post" action="view_more_process.php" id="frmedit" enctype="multipart/form-data" onsubmit="return product_edit(this)">
                <p>
                  <input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>" />
                  <input type="hidden" name="act" value="update" />
                  <input type="hidden" name="id" value="<?=$row1['id']?>" />
                  <input type="hidden" name="prod_edit_valid" value=""  id="prod_edit_valid"/>
                  <input type="hidden" name="type_check_edit" value=""  id="type_check_edit"/>
                </p>
                <table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">

                  <thead>
                    <tr>
                      <td colspan="5" align="left" class="style2">&nbsp;Edit View More Section </td>
                    </tr>
                  </thead>
                  <tbody>
                    <? if($_REQUEST['m']){ ?>
                    <tr class="row2">
                      <td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
                    </tr>
                    <? } ?>
                    </tr>

              <tr class="row1">
                  <td class="leftBarText" align="left" valign="top"> <span class="leftBarText_new">Title</span> <span class="redstar">*</span></td>
                  
                  <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
                </tr>
                <tr class="row2">
                     <td colspan="2" align="left">
                    <textarea name="title"  class="forminputelement" cols="80" id="title" /><?=stripslashes($row1['name'])?></textarea>
                     <!--  <script>
                        CKEDITOR.replace( 'title' );
                    </script> -->
                    </td>
                </tr>
                
                <tr class="row1">
                  <td class="leftBarText" align="left" valign="top"> <span class="leftBarText_new">Description</span> <span class="redstar">*</span></td>
                  
                  <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
                </tr>
                <tr class="row2">
                     <td colspan="2" align="left">
                    <textarea rows="4" cols="50" name="desc1"  class="forminputelement" cols="80" id="desc1" /><?=stripslashes($row1['desc1'])?></textarea>
                      <script>
                        CKEDITOR.replace( 'desc1' );
                    </script>
                    </td>
                </tr>  
                    <tr>
                    
                      <td colspan="4" align="center">
						<a class="brownbttn" href="shipping_type.php?category=<?=$_REQUEST['category']?>&page=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?><? if($row1['mainaddon']!=0){?>&main=<?=$row1['mainaddon']?><? } ?>" class="back">&lt;&lt;back</a>
						<input type="submit" name="Save" id="Save" value="Save" class="loginbttn">
                     </td>
                    </tr>
                    </thead>
                    
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
<?

?>