<style type="text/css">
.sidebarmenu {width:190px; height:auto;float:left; margin-bottom:16px;}

.sidebarmenu .head { width:190px; height:36px; float:left; background:#9d0208; border-radius:8px 8px 0px 0px ;-webkit-border-radius:8px 8px 0px 0px ;-moz-border-radius:8px 8px 0px 0px ;-khtml-border-radius:8px 8px 0px 0px ; }

.sidebarmenu .head h3 {font-size:18px; font-weight:normal; color:#fff; padding:6px 0 0 12px;}

.sidebarmenu .list {width:168px; height:auto; float:left; background:#fff; border-radius:0px 0px 8px 8px ;-webkit-border-radius:0px 0px 8px 8px ;-moz-border-radius:0px 0px 8px 8px ;-khtml-border-radius:0px 0px 8px 8px ; border:1px solid #e7e7e7; min-height:205px; margin:0 0 2px 0; padding:0px 10px 0px 10px;}
.sidebarmenu ul{
margin: 0;
padding: 0;
list-style-type: none;
font:normal 12px/18px Arial, Helvetica, sans-serif; color:#5d5858;
width: 153px; /* Main Menu Item widths */
}
 
.sidebarmenu ul li{
position: relative;
height:24px;
width:153px; margin:0; padding:11px 3px 0 19px; 
border-bottom:1px dashed #cecccc;
 background:url(images/arrow.jpg) no-repeat 0 11px;
}

/* Top level menu links style */
.sidebarmenu ul li a{
display: block;
overflow: auto; /*force hasLayout in IE7 */
font:normal 12px/18px Arial, Helvetica, sans-serif; color:#5d5858;
text-decoration: none;
}
/*background of tabs (default state)*/
/*.sidebarmenu ul li a:link, .sidebarmenu ul li a:visited, .sidebarmenu ul li a:active{
background-color: #fff; 
}

.sidebarmenu ul li a:visited{
font:normal 12px/18px Arial, Helvetica, sans-serif; color:#5d5858;
width:153px; margin:0; padding:0 3px 0 19px;  float:left;

}*/
.sidebarmenu ul li a:hover{
}

/*Sub level menu items */
.sidebarmenu ul li ul{
padding-left:10px;
background-color: #fff; /*background of tabs (default state)*/
position: absolute;
width: auto; /*Sub Menu Items width */
top: 0;
visibility: hidden;
z-index:50000;
font:normal 12px/18px Arial, Helvetica, sans-serif; color:#5d5858;
border:1px solid #e7e7e7;
}
.sidebarmenu a.subfolderstyle{
background: url(right.gif) no-repeat 97% 50%;
}

 
/* Holly Hack for IE \*/
* html .sidebarmenu ul li { float: left; height: 1%; }
* html .sidebarmenu ul li a { height: 1%; }
/* End */

</style>

<script type="text/javascript">

var menuids=["sidebarmenu1"] //Enter id(s) of each Side Bar Menu's main UL, separated by commas

function initsidebarmenu(){
for (var i=0; i<menuids.length; i++){
  var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
    for (var t=0; t<ultags.length; t++){
    ultags[t].parentNode.getElementsByTagName("a")[0].className+=" subfolderstyle"
  if (ultags[t].parentNode.parentNode.id==menuids[i]) //if this is a first level submenu
   ultags[t].style.left=ultags[t].parentNode.offsetWidth+"px" //dynamically position first level submenus to be width of main menu item
  else //else if this is a sub level submenu (ul)
    ultags[t].style.left=ultags[t-1].getElementsByTagName("a")[0].offsetWidth+"px" //position menu to the right of menu item that activated it
    ultags[t].parentNode.onmouseover=function(){
    this.getElementsByTagName("ul")[0].style.display="block"
    }
    ultags[t].parentNode.onmouseout=function(){
    this.getElementsByTagName("ul")[0].style.display="none"
    }
    }
  for (var t=ultags.length-1; t>-1; t--){ //loop through all sub menus again, and use "display:none" to hide menus (to prevent possible page scrollbars
  ultags[t].style.visibility="visible"
  ultags[t].style.display="none"
  }
  }
}

if (window.addEventListener)
window.addEventListener("load", initsidebarmenu, false)
else if (window.attachEvent)
window.attachEvent("onload", initsidebarmenu)

</script>
<div id="left">

<div class="sidebarmenu">
<div class="head">
 <h3>Categories</h3>
</div>
<div class="list">
<ul id="sidebarmenu1">
<li><a href="product.php?category=0&price=<?=($_REQUEST['price']!='')?$_REQUEST['price']:'0'?>&brand=<?=($_REQUEST['brand']!='')?$_REQUEST['brand']:'0'?>" style="text-decoration:none;">All Category</a></li>
<?
$sql_category="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `status`='A' AND `cat_parent_id`='0'";
$res_category=$mycms->sql_query($sql_category);
$maxrow_category=$mycms->sql_numrows($res_category);
if($maxrow_category>0)
{
	while($row_category=$mycms->sql_fetchrow($res_category))
	{
	if(count(getCategories($cfg['DB_CATEGORY'],$row_category['id']))>0){
?>
<li><a href="product.php?category=<?=$row_category['id']?>&price=<?=($_REQUEST['price']!='')?$_REQUEST['price']:'0'?>&brand=<?=($_REQUEST['brand']!='')?$_REQUEST['brand']:'0'?>" style="text-decoration:none;"><?=ucwords($row_category['name'])?></a>
<ul>
<?
$sql_sub="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `status`='A' AND `cat_parent_id`='".$row_category['id']."'";
$res_sub=$mycms->sql_query($sql_sub);
$maxrow_sub=$mycms->sql_numrows($res_sub);
if($maxrow_sub>0)
{
	$subcount=1;
	while($row_sub=$mycms->sql_fetchrow($res_sub))
	{
?>
<li><a href="product.php?category=<?=$row_sub['id']?>&price=<?=($_REQUEST['price']!='')?$_REQUEST['price']:'0'?>&brand=<?=($_REQUEST['brand']!='')?$_REQUEST['brand']:'0'?>"><?=ucwords($row_sub['name'])?></a></li>
<? $subcount++;
	}
} ?>
</ul>
</li>
<?		}
		else
		{?>
			<li><a href="product.php?category=<?=$row_category['id']?>&price=<?=($_REQUEST['price']!='')?$_REQUEST['price']:'0'?>&brand=<?=($_REQUEST['brand']!='')?$_REQUEST['brand']:'0'?>" style="text-decoration:none;"><?=ucwords($row_category['name'])?></a></li>
	<?	} 
	}
} ?>
</ul>
</div>
</div>
        
   <div class="categories">
            	<div class="head">
                <h3>Price Range</h3>
                </div>
                
                <div class="list">
                	<ul>
					 <li><a href="product.php?price=0&category=<?=($_REQUEST['category']!='')?$_REQUEST['category']:'0'?>&brand=<?=($_REQUEST['brand']!='')?$_REQUEST['brand']:'0'?>">All Price Range</a></li>
                    <li><a href="product.php?price=<500&category=<?=($_REQUEST['category']!='')?$_REQUEST['category']:'0'?>&brand=<?=($_REQUEST['brand']!='')?$_REQUEST['brand']:'0'?>">Below Rs. 500</a></li>
                    <li><a href="product.php?price=500-750&category=<?=($_REQUEST['category']!='')?$_REQUEST['category']:'0'?>&brand=<?=($_REQUEST['brand']!='')?$_REQUEST['brand']:'0'?>">Rs. 500 to Rs. 750</a></li>
                    <li><a href="product.php?price=750-1250&category=<?=($_REQUEST['category']!='')?$_REQUEST['category']:'0'?>&brand=<?=($_REQUEST['brand']!='')?$_REQUEST['brand']:'0'?>">Rs. 750 to Rs. 1250</a></li>
                    <li><a href="product.php?price=1250-1750&category=<?=($_REQUEST['category']!='')?$_REQUEST['category']:'0'?>&brand=<?=($_REQUEST['brand']!='')?$_REQUEST['brand']:'0'?>">Rs. 1250 to Rs. 1750</a></li>
                    <li><a href="product.php?price=1750-2150&category=<?=($_REQUEST['category']!='')?$_REQUEST['category']:'0'?>&brand=<?=($_REQUEST['brand']!='')?$_REQUEST['brand']:'0'?>">Rs. 1750 to Rs. 2150</a></li>
                    <li class="last"><a href="product.php?price=>2150&category=<?=($_REQUEST['category']!='')?$_REQUEST['category']:'0'?>&brand=<?=($_REQUEST['brand']!='')?$_REQUEST['brand']:'0'?>">Above Rs. 2150</a></li>
                    </ul>
                </div>
            
            </div> 
    		<div class="categories"><!--brands-->
            	<div class="head">
                <h3>Brands</h3>
                </div>
                
                <div class="list"><!--namebrand-->
                	<ul>
					<li><a href="product.php?brand=0&category=<?=($_REQUEST['category']!='')?$_REQUEST['category']:'0'?>&price=<?=($_REQUEST['price']!='')?$_REQUEST['price']:'0'?>">All Brands</a></li>
					<? $sql_brand="SELECT * FROM ".$cfg['DB_BRAND']." WHERE `status`='A' AND `displayStatus`='Yes'";
						$res_brand=$mycms->sql_query($sql_brand);
						$max_brand=$mycms->sql_numrows($res_brand);
						if($max_brand>0)
						{
						$i=1;
						while($row_brand=$mycms->sql_fetchrow($res_brand))
						{?>
                    <li><a href="product.php?brand=<?=$row_brand['id']?>&category=<?=($_REQUEST['category']!='')?$_REQUEST['category']:'0'?>&price=<?=($_REQUEST['price']!='')?$_REQUEST['price']:'0'?>" <? if($i==$max_brand){?> class="last" <? } ?>><?=$row_brand['name']?></a></li>
					<? $i++;
						}
					} ?>
					 <li class="last"><a href="all-brand.php">View All Brand</a></li>
                    </ul>
                </div>
            
            </div> 
    
        </div>
        