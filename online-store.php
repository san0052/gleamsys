<?
include_once("includes/function.php");
?>
<!DOCTYPE html>
<html lang="en">

<? pagesource() ?>

<body class="online-store">
    <? include_once('includes/header.php') ?>
    <div class="container-fluid slide_container">
        <div class="online-store-banner-wrap">
            <div class="online-store-banner-left">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">


                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item">
                            <img src="images/banner-financial-services-1600px.jpg">
                        </div>

                        <div class="item">
                            <img src="images/it-service-banner.jpg">
                        </div>

                        <div class="item active">
                            <img src="images/banner-1.jpg">
                        </div>
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
            <div class="online-store-banner-right">
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
            </div>
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
                    <div>
                        <img src="https://constant.myntassets.com/web/assets/img/ef05d6ec-950a-4d01-bbfa-e8e5af80ffe31574602902427-30days.png" style="width: 48px; height: 49px;">
                        <p>
                            <b>Return within 30days</b> of receiving your order
                        </p>
                    </div>
                    <div>
                        <img src="https://constant.myntassets.com/web/assets/img/cafa8f3c-100e-47f1-8b1c-1d2424de71041574602902399-truck.png" style="width: 48px; height: 43px;">
                        <p>
                            <b>Get free delivery</b> for every order above Rs. 799
                        </p>
                    </div>
                    <div>
                        <img src="https://constant.myntassets.com/web/assets/img/6c3306ca-1efa-4a27-8769-3b69d16948741574602902452-original.png" style="width: 48px; height: 40px;">
                        <p>
                            <b>100% ORIGINAL</b> guarantee for all products at theteacherhub.com
                        </p>
                    </div>
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
                    <div class="specility-iamge-box"><img src="images/banner-1.jpg"></div>
                    <div class="specility-iamge-box"><img src="images/banner-1.jpg"></div>
                    <div class="specility-iamge-box"><img src="images/banner-1.jpg"></div>
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