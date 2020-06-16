<td align="left" valign="top" class="featContrl">
				<h3>Featured Products</h3>
				<ul>
				<?
				$featuredProduct = getFeaturedProduct();
				$numFeaturedItem = count($featuredProduct);
				for ($j = 0; $j < $numFeaturedItem; $j++) {
					extract($featuredProduct[$j]);
					$productUrl = "product-page.php?pdId=$pd_id";
				?>
					<li class="<?=(($j+1)%3==0)?'noMarg':''?>">
						<img src="<?=$pd_image?>" title="<?=$pd_name?>" border="0"/><br class="clear" />
						<span class="prdctNam"><a href="<?=$productUrl?>"><?=$pd_name?></a></span>
						<span class="capsul"><?=$pd_abs?></span>
						<span class="prdctPric">$<?=$pd_price?></span>
						<input type="image" src="images/add_cart.gif" title="Add to Cart" onClick="window.location.href='cart_process.php?p=<?=$pd_id?>&action=add';" />
					</li>
				<? }?>
				</ul>
			</td>