<?php
include_once("includes/links_frontend.php"); ?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/pagesources.php');?>
<body>
    <? include_once('includes/header.php') ?>

    <? include_once('includes/banner.php') ?>

    <? include_once('includes/about.php') ?>

    <? include_once('includes/services.php') ?>

    <div class="container-fluid counter">

        <div class="container">

            <div class="row">
                <?php 
                    $sql =   "SELECT * FROM ".$cfg['DB_HOME_COUNTER']."
                                             WHERE  
                                            `status` ='A' ORDER BY `id`DESC";
                    $res =   $mycms->sql_query($sql);
                while($row    =   $mycms->sql_fetchrow($res)){ ?>
                        <div class="col-xs-12 col-md-4">
                            <div class="single-coutnerup">
                                <span class="count-num"><?php echo $row['counter'] ?></span>
                                <h4 class="title"><?php echo $row['title'] ?></h4>
                            </div>
                        </div>
            <?php } ?>

            </div>

        </div>

    </div>

    <? include_once('includes/brands.php') ?>
    <? include_once('includes/feature-prd.php') ?>
    <? include_once('includes/clients.php') ?>
    <? include_once('includes/testimonial.php') ?>
    <? include_once('includes/serving-location.php') ?>
    <? include_once('includes/footer.php') ?>
    

</body>
</html>