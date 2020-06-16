<!--<script type="text/javascript" src="js/jquery-1.2.3.min.js"></script>-->
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script language="JavaScript" type="text/javascript" src="js/customer.js"></script>
<div id="navigation" style="margin-top:0px;"> 
	<ul  style="margin-left:-10px;">
		<li>
			<a href="index.php"  style="font-size:18px;">HOME</a>
				<!--<ul>
					<li>
						<a href="<?=$cfg['base_url_v']?>gallery.php"  style="cursor:pointer;">Gallery</a>
					</li>
				</ul>-->
		</li>
		<li>
			<a href="<?=$cfg['base_url_v']?>product.php?category=142#main"  style="font-size:18px; color:#FFFF00;">
				<blink><?=strtoupper("Anniversary")?></blink>
			</a>
		</li>
<?
		$sql="SELECT * FROM ".$cfg['DB_CATEGORY']."  WHERE `cat_parent_id`='0' AND `status`='A' AND `show_in_top_menu`='Y' ORDER BY `order`";
		$res=$heart->sql_query($sql);
		$maxrow=$heart->sql_numrows($res);
		if($maxrow >0){
			while($row=$heart->sql_fetchrow($res)){			
?>          
				<li>
					<a href="<?=($row['id']==225)?'city_list.php#main':'#' ?>"  style="font-size:18px;"><?=strtoupper(stripslashes($row['name']))?></a>
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
										<a href="<?=$cfg['base_url_v']?>product.php?category=<?=$row_s['id']?>#main" style="cursor:pointer;" 
										onclick="lisTrans(<?=$row_s['id']?>);">
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
			<a href="#"  style="font-size:18px;"><?=strtoupper("Shop By Price")?></a>
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
						<li>
							<h4 class="head">
								<a href="<?=$cfg['base_url_v']?>product.php?category=PRICE&id=<?=$row_price['id']?>#main">
									<?=ucwords(stripslashes($row_price['range_name']))?>
								</a>
							</h4>
						</li>
<?
					} 
?>
				</ul>
<? 
			}
?>
		</li>
		<li>
			<a href="<?=$cfg['base_url_v']?>product.php?category=ZONE&id=25#main"  style="font-size:18px;">
				<?=strtoupper("Mumbai Special")?>
			</a>
		</li>
		
		<li>
			<a href="#"  style="font-size:18px;"><?=strtoupper("Gallery")?></a>
<?    
			$sql_album = "SELECT * FROM ".$cfg['DB_ALBUM']." WHERE `status`='A'";
			$res_album = $heart->sql_query($sql_album);
			$num_album = $heart->sql_numrows($res_album);
			if($num_price > 0){ 
?>
				<ul>
<? 
					while($row_album=$heart->sql_fetchrow($res_album)){
?>
						<li>
							<h4 class="head">
								<a href="<?=$cfg['base_url_v']?>gallery.php?albumid=<?=$row_album['id']?>#main">
									<?=ucwords(stripslashes($row_album['name']))?>
								</a>
							</h4>
						</li>
<?
					} 
?>
				</ul>
<? 
			}
?>
		</li>
	</ul>
</div>


<!--<div id="banner">
	<div id="header-slider">
		<div class="wrap">
			<div id="slide-holder">
				<div id="slide-runner"> 
					<?php /*?><a href=""><img id="slide-img-1" src="images/christmas.png" class="slide" alt="" /></a> <?php */?>
					<a href=""><img id="slide-img-2" src="images/f_day.png" class="slide" alt="" /></a>
					<a href=""><img id="slide-img-4" src="images/banner4.png" class="slide" alt="" /></a> 
					<a href=""><img id="slide-img-5" src="images/banner5.png" class="slide" alt="" /></a> 
					<div id="slide-controls">
						<p id="slide-nav"></p>
					</div>
				</div>
			</div>
			<!--Content Featured Gallery Here -->
			<!--<script type="text/javascript">
				if(!window.slider) var slider={};slider.data=[<?php /*?>{"id":"slide-img-1","client":"nature beauty","desc":"nature beauty photography"},<?php */?>
																{"id":"slide-img-2","client":"nature beauty","desc":"add your description here"},
																{"id":"slide-img-4","client":"nature beauty","desc":"add your description here"},
																{"id":"slide-img-5","client":"nature beauty","desc":"add your description here"},];
			</script>
		</div>
	</div>
</div>-->
<br><br>