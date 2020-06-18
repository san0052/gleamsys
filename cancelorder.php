<?php
include_once("includes/links_frontend.php"); ?>
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
                                <h4>Cancel Orders</h4>
                            </div>
                            <div class="applied-items-box">
                                <div class="order-summery">
                                    <div class="order-list">
                                    <div class="item-pic">
                                            <img src="images/prd-1.png">
                                        </div>
                                        <div class="item-details">
                                            <p class="prd-name">Product name</p>
                                            <p class="prd-id">product id</p>
                                            <p class="deliver-date">Delivery by Sun 21 Jun | Free</p>
                                            <p class="prd-price">$200</p>
                                            <button class="rmv-btn">Cancaled</button>
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