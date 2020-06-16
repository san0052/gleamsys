<?php 
	include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
	page_header($cfg['ADMIN_TITLE']." - Admin Index");
?>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
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
              </span></td>
            <td align="right" valign="middle" class="style5"><? include_once('dropdown.php');?>
              <a href="login.php?act=<?=md5("logout")?>" title="Logout"><img src="images/lock.png" height="24" width="24" border="0" style="vertical-align: middle;"/></a>&nbsp;&nbsp; </td>
          </tr>
          <tr>
            <td height="500" valign="top" colspan="2" align="center" style="background-color:#eee8e8;">&nbsp;
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <h1> 
              <!--  <script language="javascript"  src="ajax.js"></script> -->
                <span class="portalpostheader"> ADMIN INDEX</span> </h1>
              <p>&nbsp;</p>
              <table width="100%" border="0">
                <?	
                $a=date('Y-m-d');
                $sql="SELECT * FROM ".$cfg['DB_ORDER']." WHERE `od_date` ='".$a."' AND `siteId`='".$cfg['SESSION_SITE']."' ";
                $res=$heart->sql_query($sql);
                $maxrow=$heart->sql_numrows($res);
                ?>
                <tr align="center">
                  <td colspan="2"><strong><a href="order.php" style="text-decoration:none; cursor:pointer; color:#005B5B">Today's Total Order:</a>&nbsp;&nbsp;</strong>
                    <?=$maxrow?></td>
                </tr>
                <tr>
                  <td align="center" width="50%">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2"><?php if($maxrow>0){ ?>
                    <table width="90%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
                      <thead>
                        <tr>
                          <td align="left"  class="style2" colspan="2" ><strong>Order Summary:</strong></td>
                        </tr>
                        <tr class="headercontent">
                          <td align="center" width="50%"  class="style2"><strong>Status</strong></td>
                          <td align="center"  class="style2"><strong>Number of Order </strong></td>
                        </tr>
                        <?
 			$sql1="SELECT count(`od_id`),`od_status` FROM ".$cfg['DB_ORDER']." WHERE `od_date` ='".$a."'  AND `siteId`='".$cfg['SESSION_SITE']."' group by `od_status` ";
			$res1=$heart->sql_query($sql1);
			$maxrow1=$heart->sql_numrows($res1);
			$k=0;
			while($row1=$heart->sql_fetchrow($res1)){ 
			$k++;
			?>
                        <? if($k%2==0){?>
                        <tr class="row1">
                          <? } else { ?>
                        <tr class="row2">
                          <? }?>
                          <td align="center"><a href="order.php?status=<?=$row1['od_status']?>&date=<?=date('Y-m-d')?>">Today's
                            <?=$row1['od_status']?>
                            Order</a></td>
                          <td align="center"><?=$row1['count(`od_id`)']?></td>
                        </tr>
                        <? } ?>
                    </table>
                    <? } ?></td>
                </tr>
              </table></td>
          </tr>
          <tr height="16">
            <td colspan="2" style="background:url(images/foot_bg.jpg) center top no-repeat; box-shadow:0 10px 6px -6px #777;">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td colspan="3" align="right"></td>
    </tr>
  </table>
