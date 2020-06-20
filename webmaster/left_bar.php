<script type="text/javascript" src="scripts/jquery.min.js"></script>
<script type="text/javascript" src="scripts/ddaccordion.js"></script>
<script type="text/javascript">
	ddaccordion.init({
	headerclass: "expandable", //Shared CSS class name of headers group that are expandable
	contentclass: "categoryitems", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", "openheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["prefix", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
</script>
<div class="arrowlistmenu">
	<?  
	if($_SESSION['admin_login_uid']!="")
	{

		$login_id=$_SESSION['admin_login_uid'];

	}
	if($_REQUEST['login_id']!="")
	{

		$login_id=$_REQUEST['login_id'];

	}

	$sql="SELECT * FROM ".$cfg['DB_WEBMASTER']." WHERE `a_id`=".$login_id.""; 
	$res=$heart->sql_query($sql);
	$row=$heart->sql_fetchrow($res)

	?>
	<h3 class="menuheader expandable">Administration</h3>
	<ul class="categoryitems">
		<li><a href="admin.php">Admin Index</a></li>
		<li><a href="login_details.php">Login History</a></li>
		<li><a href="changpass.php">Change Password</a></li>
		<li><a href="managelogo.php">Manage Site Logo</a></li>
		<li><a href="calculator.php">Calculator</a></li>
		<li><a href="login.php?act=<?=md5("logout")?>">Logout</a></li>
	</ul>
	<? if($cfg['SESSION_SITE']!=3)
	{
		if($row['a_id']==1)
		{
			?>
			<!-- <h3 class="menuheader expandable">Shop Configuration</h3> -->
			<h3 class="menuheader expandable">CMS Configuration</h3>
			<ul class="categoryitems">
				<!-- <li><a href="shop_configuration.php">Manage Shop Configuration</a></li> -->
				<!-- <li><a href="watermark.php">Manage Watermark</a></li> -->
				<!-- <li><a href="notes.php">Manage Notes</a></li> -->
				<!-- <li><a href="disclaimer.php">Manage Disclaimer</a></li> -->
				<li><a href="content.php">Manage Page Content</a></li>
				<li><a href="zone.php">Manage Zone </a></li> 
				 <li><a href="location.php">Manage Location</a></li>
				 <li><a href="country.php">Manage Country</a></li> 
				 <li><a href="state.php">Manage State</a></li>
				<li><a href="city.php">Manage City</a></li>	
				<li><a href="currency_setting.php">Currency  Setting</a></li>
				<li><a href="shipping_type.php">Manage Shipping Type Charges </a></li> 
				
				<li><a href="view_more.php">Manage View More Home Content </a></li>
				<li><a href="homeCounter.php">Manage Home Page Counter</a></li>
				<li><a href="homePageBrandLogo.php">Manage Brand Logo</a></li>
				<li><a href="testimonials.php">Manage Testimonial</a></li>
				<li><a href="homeBanner.php">Manage Home Banner</a></li>
				<li><a href="client.php">Manage Client Section</a></li>
				<li><a href="portfolio.php">Manage Portfolio Section</a></li>
			</ul>

			<h3 class="menuheader expandable">CMS Service Configuration</h3>
			<ul class="categoryitems">
				<li><a href="tech-service.php">Manage Tech-Support</a></li>
				<li><a href="It-services.php">Manage It-Services</a></li>
				<li><a href="computer-training.php">Manage Computer Training</a></li>
			</ul>

			<h3 class="menuheader expandable">Shop Configuration Management</h3>
			<ul class="categoryitems">
				<li><a href="category.php?pId=0">Manage Category</a></li>
				<li><a href="onlineStoreBanner.php">Manage Online Store Banner</a></li>
				<li><a href="onlineStoreContent.php">Manage Online Store Content</a></li>
			</ul>

			<!-- <h3 class="menuheader expandable">Keyword Management</h3>
			<ul class="categoryitems">
				<li><a href="keyword.php">Manage Keyword</a></li>
				<li><a href="category_key.php">Manage Keyword Category</a></li>
			</ul> -->
			<h3 class="menuheader expandable">Product Management</h3>
			<ul class="categoryitems">
				<li><a href="product.php">Manage Product</a></li>
				<!-- <li><a href="addon.php">Manage Addon</a></li> -->
				<!--	<li><a href="cartView.php">View Cart</a></li> -->
				<li><a href="delPincode.php">Manage Delivery Pincodes</a></li>
				<li><a href="revieweb.php">Manage Reviews</a></li>
			</ul>
			<!-- <h3 class="menuheader expandable">Customer Management </h3> -->
			<ul class="categoryitems">
				<li><a href="customer.php">Manage Customer</a></li>
			</ul>
			<h3 class="menuheader expandable">Newsletter Management </h3>
			<ul class="categoryitems">
				<li><a href="newsletter.php">Send Newsletter</a></li>
				<li><a href="mailedNewsletter.php">Mailed Newsletter Content</a></li>
				<li><a href="view_newsletter.php">Manage Newsletter</a></li>
			</ul>
			<!-- <h3 class="menuheader expandable">Vendor Management</h3> -->
			<ul class="categoryitems">
				<li><a href="vendor.php?show=add">Add Vendor</a></li>
				<li><a href="vendor.php">Manage Vendor</a></li>
			</ul>



		<?  	}   ?>


		<h3 class="menuheader expandable">Order Management</h3>
		<ul class="categoryitems">
			<li><a href="order.php">Manage Order</a></li>
			<li><a href="assign_order.php">Assign Orders To Vendor</a></li>
			<li><a href="vendor_order.php">Orders From Vendors</a></li>
		</ul>
		<!-- <h3 class="menuheader expandable">Financial</h3> -->
		<ul class="categoryitems">
			<li><a href="balance.php">Business Sheet</a></li>
			<li><a href="sales_report.php">Sales Report</a></li>
		</ul>
	<!-- 	<h3 class="menuheader expandable">Gallery</h3> -->
		<ul class="categoryitems">
			<li><a href="album.php">Album</a></li>
			<li><a href="gallary.php">gallery</a></li>
		</ul>  
		<h3 class="menuheader expandable">Review</h3>
		<ul class="categoryitems">
			<li><a href="manage-review.php">Manage Review</a></li>

		</ul>  
		<!-- <h3 class="menuheader expandable">Special Message</h3> -->
		<ul class="categoryitems">
			<li><a href="manage-specialmessage.php">Manage Special Message</a></li>

		</ul>  

	<?    }
	?>

	<!--Anindya 03.11.2011-->
	<? if($cfg['SESSION_SITE']==1){?>
  <!--<h3 class="menuheader expandable">Order Management</h3>
  <ul class="categoryitems">
    <li><a href="order.php">Manage Order</a></li>
    <li><a href="express_order.php">Express Order</a></li>
    <li><a href="sales.php">Sales History</a></li>
</ul>-->
<? }?>
  <!--<h3 class="menuheader expandable">Mass Uploading</h3>
  <ul class="categoryitems">
    <li><a href="mass_uploade.php">Uploading Management</a></li>
  </ul>
  <h3 class="menuheader expandable">Banner Management</h3>
  <ul class="categoryitems">
    <li><a href="banner.php">Manage Banner</a></li>
</ul>-->
</div>
