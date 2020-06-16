<script>
function clearText(thefield){
if (thefield.defaultValue==thefield.value)
thefield.value = ""
}
</script>
<?
error_reporting(0);
$_SESSION['site']=2;
//include_once('../includes/links.php');
//include_once('../includes/admininit.php');
	
$logo="select * from".$cfg['DB_LOGO']."where `siteId`='".$_SESSION['site']."' and `status`='A'";
$logo_r=$heart->sql_query($logo);
$logo_row=$heart->sql_fetchrow($logo_r);
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?
	if(getCurrentPageName()=='about.php'){
?>
	<title>:: About Us ::</title>
<?
	}
	else if(getCurrentPageName()=='disclaimer.php')
	{	
?>
		<title>:: Disclaimer ::</title>
<?
	}
	else if(getCurrentPageName()=='privacy.php')
	{
?>
		<title>:: Privacy Policy ::</title>
<?
	}
	else if(getCurrentPageName()=='refund.php')
	{
?>
		<title>:: Refund Policy ::</title>
<?
	}
	else if(getCurrentPageName()=='termscondition.php')
	{
?>
		<title>:: Terms & Condition ::</title>
<?
	}
	else if(getCurrentPageName()=='contact.php'){
?>
		<title>:: Contact Us ::</title>
<?
	}
	else if(getCurrentPageName()=='details.php')
	{
?>
		<title>:: Product Details ::</title>
<?		
	}
	else {
?>
		<link rel="shortcut icon" href="http://www.rainbowfloristworld.com/images/favicon.ico" type="image/x-icon">
		<title>:: Rainbow Florist ::</title>

<?
	}
?>


<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<link rel="stylesheet" href="css/style.css" type='text/css' media="all" />
<link rel="stylesheet" href="css/bootstrap.css" type='text/css' media="all" />
<!--<link rel="stylesheet" href="css/bootstrap.min.css" type='text/css' media="all" />
<link rel="stylesheet" href="css/bootstrap-theme.css" type='text/css' media="all" />
<link rel="stylesheet" href="css/bootstrap-theme.min.css" type='text/css' media="all" />-->

<!--------- Slider -------->
<script src="themes/1/js-image-slider.js" type="text/javascript"></script>
<!--------- Slider -------->

<script type="text/javascript">
	function search_submit(){
		$('#quick_search').submit();
	}
</script>
<script type="text/javascript" src="js/scriptbreaker-multiple-accordion-1.js"></script>
<script language="JavaScript">
	$(document).ready(function() {
		$(".topnav").accordion({
			accordion:false,
			speed: 500,
			closedSign: '[+]',
			openedSign: '[-]'
		});
	});
</script> 
</head>
<body>

<!-- Header -->
<header>	
	<article>
		<div class="container" id="mn_body">
			<div class="row">
				<div class="col-md-3">			
					<h1 class="logo"><a href="<?=$cfg['base_url_v']?>index.php"><!--<img src="../images/logo.png" alt="" border="0" />--><img src="<?=$cfg['base_url']?><?=$cfg['DIR_LOGO']?><?=$logo_row['l_image']?>" alt="" border="0" /></a></h1>
				</div>
				<div class="col-md-9">
					<div class="header_right_details">
						<div class="top_row">
							<ul>
								<?php if($_SESSION['userid']==''){?>
								<li class="login"><a href="login-register.php" title="Create new Account">Create Account</a>&nbsp;|&nbsp;<a href="login-register.php" title="Login">Login</a>&nbsp;|&nbsp;<a href="<?=$cfg['base_url_v'].'Instant-order.php'?>">Instant-Pay</a><!--&nbsp;|&nbsp;<a href="trackorder.php" title="track">Track Order</a>--></li>
								<?php } if($_SESSION['userid']!=''){?>
								<li class="login"><a href="my_account.php">My Account</a>&nbsp;|&nbsp;<a href="login_process.php?action=logout">Logout</a>&nbsp;|&nbsp;<a href="<?=$cfg['base_url_v'].'Instant-order.php'?>">Instant-Pay</a>&nbsp;|&nbsp;<!--<a href="trackorder.php" title="track">Track Order</a></li>-->
								<?php } ?>
								<li class="follow"><a href="http://www.facebook.com"><div class="fb"></div></a><a href="http://www.twitter.com"><div class="twtr"></div></a></li>
								<li class="need_help"><strong>Call +91-9820561649,  +91-7666609786</strong></li>
								<li class="delivery_car"><img src="images/fast_delivery_icon.png" alt="" /></li>
							</ul>
							<div class="clear"></div>							
						</div>						
						<div class="bottom_row">
							<div class="top_txt">Flowers &amp; Cake Delivery in <span class="brown">Navi Mumbai</span><br>
							<a href="sameday_terms&conditions.php"><font color="FF00CC">Same day Delivery Option Available</font></a></div>
							<div class="search_fld_body">
								<form id="quick_search" action="product.php" method="post" >
								<input type="hidden" name="category" id="search_cat" value="SEARCHBYKEYWORD">
								<input type="text" id="original_cat" name="qsearch" placeholder="Search for a product, category or brand" class="search_fld" value="">
								<input type="image" src="<?=$cfg['base_url_v']?>images/search_icon.png" name="submit" value="" class="search_icon" onClick="search_submit();">
								</form>
							</div>
								<?		
								$cartContent = getCartContent();
								$numItem = count($cartContent);
							 ?>
							<div class="cart_item_body">
								<a href="add-cart.php#main">
								<div class="cart_icon"><img src="<?=$cfg['base_url_v']?>images/cart_bag_icon.png" alt="" /></div>
								<div class="cart_items">Bag (<?php echo $numItem;?>)</div>
								</a>
							</div>
							<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="menu_body">
					<div class="menu">
						<ul>
							<li><a href="<?=$cfg['base_url_v']?>">Home</a>
						 <!--<ul>
									<li><a href="<?=$cfg['base_url_v'].'Instant-order.php'?>">Instant-Pay</a></li>
								</ul>
							</li>-->
							<!--<li><a href="<?=$cfg['base_url_v']?>product.php?category=141#main" onClick="lisTrans(223);"><?="Deepavali";?></a></li>-->
							<?
							$sql="SELECT * FROM ".$cfg['DB_CATEGORY']."  WHERE `cat_parent_id`='0' AND `status`='A' AND `show_in_top_menu`='Y' ORDER BY `order`";
							$res=$heart->sql_query($sql);
							$maxrow=$heart->sql_numrows($res);
							if($maxrow >0){
								while($row=$heart->sql_fetchrow($res)){			
							?> 
							<li>
								<a href="<?=($row['id']==225)?'city_list.php#main':'#' ?>" class="dropdown-toggle" data-toggle="dropdown">
									<?=ucwords(strtolower(stripslashes($row['name'])))?>
									<b class="caret"></b>
								</a>
								<? 
									if($row['id']!=225){
								?>
								<ul>
								<?
									$sql_s="SELECT * FROM ".$cfg['DB_CATEGORY']."  WHERE `cat_parent_id`='".$row['id']."' AND `status`='A' ORDER BY `order`";
									$res_s=$heart->sql_query($sql_s);
									$maxrow_s=$heart->sql_numrows($res_s);			
									if($maxrow_s>0){
										while($row_s=$heart->sql_fetchrow($res_s)){
								?>	
										<li>
											<a href="<?=$cfg['base_url_v']?>product.php?category=<?=$row_s['id']?>#main" onClick="lisTrans(<?=$row_s['id']?>);">
												<?=stripslashes($row_s['name'])?>
											</a>
										</li>
								<? 
								}
							} 
							?>
							</ul>
							<? 
								} 
							?>
							</li>
							<?         
								}
							}
							?>
							<li>
								<a href="javascript:void(0);"><?=("Shop By Price")?><b class="caret"></b></a>
								<?
									$sql_price = "SELECT * FROM ".$cfg['DB_PRICERANGE']." WHERE `status`='A'";
									$res_price = $heart->sql_query($sql_price);
									$num_price = $heart->sql_numrows($res_price);
									if($num_price > 0){
								?>
								<ul>
									<?    
									while($row_price=$heart->sql_fetchrow($res_price)){
									?>	
										<li><a href="<?=$cfg['base_url_v']?>product.php?category=PRICE&id=<?=$row_price['id']?>#main"><?=ucwords(stripslashes($row_price['range_name']))?></a></li>
									<?
									}
									?>
								</ul>
								<? 
							}
							?>
							</li>
							<li><a href="<?=$cfg['base_url_v']?>product.php?category=ZONE&id=25#main"><?=("Mumbai Special")?></a></li>
							<li><blink><a href="<?=$cfg['base_url_v']?>product.php?category=141#main" style="color:#ff0000; font-weight:bold;"><?=("Diwali")?></a></blink></li>
							<!--<li><a href="<?=$cfg['base_url_v']?>contact_us.php"><?=("Contact Us")?></a></li>-->
						</ul>	
						<div class="clearfix"></div>			
					</div>
					<div class="menu_list_body">
					<div class="hdng">
						<div class="text">Select Menu</div>
						<img src="images/short_menu_icon.png" class="menu_icon" onClick=" $('#menulist').animate({ height: 'toggle',opacity: 'toggle'}, 500 );"/>
					<div class="clear"></div>
					</div>
					
					<div id="menulist" class="menu_list" style="display:none;">
						<ul class="topnav">
							<li class="sub_menu"><a href="<?=$cfg['base_url_v']?>">Home</a></li>
							<li class="sub_menu"><a href="<?=$cfg['base_url_v']?>product.php?category=223#main"><?="Deepavali";?></a></li>
							<?
							$sql="SELECT * FROM ".$cfg['DB_CATEGORY']."  WHERE `cat_parent_id`='0' AND `status`='A' AND `show_in_top_menu`='Y' ORDER BY `order`";
							$res=$heart->sql_query($sql);
							$maxrow=$heart->sql_numrows($res);
							if($maxrow >0){
								while($row=$heart->sql_fetchrow($res)){			
							?> 
							<li class="sub_menu"><a href="<?=($row['id']==225)?'city_list.php#main':'#' ?>"><?=ucwords(strtolower(stripslashes($row['name'])))?></a>
								<? 
									if($row['id']!=225){
								?>
								<ul class="subul">
									<?
									$sql_s="SELECT * FROM ".$cfg['DB_CATEGORY']."  WHERE `cat_parent_id`='".$row['id']."' AND `status`='A' ORDER BY `order`";
									$res_s=$heart->sql_query($sql_s);
									$maxrow_s=$heart->sql_numrows($res_s);			
									if($maxrow_s>0){
										while($row_s=$heart->sql_fetchrow($res_s)){
								?>	
									<li>
										<a href="<?=$cfg['base_url_v']?>product.php?category=<?=$row_s['id']?>#main" onClick="lisTrans(<?=$row_s['id']?>);">
											<?=stripslashes($row_s['name'])?>
										</a>
									</li>
									<? 
										}
									} 
							?>
								</ul>
								<? 
								} 
							?>
							</li>
							<?         
								}
							}
							?>							
							<li class="sub_menu"><a href="javascript:void(0);"><?=("Shop By Price")?></a>
								<?
									$sql_price = "SELECT * FROM ".$cfg['DB_PRICERANGE']." WHERE `status`='A'";
									$res_price = $heart->sql_query($sql_price);
									$num_price = $heart->sql_numrows($res_price);
									if($num_price > 0){
								?>
								<ul class="subul">
									<?    
									while($row_price=$heart->sql_fetchrow($res_price)){
									?>	
										<li><a href="<?=$cfg['base_url_v']?>product.php?category=PRICE&id=<?=$row_price['id']?>#main"><?=ucwords(stripslashes($row_price['range_name']))?></a></li>
									<?
									}
									?>
								</ul>
								<? 
							}
							?>
							</li>
							<li class="sub_menu"><a href="<?=$cfg['base_url_v']?>product.php?category=ZONE&id=25#main"><?=("Mumbai Special")?></a></li>
							<div class="clearfix"></div>
						</ul>
					</div>
				</div>
				</div>					
			</div>
			
			
			<div class="row">
				<div class="scroll_body">
					<div class="col-md-12">			
						<div class="scroll_txt red">
							<marquee behavior="scroll" scrolldelay="1" scrollamount="3" onMouseOver="this.stop();" onMouseOut="this.start();">
								Send Flowers to Mumbai , Send Flower & Cake To Navi Mumbai, Send Flowers & Gifts To Delhi Ncr,								Send Flowers & Gift to Chennai,Send Flowers & Gift to Baroda , Send Flowers & Gift to Pune ,								Send Flowers & Gift To Thane ,Send Flowers & Gift To Hyderabad , Send Flowers & Gift To Bangalore,							    Same day flowers delivery 350 Cities India.
							</marquee>
						</div>
					</div>
				</div>
			</div>	
		</div>			 
	</article>
</header>
<!-- end Header -->