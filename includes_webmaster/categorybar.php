<script>
/*$(document).ready(function()
{ 
	$("#accordion ul li.parentCategory").click(function()
	{
	   $(this).find("ul").stop(true,true).slideDown(400).parent().siblings("li:not('.selected')").find('ul').slideUp(400);
	},function()
	{ 
		$("li:not('.selected')").find("ul").slideUp(400);
	
	}).siblings('li.selected').find('ul').show();
})*/
$(document).ready(function () {	
	$('#leftCategoryNav li').hover( 
		function(){
			//show its submenu
			$('ul', this).next().slideDown(2000);
		}
	);
});
</script>


<script>
function pSearch()
{
	//alert('parker');
	var min1=document.getElementById('min').value;
	var max1=document.getElementById('max').value;
	//alert(min1);
	//alert(max1);
	if(min1=='')
	{
		alert('Choose minimum price');
		document.getElementById('min').focus();
		return false;
	}
	
	if(max1=='')
	{
		alert('Choose maximum price');
		document.getElementById('max').focus();
		return false;
	}
	
	window.location.href='product.php?act=search&min='+min1+'&max='+max1;
	
//	window.location.href='cart_process.php?act=add&pg='+thispage+'&id='+health_id+'&qty=1&size='+sizep;
}
</script>


<div id="categori">
  <div class="search-price">
    <select class="select-area" style="width:73px;" name="min" id="min">
      <option value="">Min</option>
	  <option value="0">0</option>
	  <option value="500">500</option>
	  <option value="1000">1000</option>
	  <option value="1500">1500</option>
	  <option value="2000">2000</option>
    </select>
    <p style="float:left; line-height:22px;"> &nbsp; to  &nbsp; </p>
    <select class="select-area" style="width:73px;" name="max" id="max">
      <option value="">Max</option>
	  <option value="500">500</option>
	  <option value="1000">1000</option>
	  <option value="1500">1500</option>
	  <option value="2000">2000</option>
	  <option value="above">Above</option>
    </select>
    <input type="button" class="search-btn" value="Search"  onclick=" return pSearch();"/>
    <div class="clr"></div>
  </div>
  
  
  
  
  
  
  
  
  
  
  
  
  <div class="clr"></div>
  <div class="head">Categories</div>
  <div id="leftCategory">
    <?
$sqlcat1="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE  `status`='A' AND `cat_parent_id`=0  AND `siteId` = '".$_SESSION['site']."'ORDER BY `order`";
$rescat1=$heart->sql_query($sqlcat1);
$numcat1 = $heart->sql_numrows($rescat1);
if($numcat1 > 0){ ?>
    <ul id="leftCategoryNav">
      <? while($rowcat1=$heart->sql_fetchrow($rescat1)) { ?>
      <li><a><strong>
        <?=ucwords(stripslashes($rowcat1['name']))?>
        </strong></a>
        <?
	$sqlcat12="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE  `status`='A' AND `cat_parent_id`=".$rowcat1['id']." ORDER BY `order`";
	$rescat12=$heart->sql_query($sqlcat12);
	$numcat12 = $heart->sql_numrows($rescat12);
	if($numcat12 > 0){ ?>
        <ul class="first">
          <? while($rowcat12=$heart->sql_fetchrow($rescat12)) { ?>
          <li><a href="<?=$cfg['base_url']?>product.php?category=<?=$rowcat12['id']?>">
            <?=ucwords(stripslashes($rowcat12['name']))?>
            </a>
            <?
				$sqlcat13="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE  `status`='A' AND `cat_parent_id`=".$rowcat12['id']." ORDER BY `order`";
				$rescat13=$heart->sql_query($sqlcat13);
				$numcat13 = $heart->sql_numrows($rescat13);
				if($numcat13 > 0){ ?>
            <ul class="second">
              <? while($rowcat13=$heart->sql_fetchrow($rescat13)) { ?>
              <li> <a href="<?=$cfg['base_url']?>product.php?category=<?=$rowcat13['id']?>"><? echo ucwords(stripslashes($rowcat13['name'])); ?></a></li>
              <? } ?>
            </ul>
            <?php } ?>
          </li>
          <? } ?>
        </ul>
        <? } ?>
      </li>
      <? } ?>
    </ul>
    <? } ?>
  </div>
  <div class="clr"></div>
  <!--<input type="text" value="Search" class="search-price"  /> -->
  <div class="clr"></div>
</div>
