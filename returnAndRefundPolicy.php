<?php
include_once("includes/links_frontend.php"); ?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/pagesources.php');?>

<body>
    <?php include_once('includes/header.php') ?>
    <div class="container-fluid cm-tr-content-wrap">
        <div class="container">

            <div class="row">
                 <?php 
                    $sql =   "SELECT * FROM ".$cfg['DB_PRODUCT_REFUND']."
                                             WHERE  
                                            `status` ='A' ORDER BY `id` DESC";
                    $res    =   $mycms->sql_query($sql);
                    $row    =   $mycms->sql_fetchrow($res);
                ?>

                <div class="col-xs-12 heading"> 
                    <h2>Return And Refund Policy</h2>

                </div>

                <div class="col-xs-12 pr-pol-content">
                    
                        <?php echo $row['desc1'];?> 
                      
                   
                </div>

            </div>

        </div>

    </div>

    <? include_once('includes/footer.php') ?>

</body>



</html>