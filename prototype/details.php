<?
include_once("includes/function.php");
?>
<!DOCTYPE html>
<html lang="en">

<? pagesource() ?>

<body>
    <div class="main">
        <? include_once('includes/header.php') ?>
        <? include_once('includes/banner.php') ?>
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 heading">
                        <h2>product details</h2>
                        <div class="tag-border">
                        </div>
                    </div>
                    <div class="col-xs-12 products-details">
                        <div class="col-xs-12 product-details-box" onclick="window.location.href='details.php'">
                            <div class="col-xs-12 product-image">
                                <img src="images/tp1.jpg" style="width: 70%">
                            </div>
                            <div class="col-xs-12 product-details">
                                <div class="details-inner">
                                    <h4>Thermal Thermometer</h4>
                                    <h5>
                                        Brand: RTEK<br>
                                        Availability: In stock
                                    </h5>
                                    <p class="des">description</p>
                                    <h6>
                                        Measuring Range :
                                        Body 32.6°C ~ 42°C(89.6°F ~ 167.6°F<br>
                                        Audiable Alarm : Yes<br>
                                        Weight: 1.7 Kg<br>
                                        In the box : Carry Pouch + IR Thermometer + Alkaline Battery<br>
                                    </h6>
                                    <div class="col-xs-12 btn-box">
                                        <button onclick="window.location.href='contact.php'">contact to book now</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        
                        
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <? svg() ?>
    </div>
    <? include_once('includes/category.php') ?>
    <? include_once('includes/contact.php') ?>
    <? include_once('includes/footer.php') ?>
</body>



</html>