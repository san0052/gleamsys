<?php

//$sqlcat="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE  `status`='A' AND `cat_parent_id`=0 ORDER BY `order`";
//$rescat=$heart->sql_query($sqlcat);
//$numcat = $heart->sql_numrows($rescat);
// if($numcat > 0){
//while($rowcat=$heart->sql_fetchrow($rescat)) { 
?>


      
















<? // } } ?>
<div class="clr"></div>



<div class="clr"></div>
<? if($this_page!='my_account' && $this_page!='orderdetails' && $this_page!='login'){ ?>

<div class="for-adds">

<? if(getLink(1)!='0'){?><a href="<?=getLink(1)?>" target="_blank"><img src="<?=$cfg['BANNER_IMAGES'].getImage(1)?>" alt="" /></a><? }else{?><img src="<?=$cfg['BANNER_IMAGES'].getImage(1)?>" alt="" /><? }?>


<? if(getLink(2)!='0'){?><a href="<?=getLink(2)?>" target="_blank"><img src="<?=$cfg['BANNER_IMAGES'].getImage(2)?>" alt="" style="margin:2px 0 2px 0"/></a><? }else{?><img src="<?=$cfg['BANNER_IMAGES'].getImage(2)?>" alt="" /><? }?>

<? if(getLink(3)!='0'){?><a href="<?=getLink(3)?>" target="_blank"><img src="<?=$cfg['BANNER_IMAGES'].getImage(3)?>" alt="" /></a><? }else{?><img src="<?=$cfg['BANNER_IMAGES'].getImage(3)?>" alt="" style="margin:2px 0 2px 0"/><? }?>

<? } ?>

<div class="clr"></div>

</div>
<div class="clr"></div>
