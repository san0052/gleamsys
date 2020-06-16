<div id="collection">
<?
$sql_pd="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE `status`='A'  AND `pd_rightbar`='A' order by `pd_id` ";
$res_pd=$heart->sql_query($sql_pd);
$num = $heart->sql_numrows($res_pd);
if($num!=0){
	$prod_count=0;
	while($row=$heart->sql_fetchrow($res_pd)){
	$prod_count++;
?>
	<div class="sec" <?=($prod_count%2==0)?'style="margin-right:0px;"':''?>>
        <a style="text-decoration:none;" href="<?=$cfg['base_url']?>product_details.php?id=<?=$row['pd_id']?>"><img src="<?=$cfg['PRODUCT_IMAGES']?><?=$row['pd_image']?>" width="96"  height="69" alt="" /></a>
        <div class="lower"><?=stripslashes($row['pd_code'])?></div>
	</div>
	<? } 
}?>

<? for($prodcountD=0;$prodcountD<(8 - $num);$prodcountD++){ ?>
    <div class="sec" <?=($prodcountD%2==0)?'style="margin-right:9px;"':''?>>
        <img src="<?=$cfg['BANNER_IMAGES'].getImage(15)?>" alt="" width="96"  height="69"/>
        <div class="lower">Coming Soon</div>
    </div>
<? }?>

</div>