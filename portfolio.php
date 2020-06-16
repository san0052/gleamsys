<?php
include_once("includes/links_frontend.php"); ?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/pagesources.php');?>
<body>

    <? include_once('includes/header.php') ?>

    <div class="container-fluid slide_container">

        <?php 
            $sql =   "SELECT * FROM ".$cfg['DB_PORTFOLIO_BANNER']."
                                     WHERE  
                                    `status` ='A' ORDER BY `id` DESC";
            $res    =   $mycms->sql_query($sql);
            $row    =   $mycms->sql_fetchrow($res);
        ?>
        <div class="item">

            <img src="images/<?php echo $row['bannerImg']?>">

            <div class="banner-text">

               <?php echo $row['BannerTitle'];?>

            </div>

        </div>

    </div>

    <div class="container-fluid cm-tr-content-wrap">

        <div class="container">

            <div class="row">

                <div class="col-xs-12 portfolio-box">
                    <?php 
                        $sql =   "SELECT * FROM ".$cfg['DB_PORTFOLIO_INFO']."
                                                 WHERE  
                                                `status` ='A' ";
                        $res    =   $mycms->sql_query($sql);
                        while($row    =   $mycms->sql_fetchrow($res)){
                    ?>

                    <div class="col-xs-12 client-item">

                        <img src="uploads/portfolio_image/<?php echo $row['portofiloImg']?>">

                        <div class="col-xs-12 port-details">

                            <h4><?php echo $row['portfiloName']?></h4>

                            <p><a href="#">go to the link<span><i class="fas fa-long-arrow-alt-right"></i></span></a></p>

                        </div>

                    </div>
                <?php }?>

                </div>

            </div>

        </div>

    </div>

    <? include_once('includes/footer.php') ?>

</body>



</html>