<?php
    include_once("includes/links_frontend.php"); ?>
<!DOCTYPE html>
<html lang="en">

<?php include_once('includes/pagesources.php');?>

<body class="online-store">
    <? include_once('includes/header.php') ?>
    <div class="container-fluid slide_container">
        <div class="online-store-banner-wrap">
            <div class="online-store-banner-left">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">


                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <?php 
                            $sql =   "SELECT * FROM ".$cfg['DB_ONLINESTORE_BANNER']."
                                                     WHERE  
                                                    `status` ='A'  AND `bannerUseFor`= 'slider image'
                                                    ORDER BY `id` DESC";
                            $res    =   $mycms->sql_query($sql);
                            $counter = 0;
                            while($row    =   $mycms->sql_fetchrow($res)) { ?>
                            <?php if ($counter == 0) { ?>
                                  <div class="item active">
                            <?php } else { ?>
                                  <div class="item">
                            <?php } ?>
                       
                            <img src="uploads/online_store_banner/<?php echo $row['bannerImg']?>" alttag="<?php echo $row['altTag']?>">
                        </div>
                    <?php $counter++ ;} ?>
                        
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <i class="fas fa-angle-left"></i>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <i class="fas fa-angle-right"></i>
                    </a>
                </div>
            </div>
            <!-- <div class="online-store-banner-right">
                <div class="online-store-banner-right-up" id="slideshow">
                    <div>
                        <img src="images/banner-1.jpg">
                    </div>
                    <div>
                    <img src="images/it-service-banner.jpg">
                    </div>
                    <div>
                    <img src="images/banner-financial-services-1600px.jpg">
                    </div>
                </div>
                <div class="online-store-banner-right-down" id="slideshow1">
                    <div>
                    <img src="images/it-service-banner.jpg">
                    </div>
                    <div>
                    <img src="images/banner-financial-services-1600px.jpg">
                    </div>
                    <div>
                        <img src="images/banner-1.jpg">
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <script>
        $("#slideshow > div:gt(0)").hide();

        setInterval(function() {
            $('#slideshow > div:first')
                .fadeOut(2000)
                .next()
                .fadeIn(2000)
                .end()
                .appendTo('#slideshow');
        }, 6000);

        $("#slideshow1 > div:gt(0)").hide();

        setInterval(function() {
            $('#slideshow1 > div:first')
                .fadeOut(2000)
                .next()
                .fadeIn(2000)
                .end()
                .appendTo('#slideshow1');
        }, 6000);
    </script>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 products-specility-box">
                    <?php 
                        $sql =   "SELECT * FROM ".$cfg['DB_SHOP_CONTENT']."
                                                 WHERE  
                                                `status` ='A' ";
                        $res    =   $mycms->sql_query($sql);
                        while($row    =   $mycms->sql_fetchrow($res)){ 
                    ?>
                    <div>
                        <img src="images/<?php echo $row['image']?>" alttat="<?php echo $row['altTag'];?>" style="width: 48px; height: 45px;">
                        <?php echo $row['description'];?>
                       
                    </div>
                <?php } ?>
                  
                </div>
            </div>
        </div>
    </div>
    <? include_once('includes/online-category.php') ?>
    <? include_once('includes/today-special.php') ?>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 specility-box">
                   <?php    
                    $sql =   "SELECT * FROM ".$cfg['DB_ONLINESTORE_BANNER']."
                                     WHERE  
                                    `status` ='A' AND `bannerUseFor`='single image' ";
                    $res    =   $mycms->sql_query($sql);
                  
                    while($row    =   $mycms->sql_fetchrow($res)) { ?>

                    <div class="specility-iamge-box"><img src="uploads/online_store_banner/<?php echo $row['bannerImg']?>" alttag="<?php echo $row['altTag']?>"></div>
                   <?php }?>
                </div>
            </div>
        </div>

    </div>
    <? include_once('includes/newarrival.php') ?>
    <? include_once('includes/best-selling.php') ?>
    <? include_once('includes/brands.php') ?>
    <? include_once('includes/feature-prd.php') ?>
    <? include_once('includes/footer.php') ?>
</body>

</html>