<?php
include_once("includes/links_frontend.php"); ?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/pagesources.php');?>
      
<body>
    <?php include_once('includes/header.php'); ?>
    <div class="container-fluid slide_container">
        <?php 
            $sql =   "SELECT * FROM ".$cfg['DB_PRODUCT_ABOUTUS']."
                                     WHERE  
                                    `status` ='A' ORDER BY `id` DESC";
            $res    =   $mycms->sql_query($sql);
            $row    =   $mycms->sql_fetchrow($res);
        ?>
        <div class="item">
            <img src="images/<?php echo $row['image1'];?>">
            <div class="banner-text">
                <?php echo $row['title1'];?><br>
            </div>
        </div>
    </div>
    
    <div class="container-fluied testimonial-wrap">
        <div class="container">
            <div class="row">
                
                <div class="col-xs-12 about-content">

                    <?php echo $row['desc1'];?>
                    <?php echo $row['desc2']?>
               </div>
        

            </div>

        </div>

    </div>

    <? include_once('includes/serving-location.php') ?>

    <? include_once('includes/footer.php') ?>

</body>







</html>