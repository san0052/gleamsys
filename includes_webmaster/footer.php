<!-- footer -->
<footer>	
	<article>
		<div class="container" id="footer_body">
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-6">			
					<div class="footer_list">
						<ul>
							<li class="hdng">Most Popular Categories</li>
							<?
							$sql_s="SELECT * FROM ".$cfg['DB_CATEGORY']."  WHERE `cat_parent_id`='140' AND `status`='A' ORDER BY `order` limit 0,7";
							$res_s=$heart->sql_query($sql_s);
							$maxrow_s=$heart->sql_numrows($res_s);			
							if($maxrow_s>0){
								while($row_s=$heart->sql_fetchrow($res_s)){
							?>	
							<li><a href="<?=$cfg['base_url_v']?>product.php?category=<?=$row_s['id']?>#main"><?=ucwords(stripslashes($row_s['name']))?></a></li>
							<?php
									}
								}
							?>
							
						</ul>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6">			
					<div class="footer_list">
						<ul>
							<li class="hdng">Information & Services</li>
							<li><a href="about.php">About us</a></li>
							<li><a href="disclaimer.php">Disclaimer</a></li>
							<li><a href="privacy.php">Privacy Policy</a></li>
							<li><a href="refund.php">Refund Policy</a></li>
							<li><a href="termscondition.php">Terms & Conditions</a></li>
							<li><a href="contact_us.php">Contact us</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6">			
					<div class="footer_list">
						<ul>
							<li class="hdng">Delivery Top City's</li>
							<li><a href="product.php?category=SEARCHBYKEYWORD&qsearch=<?=str_replace('++','+',urlencode(trim('Send Flowers & Gift to Mumbai')))?>">Mumbai</a></li>
							<li><a href="product.php?category=SEARCHBYKEYWORD&qsearch=<?=str_replace('++','+',urlencode(trim('Send Flowers & Gift to Hyderabad')))?>">Hyderabad</a></li>
							<li><a href="product.php?category=SEARCHBYKEYWORD&qsearch=<?=str_replace('++','+',urlencode(trim('Send Flowers & Gift to Chennai')))?>">Chennai</a></li>
							<li><a href="product.php?category=SEARCHBYKEYWORD&qsearch=<?=str_replace('++','+',urlencode(trim('Send Flowers & Gift to Kolkatta')))?>">Kolkata</a></li>
							<li><a href="product.php?category=SEARCHBYKEYWORD&qsearch=<?=str_replace('++','+',urlencode(trim('Send Flowers & Gift to Delhi')))?>">Delhi</a></li>
							<li><a href="product.php?category=SEARCHBYKEYWORD&qsearch=<?=str_replace('++','+',urlencode(trim('Send Flowers & Gift to Bangalore')))?>">Bangalore</a></li>
							<li><a href="product.php?category=SEARCHBYKEYWORD&qsearch=<?=str_replace('++','+',urlencode(trim('Send Flowers & Gift to Bhubaneswar')))?>">Bhubaneswar</a></li>
						</ul>
					</div>
				</div>
				<!--<div class="col-md-3 col-sm-3 col-xs-6">			
					<div class="footer_list" style="border-right:none;">
						<ul>
							<li class="hdng">My Account</li>
							<li><a href="#">View Profile</a></li>
							<li><a href="#">Edit Profile</a></li>
							<li><a href="#">Wishlist Page</a></li>
							<li><a href="#">Shipping Information</a></li>
							<li><a href="#">Order Summary</a></li>
						</ul>
					</div>
				</div>-->
			</div>
			<div class="clearfix"></div>
			<div class="row">
				<div class="other_cities_list">
					<ul>
						<?    
						$sql="SELECT * FROM ".$cfg['DB_KEYWORD']." WHERE (`id` BETWEEN 130 AND 157)";
						$res=$heart->sql_query($sql);
						$i=0;
						 while($row=$heart->sql_fetchrow($res)) 
							{ 
							
							  $i++;
						?>
						<li><a href="product.php?category=SEARCHBYKEYWORD&qsearch=<?=str_replace('++','+',urlencode(trim($row['key_name'])))?>"><?=$row['key_name']?></a></li>
						<?php } ?>
						<!--<li><a href="#">Send Flowers & Gift to Navi Mumbai</a></li>
						<li><a href="#">Send Flowers & Gift to Delhi</a></li>
						<li><a href="#">Send Flowers & Gift to Pune</a></li>
						<li><a href="#">Send Flowers & Gift To Hyderabad</a></li>
						<li><a href="#">Send Flowers & Gift to Chennai</a></li>
						<li><a href="#">Send Flowers & Gift to Cochin</a></li>
						<li><a href="#">Send Flowers & Gift To Bangalor</a></li>
						<li><a href="#">Send Flowers & Gift to Nagpur</a></li>
						<li><a href="#">Send Flowers & Gift to Kolkatta</a></li>
						<li><a href="#">Send Flowers & Gift to Gurgaon</a></li>
						<li><a href="#">Send Flowers & Gift to Panjab</a></li>
						<li><a href="#">Send Flowers & Gift to Mangalor</a></li>
						<li><a href="#">Send Flowers & Gift To Thane</a></li>
						<li><a href="#">Send Flowers & Gift to Goa</a></li>
						<li><a href="#">Send Flowers & Gift To Panvel</a></li>
						<li><a href="#">Send Flowers & Gift To Vashi</a></li>
						<li><a href="#">Send Flowers & Gift To Surat</a></li>
						<li><a href="#">Send flowers & Gift To Kanpur</a></li>
						<li><a href="#">Send Flowers & Gift to Vellore</a></li>
						<li><a href="#">Send Flowers & Gift to Panchkula</a></li>
						<li><a href="#">Send Flowers & Gift to Howrah</a></li>
						<li><a href="#">Send flowers & Gift to Baroda</a></li>
						<li><a href="#">Send Flowers & Gift to Dehradun</a></li>
						<li><a href="#">Send Flowers & Gift to Bhubaneswar</a></li>
						<li><a href="#">Send Flowers & Gift to Jodhpur</a></li>
						<li><a href="#">Send Flowers & Gift to Indore</a></li>
						<li><a href="#">Send flowers & Gift to Ghaziabad</a></li>-->	
					</ul>	
					<div class="clear"></div>				
				</div>
			</div>
			<div class="clearfix"></div>
			
			<div class="row" id="footer_bar">
				<div class="col-md-12">
					&copy; Rainbow Florist World. 2016 &nbsp;&nbsp; | &nbsp;&nbsp;<a onclick="window.open('http://www.encoders.co.in/','_blank')" style="cursor:pointer;">Powered by Encoders</a>
				</div>				
			</div>			
		</div>			 
	</article>
</footer>

<!-- end footer -->


