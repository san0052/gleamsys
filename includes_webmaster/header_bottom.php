<?
$location = ($_REQUEST['location']!='')?getlocationname($_REQUEST['location']):'';
?>
<!-- AUTOCOMPLETE -->
<link rel="stylesheet" href="css/autosuggest.css" type="text/css" media="screen">
<script type="text/javascript" language="javascript" src="js/ajax.js"></script>
<script type="text/javascript" language="javascript" src="js/tools.js"></script>
<script type="text/javascript" language="javascript" src="js/autosuggest.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" language="javascript" src="js/jsddm.js"></script>
<!-- END AUTOCOMPLETE -->
<script>
function gotolocation(){
if(document.getElementById("loc").value=='')
{
	alert("Choose Product Name");
	document.loc.focus();
	return false;
}

if(document.getElementById("loc").value=='Choose Product Name')
{
	alert("Choose Product Name");
	document.loc.focus();
	return false;
}

var loc = document.getElementById("loc").value;
window.location.href='product_process.php?location='+loc;
}
function gotoprice()
{
	if(document.getElementById("price").value==0)
	{
	alert("Choose a price range from the list");
	document.price.focus();
	return false;
}
var loc = document.getElementById("price").value;
window.location.href='product_process.php?price='+price;
}
</script>
<script type="text/javascript" src="js/jquery-1.2.3.min.js"></script>
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<!--<script language="JavaScript" type="text/javascript" src="js/validation.js"></script>-->
<script language="JavaScript" type="text/javascript" src="js/customer.js"></script>
<script type="text/javascript">
$(document).ready(function () {	
	$('#menu1 li').hover( 
		function () {
			//show its submenu
			$('ul', this).next().slideDown(200);
		}
	);
});
	</script>
<?php /*?><script type="text/javascript" language="javascript" src="js/rupee.js"></script><?php */?>
<div id="nav_section">
  <div id="nav">
    <div style="float:left;"> <a href="<?=$cfg['base_url']?>" class="first"><img src="images/home.png" style="margin:5px 0 0 0;" alt="" /></a> </div>
    <? 
	$sql = "SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `status`='A' AND `cat_parent_id` = '0' AND `show_in_top_menu` =  'Y'";
	$res=$heart->sql_query($sql);
	$maxrow=$heart->sql_numrows($res);
	 if($maxrow >0){ 
?>
    <ul id="menu1">
      <?
		while($row_hover=$heart->sql_fetchrow($res)){
			 @$i++;
			 ?>
      <li><a href="#"><?=ucwords($row_hover['name']);?></a>
        <ul>
          <?
	$sqlcat12="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE  `status`='A' AND `cat_parent_id`=".$row_hover['id']." ORDER BY `order`";
	$rescat12=$heart->sql_query($sqlcat12);
	$numcat12 = $heart->sql_numrows($rescat12);
	if($numcat12 > 0){ 
while($rowcat12=$heart->sql_fetchrow($rescat12)) { ?>
          <li> <a href="<?=$cfg['base_url']?>product.php?category=<?=$rowcat12['id']?>" >
            <? 
echo ucwords(stripslashes($rowcat12['name'])); ?>
            </a>
            <ul>
              <?
	$sqlcat13="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE  `status`='A' AND `cat_parent_id`=".$rowcat12['id']." ORDER BY `order`";
	$rescat13=$heart->sql_query($sqlcat13);
	$numcat13 = $heart->sql_numrows($rescat13);
	if($numcat13 > 0){ 
while($rowcat13=$heart->sql_fetchrow($rescat13)) { ?>
              <li> <a href="<?=$cfg['base_url']?>product.php?category=<?=$rowcat13['id']?>">
                <? 
echo ucwords(stripslashes($rowcat13['name'])); ?>
                </a></li>
              <? } } ?>
            </ul>
          </li>
          <?
}
}
?>
        </ul>
      </li>
      <? } }?>
	   <li style="margin:0px 5px 0px 5px;"><a href="<?=strip_tags(pagecontent(99))?>" title="<?=strip_tags(pagecontent(99))?>"><?=cmsName(99)?></a></li>
	    <li style="margin:0px 5px 0px 5px;"><a href="<?=strip_tags(pagecontent(98))?>" title="<?=strip_tags(pagecontent(98))?>"><?=cmsName(98)?></a></li>   
    </ul>
    <a href="cart.php"><img src="images/cart1.png"  title="cart" style="margin-top:5px;" height="20" width="20"  align="absmiddle" /></a>
    
    <div id="search">
      <input type="hidden" name="loc_id" id="loc_id" value="" />
      <input name="loc" id="loc" type="text" value="<? if($location!=''){?><?=$location?><? }else{?>Choose Product Name<? }?>" onblur="if(this.value=='') this.value='Choose Product Name';" onfocus="if(this.value=='Choose Product Name') this.value='';"  class="input-text"  onkeyup="autoSuggest(this.id, 'listWrap', 'searchList', 'loc', event);" onkeydown="keyBoardNav(event, this.id);" />
      <input type="button" class="button" onclick="gotolocation();" style="cursor:pointer;" />
      <div class="listWrap" id="listWrap" style="color:#5CB60C; ">
        <ul class="searchList" id="searchList">
        </ul>
      </div>
    </div>
    <div id="login">
      <ul>
        <? if($_SESSION['userid']!=''){?>
        <li><a href="login_process.php?action=logout" title="Log Out"><span><img src="images/logout.png" alt="" /></span></a></li>
        <!--<li><a href="cart.php" title="My Cart"><span><img src="images/cart.png" alt="" /></span></a></li>
        <li><a href="order_details.php" title="Order Details"><span><img src="images/orderdetails.png" alt="" /></span></a></li>-->
        <li><a href="my_account.php" title="My Account"><span><img src="images/account.png" alt="" /></span></a></li>
        
        <? } if($_SESSION['userid']==''){?>
        <li><a href="login.php" ><span><img src="images/login.png" alt="" /></span>Log in</a></li>
        <li><a href="login.php#register" ><span><img src="images/register.png" alt="" /></span>Register</a></li>
        <? } ?>
      </ul>
    </div>
    <!-- End Login Div -->
  </div>
</div>
