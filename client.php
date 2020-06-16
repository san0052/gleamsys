<?
include_once("includes/links_frontend.php"); ?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/pagesources.php');?>
<body>
    <?php include_once('includes/header.php') ?>
    <div class="container-fluid slide_container">
        <?php 
            $sql =   "SELECT * FROM ".$cfg['DB_CLIENT_BANNER']."
                                     WHERE  
                                    `status` ='A' ORDER BY `id` DESC";
            $res    =   $mycms->sql_query($sql);
            $row    =   $mycms->sql_fetchrow($res);
        ?>
        <div class="item">
            <img src="images/<?php echo $row['bannerImg']?>">

            <div class="banner-text">

                <?php echo $row['BannerTitle']?><br>

            </div>

        </div>

    </div>

    <div class="container-fluid cm-tr-content-wrap">

        <div class="container">

            <div class="row">

                <div class="col-xs-12 clients-box">

                    <?php 
                    $sql    =   "SELECT * FROM ".$cfg['DB_CLIENT_INFO']."
                                WHERE  
                                `status` ='A' ";
                    $res      =   $mycms->sql_query($sql);
                    $num      =   $mycms->sql_numrows($res);
                    if($num >0){
                        while($row    =   $mycms->sql_fetchrow($res)){ ?>
                    <div class="col-xs-12 client-item">

                        <img src="uploads/client_logo/<?php echo $row['projectLogo']?>" alt="<?php echo $row['altTag']?>">

                        <h4><?php echo $row['projectName'];?></h4>

                        <p>

                            <span><?php echo $row['projectCountry'];?></span>

                        </p>

                    </div>
                    <?php } }?>


                    

                </div>

            </div>

        </div>

    </div>

    <? include_once('includes/footer.php') ?>

</body>



</html>