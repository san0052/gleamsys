<div id="left-part">
  <div id="categori">
    <h1>Categories</h1>
    <?
$sqlcat1="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `siteId`='".$_SESSION['site']."' AND `status`='A' AND `cat_parent_id`=0 ORDER BY `order`";
$rescat1=$heart->sql_query($sqlcat1);
$numcat1 = $heart->sql_numrows($rescat1);
if($numcat1 > 0){ ?>
    <ul id="theMenu">
      <? while($rowcat1=$heart->sql_fetchrow($rescat1)) { 
	  ?>
      <li>
        <h3 class="head"><a href="javascript:;">
          <?=ucwords(stripslashes($rowcat1['name']))?>
          </a></h3>
        <?
	$sqlcat12="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE  `siteId`='".$_SESSION['site']."' AND   `status`='A' AND `cat_parent_id`=".$rowcat1['id']." ORDER BY `order`";
	$rescat12=$heart->sql_query($sqlcat12);
	$numcat12 = $heart->sql_numrows($rescat12);
	if($numcat12 > 0){ ?>
        <ul>
          <li>
            <ul id="xtraMenu">
              <?  
			  while($rowcat12=$heart->sql_fetchrow($rescat12)) {
			  ?>
			  <li>
                <h4 class="head"><a href="<?=$cfg['base_url_v']?>product.php?category=<?=$rowcat12['id']?>">
                  <?=ucwords(stripslashes($rowcat12['name']))?></a>
                  </h4>
              </li>
			<?  } ?>
            </ul>
          </li>
        </ul>
        <? }
/*		else{
		?>
		   <ul>
          <li>
            <ul id="xtraMenu">
		   <?   if($rowcat1['id']=='210')
		      {
			  
			    $sqlcat="SELECT * FROM ".$cfg['DB_CITY']."";
			 	$rescat=$heart->sql_query($sqlcat);
			    while($rowcat=$heart->sql_fetchrow($rescat)){
									?>
              <li>
                <h4 class="head"><a href="<?=$cfg['base_url_v']?>product.php?category=ZONE&id=<?=$rowcat['id']?>">
                  <?=ucwords(stripslashes($rowcat['name']))?></a>
                  </h4>
              </li>
              <? } ?>
			  </ul>
          </li>
        </ul>

			  
<?			  }
		
		
		}*/
		 ?>
      </li>
	  
      <? } ?>
	  <li><h3 class="head"><a href="javascript:;">
          SHOP BY PRICE
          </a></h3>
		  <?            $sql_price = "SELECT * FROM ".$cfg['DB_PRICERANGE']." WHERE `status`='A'";
						$res_price = $heart->sql_query($sql_price);
						$num_price = $heart->sql_numrows($res_price);
						if($num_price > 0){ ?>
        				<ul>
          					<li>
            					<ul id="xtraMenu">
			  				       <? 
									while($row_price=$heart->sql_fetchrow($res_price)){
									?>
              <li>
                <h4 class="head"><a href="<?=$cfg['base_url_v']?>product.php?category=PRICE&id=<?=$row_price['id']?>">
                  <?=ucwords(stripslashes($row_price['range_name']))?></a>
                  </h4>
              </li>
              <? } ?>
			  </ul>
          </li>
        </ul>
		
			<?  }?>
			</li>
    </ul>
    <? } ?>
  </div>
  <img src="images/left-lower-banner.png" alt="" /> </div>
