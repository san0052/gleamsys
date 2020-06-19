<?php
include_once("includes/links_frontend.php"); 
    if (empty($_SESSION['gleam_users_session'])) { 
         $returnLink  =   $cfg['base_url'];
         $mycms->redirect($cfg['base_url']);
    }else{
        $userId = $_SESSION['gleam_users_session']['user_id'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/pagesources.php'); ?>

<body class="online-store-inner">
    <?php include_once('includes/header.php'); ?>
    <div class="container-fluid profile-box">
        <div class="container">
            <div class="row">
                <?php include_once('includes/profile-left-menu.php'); ?>
                <div class="col-xs-12 col-md-9 prf-right-box">
                    <div class="prf-right-content">
                        <div class="applied-box">
                            <div class="teacherlisting-about-text-left">
                                <h4>My Order List</h4>
                            </div>
                            <div class="applied-items-box">
                                <div class="order-summery">
                                    <div class="order-list">
                                    <div class="item-pic">
                                            <img src="images/prd-1.png">
                                            <input type="number" min="1" max="10" value="1">
                                        </div>
                                        <div class="item-details">
                                            <p class="prd-name">Product name</p>
                                            <p class="prd-id">product id</p>
                                            <p class="deliver-date">Delivery by Sun 21 Jun | Free</p>
                                            <p class="prd-price">$200</p>
                                            <button class="rmv-btn">Cancel Order</button>
                                            <button class="rmv-btn track-order">Track Order</button>
                                        </div>
                                       
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <? include_once('includes/footer.php') ?>

</body>

</html>