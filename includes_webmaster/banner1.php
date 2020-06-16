<!-- banner -->
<section>	
	<div class="container" id="mn_body">
		<div class="banner_body">
			<div class="row">
				<div class="col-md-9">
					<div class="main_banner">
						<div class="banner">
							<div id="slider">
							<?php
								$sql_ban_top = "SELECT * FROM ".$cfg['DB_BANNER']." WHERE `status`='A' AND banner_position='top'";
								$res_ban_top = $heart->sql_query($sql_ban_top);
								$num_ban_top = $heart->sql_numrows($res_ban_top);
								while($row_ban_top=$heart->sql_fetchrow($res_ban_top)){
								
							?>
								<img src="images/<?=$row_ban_top['banner_img']?>" alt="" />
							<?php
								}
							?>		           
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="short_banner_body">
					<?php
								$sql_ban_right = "SELECT * FROM ".$cfg['DB_BANNER']." WHERE `status`='A' AND banner_position='right' limit 0,2 ";
								$res_ban_right = $heart->sql_query($sql_ban_right);
								$num_ban_right = $heart->sql_numrows($res_ban_right);
								while($row_ban_right=$heart->sql_fetchrow($res_ban_right)){
								
							?>
						<div class="short_banner"><img src="images/<?=$row_ban_right['banner_img']?>" alt="" class="img-responsive" /></div>
						<?php
							}
						?>	
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="tab_banner_body">
					<div class="col-md-9">
						<?php	
								$i=1;
								$code='tab_banner';
								$sql_ban_bottom = "SELECT * FROM ".$cfg['DB_BANNER']." WHERE `status`='A' AND banner_position='bottom' limit 0,3 ";
								$res_ban_bottom = $heart->sql_query($sql_ban_bottom);
								$num_ban_bottom = $heart->sql_numrows($res_ban_bottom);
								while($row_ban_bottom=$heart->sql_fetchrow($res_ban_bottom)){
								if($i==2){$code='tab_banner2';}if($i==3){$code='right_banner';}
								if($i>2){
							?>
							</div>
							<div class="col-md-3">
							<?php }?>
							<div class="<?=$code;?>"><img src="images/<?=$row_ban_bottom['banner_img']?>" alt="" class="img-responsive" /></div>
						
						<?php
							$i++;
							}
						
						?>
				</div>
			</div>
		</div>
	</div>
</section>